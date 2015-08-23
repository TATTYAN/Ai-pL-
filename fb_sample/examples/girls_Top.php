<?php

set_time_limit(120);
///↓facebook連携
require '../src/facebook.php';

// ここにアプリのIDとパスワードを書きます
// 今回はこのままでOKです。
$facebook = new Facebook(array(
  'appId'  => '334993866548043',
  'secret' => '9a185006487e4f063059f26f2aa32859',
));

// $userにはfacebook社が１人１人に与えているidが入っています
// 大学生なら学籍番号、社会人であれば社員番号と同じイメージです。
$user = $facebook->getUser();

//$logoutUrl = $facebook->getLogoutUrl();

//db接続
$connect = mysql_connect("localhost","b31_c467","b31_c467");
			mysql_query("SET NAMES utf8", $connect);

			$url = "";


//facebookログイン認証
if ($user){//fbログイン時
	 try {
    // apiという召使に対して me = 自分のアカウント情報をくれ という命令
    // $user_profileには自分がFacebookに登録しているアカウント情報が入っています
  	  $user_profile = $facebook->api('/me');
     //$userold_profile = $facebook->api('/me/gender');
  	   } catch (FacebookApiException $e) {
   	 	error_log($e);
    	$user = null;
  	   }
 }


  	 if($user){  //facebookにログインしてる場合
  	 	$logoutUrl = $facebook->getLogoutUrl();

  	 	$fbname = $user_profile['name'];
  	 	//DBに既に登録されてるかチェック。

  	 	//$fbdata = mysql_db_query("b31_c467","select * from User_profile where name = '$fbname'");
  	 	$fbdata = mysql_db_query("b31_c467","select * from User_profile");
  	 	$users = mysql_fetch_assoc($fbdata);

  	 	$fbuser = mysql_db_query("b31_c467","select * from User_profile where name = $fbname");

  	 	//session_start();
  	 	$_SESSION['username'] = $fbname;

  	 		if(!isset($fbuser)){
  	 			echo$fbname."さんを登録しました。";
				//今登録したユーザー
				mysql_db_query("b31_c467","insert  User_profile (name)  values('$fbname')");
  	 		}

  	 	//$name = $fbname;
  	 		if(isset($_SESSION['username'])){
  	 			$name = $_SESSION['username'];
  	 		}else{
  	 			$name = "ゲスト";
  	 		}
  	 	
		 echo"facebookログイン中";

  	 }else{//facebookログアウト
  	 		$loginUrl = $facebook->getLoginUrl();
  	 	 if(isset($_SESSION['username'])){ //メールログインもしくはfbログアウト前
  	 	 	//echo"セッション中";

  	 		if(isset($_SESSION['username']) && isset($fbuser)){ //facebookでログアウトの正式な処理
  	 			session_unset($_SESSION['username']);
  	 			session_destroy($_SESSION['username']);
				header("Location: http://a1.zeroprm.com/b31_c467/examples/girls_login.php");
			}else{//メールでログインしてる場合
				$result1 = mysql_db_query("b31_c467","select * from User_profile where name ='{$_SESSION['username']}'");

				$data = mysql_fetch_assoc($result1);
				echo$data['name'];
				if(isset($data['name'])){
					$name = $data['name'];
				}else{//何かしらのエラーによるセッションを消す。
					session_unset($_SESSION['username']);
					//header("Location: http://a1.zeroprm.com/b31_c467/examples/girls_login.php");
					$name = "ゲスト";
				}
			}
		}else{//何でもログインしてない場合
			$name = "ゲスト";
			$url = "#tomypage";
			//echo"ログアウト中";
		}
		//echo"ログアウト中";
	}
	
	function facebookLogout() {
			 	$facebook->destroySession();
			 	header("Locaiton: ".$logoutUrl);
	}

?>

