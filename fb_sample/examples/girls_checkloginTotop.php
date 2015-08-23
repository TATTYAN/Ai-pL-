<?php
$connect = mysql_connect("localhost","b31_c467","b31_c467");

			mysql_query("SET NAMES utf8", $connect);


$email = $_GET['email'];
$password = $_GET['passward'];

$result = mysql_db_query("b31_c467","select * from User_profile where email = '{$email}' and passward = '{$password}'");

 if(isset($result)){
	$data = mysql_fetch_assoc($result);
	$user = $data['name'];
	// session_unset($_SESSION['username']);
	// session_unset($_SESSION['id']);
	session_start();
	$_SESSION['username'] = $data['name'];
	$_SESSION['id'] = $data['id'];
	echo$_SESSION['username'];
	if(isset($_SESSION['username'])){
		header("Location: http://a1.zeroprm.com/b31_c467/examples/girls_Top.php");
	}
 }else{
	echo"</br>";
	echo"ログイン失敗</br>";
	echo"メールアドレスもしくはパスワードが間違っている可能性があります。</br>";
	echo"<a href='http://a1.zeroprm.com/b31_c467/examples/girls_Logincheck.php'>
	<img src='./images/account/back.png' id='back' alt='前のページへ' >
	</a>";

 }




set_time_limit(0);



	// if($data == null){
	// 		echo"</br>";
	// echo"ログイン失敗</br>";
	// echo"メールアドレスもしくはパスワードが間違っている可能性があります。</br>";
	// echo"<a href='http://a1.zeroprm.com/b31_c467/examples/girls_Logincheck.php'>
	// <img src='./images/account/back.png' id='back' alt='前のページへ' >
	// </a>";

	// }else{
	// //いったんセッション切って、おき直す
	// session_unset($_SESSION['username']);
	// session_unset($_SESSION['id']);
	// session_start();
	// $_SESSION['username'] = $data['name'];
	// $_SESSION['id'] = $data['id'];
	// header("Location: http://a1.zeroprm.com/b31_c467/examples/girls_Top.php");
	// 	}





?>

<!DOCTYPE html>
<html lang ="ja">
<head>
	<title>会員ログイン</title>
	<meta charset ="utf-8">
	<link rel ="stylesheet" type="text/css" href="account.css">
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<meta name="viewport" content="width=device-width,user-scalable=no,maximum-scale=1" />

<style>
	body{
		text-align: center;
	}

</style>

</head>
<header></header>
<body>


</form>

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
