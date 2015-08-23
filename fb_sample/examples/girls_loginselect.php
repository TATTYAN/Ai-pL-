<?php

require '../src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '334993866548043',
  'secret' => '9a185006487e4f063059f26f2aa32859',
));

// Get User ID
$user = $facebook->getUser();

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.
$logoutUrl = $facebook->getLogoutUrl();

//db接続
$connect = mysql_connect("localhost","b31_c467","b31_c467");
			mysql_query("SET NAMES utf8", $connect);

			//ログイン中判定。セッションのチェック
			if(isset($_SESSION['username']) && $_SESSION['username'] != ""){   //個別名の取得
	$result1 = mysql_db_query("b31_c467","select * from User_profile where name ='{$_SESSION['username']}'");

	$data = mysql_fetch_assoc($result1);
	
	//ユーザーがセッション中かどうか
		if(isset($data['name'])){
			//header("Location: http://a1.zeroprm.com/b31_c467/examples/girls_Top.php");
		}
		// else{
		// 	//予備の操作（なくてもいい）
		// 	session_unset($_SESSION['username']);
		// 	$name = "ゲスト";
		// }
	}

//facebookログイン判定
if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
    echo"ユーザー情報取得に成功しました。";
      //session_start();
    //facebookログイン中なら、セッションを飛ばす
  // $_SESSION['user_id'] = $user;
  // $_SESSION['user_name'] = $user_profile['name'];

    $result2 = mysql_db_query("b31_c467","select * from User_profile");

	$data1 = mysql_fetch_assoc($result2);
	
	// while(true){
	// 	if($data1 == null){
	// 		break;
	// 	}else if($user_profile['name']	== $data1['name']){  //ユーザー情報にfbアカウントがあれば。
			//セッション開始
			//$_SESSION['user_name'] = $user_profile['name'];
			header("Location: http://a1.zeroprm.com/b31_c467/examples/girls_Top.php");
	// 	}
	// }
  	
  		$name = $_SESSION['user_name'];
  		echo"テスト".$name;
  		echo$user_profile['name'];
  		$logoutUrl = $facebook->getLogoutUrl();
  		 
  	//}
 
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
// }

// // Login or logout url will be needed depending on current user state.
// if ($user) {
//   session_start();
//   $_SESSION['user_id'] = $user;
//   $_SESSION['user_name'] = $user_profile['name'];
//   $name = $_SESSION['user_name'];


// 	//↓ここがあるとログインした状態だとmypage.phpに飛ばされる
//   header("Location: http://a1.zeroprm.com/b31_c467/examples/girls_Top.php");
//   $logoutUrl = $facebook->getLogoutUrl();
} else {
	//echo"hello user";
  $loginUrl = $facebook->getLoginUrl();
}
//////facebook連携
	?>


<!DOCTYPE html>
<html lang ="ja">
<head>
	<title></title>
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

<div id="form">
	<div id="title">
		<img src="./images/account/login.png" id="login" alt="ログインページ" >
	</br></br>
	<p>  　</p>
		<a style="color: #000080;">Facebookログイン<a></br>
<a href="<?php echo$loginUrl; ?>">
	<img src="./images/account/login-b.png" id="fblogin" alt="facebookログイン" >
</a>
<p>  　</p>
<p>
	<a style="color: 128;">アカウントでログイン<a/></br>
<a href="http://a1.zeroprm.com/b31_c467/examples/girls_Logincheck.php">
	<img src="./images/account/login-b.png" id="lotin" alt="ログイン" >
</a></p>

	<a style="color: 128;"><a/></br>
<a href="http://a1.zeroprm.com/b31_c467/examples/girls_userResisration.php">
	<img src="./images/account.png" id="account" alt="アカウント作成" >
</a>

		</div>

</div>

<div id="back-bt">
	<a href="http://a1.zeroprm.com/b31_c467/examples/girls_login.php">
	<img src="./images/account/back.png" id="back" alt="前のページへ" >
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