<!DOCTYPE html>
<html lang ="ja">
<head>
	<title>トップページ</title>
	<meta charset ="utf-8">
	<link rel ="stylesheet" type="text/css" href="top.css">
	<link rel="stylesheet" href="weblayout.css">
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="pulldown.js"></script>
	<meta name="viewport" content="width=device-width,user-scalable=no,maximum-scale=1" />
	<style>
		.logout{
			float:left;
			margin-left: 30px;
		}

		#hit{
			float:right;
			margin-right: 20px;
		}

		#menu li {

  position: relative;

  float: left;

  margin: 0;

  padding: 5px;

  width: 200px;

  height: 20px;

  border: solid 1px #ccc;

  font-weight: bold;

}

#menu li:hover {

  color: #fff;

  background: #333;

}

#menu li ul {

  display: none;

  position: absolute;

  top: 30px;

  left: -1px;

  padding: 5px;

  width: 200px;

  background: #eee;

  border: solid 1px #ccc;

}

#menu li ul li {

  margin: 0;

  padding: 0;

  width: 200px;

  border: none;

}

#menu li ul li a {

  display: inline-block;

  width: 200px;

  height: 20px;
}

#menu li ul li a:hover {

  background: #999;

  color: #fff;
}
	</style>

</head>
<header></header>
<body>
		
<div class="bgCircleWrap">
      <div id="circleL">
          <p class="circle1"></p>
          <p class="circle2"></p>
          <p class="circle3"></p>
          
      </div>
</div>
<a id="hit" value="">0hit</a>

<?php
 if(isset($_SESSION['username'])){
 	echo"<a class='logout' href='http://a1.zeroprm.com/b31_c467/examples/girls_logout.php' class='current' style='color:blue;'> logout</a>";}else{
 		echo"<a class='logout' href='http://a1.zeroprm.com/b31_c467/examples/girls_loginselect.php' class='current' style='color:blue;'> login</a>";
 		$ufl = "http://a1.zeroprm.com/b31_c467/examples/girls_Myprofile.php";
 	}
?>
</br>



<div id="tomypage">

	<?php //echo"session[id]=".$_SESSION['id']; ?>
	<div style='text-align:center; background-color:white; color:rgb(61,35,17);'>ようこそ<a style="color: rgb(61,35,17);" id='back' href='<?php echo$url ?>'><?php echo$name;?>さん</a></div></br>
		
</div>



<?php
if(isset($_SESSION['username'])){
	$url = "http://a1.zeroprm.com/b31_c467/examples/Girls_myprofile.php";
	echo"<div id='menu'>
	プロフィール</br>
	<a href='".$url."'>
	<img src='./images/menu3.png' id='app' alt='編集へ' ></a>
</div>";
}

?>

<div id="logo">
	<img src="./images/logo.png" id="logo-img">
</div>

<div id="ms1">
	<img src="./images/message1.png" id="ms1">
</div>


<!--- urlは追加してください！  -->
<!-- // TODO 後で消すテスト -->


<div class="genre">
<!-- アプリ -->
<a href="http://a1.zeroprm.com/b31_c467/girls_tweetZatsudan.php">
	<img src="./images/app.png" id="app" alt="アプリへ" >
</a>
<!-- ウェブデザイン -->
<a href="http://a1.zeroprm.com/b31_c467/girls_tweetZatsudan.php">
	<img src="./images/web.png" id="web" alt="ウェブデザインへ" >
</a>
<!-- ゲーム -->
<a href="http://a1.zeroprm.com/b31_c467/girls_tweetZatsudan.php">
	<img src="./images/game.png" id="game" alt="ゲームへ" >
</a>
</div>


<div class="genre2">
<!-- イラスト -->
<a href="http://a1.zeroprm.com/b31_c467/girls_tweetZatsudan.php">
	<img src="./images/illust.png" id="app" alt="イラストへ" >
</a>
<!-- その他 -->
<a href="http://a1.zeroprm.com/b31_c467/girls_tweetZatsudan.php">
	<img src="./images/sonota.png" id="web" alt="その他へ" >
