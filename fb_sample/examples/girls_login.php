<?php

// require '../src/facebook.php';

// // Create our Application instance (replace this with your appId and secret).
// $facebook = new Facebook(array(
//   'appId'  => '334993866548043',
//   'secret' => '9a185006487e4f063059f26f2aa32859',
// ));

// // Get User ID
// $user = $facebook->getUser();

// // We may or may not have this data based on whether the user is logged in.
// //
// // If we have a $user id here, it means we know the user is logged into
// // Facebook, but we don't know if the access token is valid. An access
// // token is invalid if the user logged out of Facebook.

// //$connect = mysql_connect("localhost"," b31_c467"," b31_c467");

// //$db = "b31_c467";

// //mysql_db_query("SET NAMES utf8", $connect);


// if ($user) {

// 	 try {
//     // Proceed knowing you have a logged in user who's authenticated.
//     $user_profile = $facebook->api('/me');
//     //セッションを開始
// 		session_start();
// 		$tmp = $facebook->api(array(
//   'method' => 'fql.query',
//   'query' => "select name from user where uid=me()",
// ));

//   } catch (FacebookApiException $e) {
//     error_log($e);
//     $user = null;
//   }
// }

// // Login or logout url will be needed depending on current user state.
// if ($user) {
//   //session_start();
//   $_SESSION['user_id'] = $user;
//   $_SESSION['user_name'] = $user_profile [name];
//   $name = $_SESSION['user_name'];


// 	//↓ここがあるとログインした状態だとmypage.phpに飛ばされる
//   header("Location: http://a1.zeroprm.com/b31_c467/examples/girls_Top.php");
//   $logoutUrl = $facebook->getLogoutUrl();
// } else {
//   $loginUrl = $facebook->getLoginUrl();
//   echo"未ログイン";
// }

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

$db = "b31_c467";
$connect = mysql_connect("localhost","b31_c467","b31_c467");
			mysql_query("SET NAMES utf8", $connect);

$result = mysql_db_query("b31_c467","select userid from Myprofile_tbl");

$ID = mysql_fetch_assoc($result);


$result1 = mysql_db_query("b31_c467","select * from User_profile");

$data = mysql_fetch_assoc($result1);

//ユーザーログイン認証
	if(isset($_SESSION['username'])){
		// echo$_SESSION['username'];
		// $name = $_SESSION['username'];
		// set_time_limit();
		// while(true){
		// 	if($name == null){
		// 		break;
		// 	}else if($name == $data){
				header("Location: http://a1.zeroprm.com/b31_c467/examples/girls_Top.php");
		// 	}
		// }
	}


//echo$namedata['name'];
//echo$namedata;

echo"</br>";
	?>

<!DOCTYPE html>
<html lang ="ja">
<head>
	<title>紹介画面</title>
	<meta charset ="utf-8">
	<link rel ="stylesheet" type="text/css" href="account.css">
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<meta name="viewport" content="width=device-width,user-scalable=no,maximum-scale=1" />

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
<div id="message">
	<img src="./images/account/top-bunsyo2.png" id="messe">
</div>
<?php

	//facebook認証
	if($user){
		$tmp = $facebook->api(array(
  'method' => 'fql.query',
  'query' => "select name from user where uid=me()",
));

		$user_profile = $facebook->api('/me');

//echo $tmp[0]['name'];
		//$_SESSION['userName'] = 'takahashi';
		$_SESSION['username'] = $tmp[0]['name'];
		if(isset($ID)){
			//echo"ようこそ!!";
			// echo$ID."=";
			// echo$user;
			// echo$ID;

			if($tmp[0]['name'] == $user_profile['name']){
				// echo$tmp[0]['name'];
				// echo$user_profile['name'];
				//header("Location: http://a1.zeroprm.com/b31_c467/examples/girls_Top.php");
			}

			//$userじゃないなら
		}else{
			echo"取得ミス";
		}
		
	}
		//echo"<a href="'http://a1.zeroprm.com/b31_c467/examples/Session.php'">
?>

<div class="button">
	<a href="http://a1.zeroprm.com/b31_c467/examples/girls_Top.php">
	<img src="./images/account/see-top.png" id="see" alt="中を見る" >
    </a>

    <a href="http://a1.zeroprm.com/b31_c467/examples/girls_loginselect.php
">
	<img src="./images/account/login-top.png" id="login" alt="ログインへ" >
	</a>
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


</script>

<footer>
</footer>

</body>