</a>
<!-- 雑談 -->
<a href="http://localhost:8888/onedayapp/oneday_blog/posts/">
	<img src="./images/zatudan.png" id="game" alt="トップPageへ" >
</a>
</div>

<div>
							<ul id="menu">
							<li><a href="http://a1.zeroprm.com/b31_c467/GoogleMap.html" target="_blank">近くのイベントを探す</a>
							<ul>
							<li><a href="#">東京都</a></li>
							<li><a href="#">大阪府</a></li>
							<!-- <li><a href="#">愛知県</a></li> -->
							</ul>
							</li>
							<!-- <li>メニュー2
							<ul>
							<li><a href="#">サブメニュー2-1</a></li>
							<li><a href="#">サブメニュー2-2</a></li>
							<li><a href="#">サブメニュー2-3</a></li>
							</ul> -->
							</li>
							</ul>
						</div>
<!-- アカウントを作るボタン -->
<div class ="akaunto">

<?php
if($name == "ゲスト"){
	echo"<a id='tologin' href='http://a1.zeroprm.com/b31_c467/examples/girls_loginselect.php'>
	<img src='./images/account.png' id='account' alt='サインインへ' >
</a>";
}
?>

</div>

						
<div id="footer">
		<div id="footerNav"><a href="#tomypage">Top</a></div>
		<ul style="color:yellow;">↓↓pick up!!↓↓</ul>
		<a href="~~~"></a>
		<div class="inner">
			<div id="headerNav">

				<h1>女性学生にオススメ！</h1>
				<!-- start Navigation -->
				<div id="mainNav">

					<ul>
						<li><a href="http://life-is-tech.com/codegirls/#" class="current">Codegirls</a></li>
						<li><a href="http://techkidscamp.jp/">TechKits</a></li>
						<li><a href="http://engineer.typemag.jp/category/woman">エンジニア女子部</a></li>
						<li><a href="http://a1.zeroprm.com/b31_c467/examples/GirlsEvent.php">開催予定のイベント</a></li>
						<li><a href="http://ae-users.com/jp/particular-hanabi/">Af（動画）イベント</a></li>
					</ul>
				</div>
				<!-- end Navigation -->
				<a href="#footerNav"></a>
			</div>

			<p>Ai*pL∀ Engineer</p>
				<!-- <button onclick="alert('<?php facebookLogout() ?>')" class="current" style="color:blue;">
				ログアウト
				</button> -->

				<a href="http://a1.zeroprm.com/b31_c467/examples/g_facebooklogout.php">ログアウト</a>
			

			 
	<!-- 		//  if($user){
			//  	$facebook->destroySession();
			//  	header("Locaiton: ".$logoutUrl);
			//  	echo $logoutUrl;
			//  }else{
			//  		echo"http://a1.zeroprm.com/b31_c467/examples/girls_logout.php";
			// }
			 -->


		</div>
	</div>

<script>
$(document).ready(function() {

  $('#circleL').addClass('round');
  
    var $circle1 = $('#circleL')
	var $circle2 = $('#circleS')

	var _circleTimer1 = setInterval(function(){
		$circle1.toggleClass("round");
	},20000);

	var _circleTimer2= setInterval(function(){
		$circle2.toggleClass("round");
	},23000);		
});


$(function(){
	if(localStorage.getItem('hit')){
		$('#hit').val(localStorage.getItem('hit'));
		var num = document.getElementById('hit').value;
	}else{
		var num=0;
	}

	num = num+1;
	console.log(num);
	
	(function hitSave(){
	
	console.log(localStorage.getItem('hit'));
		console.log(num);
	document.getElementById('hit').innerHTML = num+'hit';
		localStorage.setItem('hit', $('#hit').val());
		setTimeout(hitSave, 3000);
	})();
});



</script>

</body>
