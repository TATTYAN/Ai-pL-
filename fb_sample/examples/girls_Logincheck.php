<?php
// $connect = mysql_connect("localhost","b31_c467","b31_c467");
// 			mysql_query("SET NAMES utf8", $connect);

// $result = mysql_db_query("b31_c467","select userid from User_profile");

// $data = mysql_fetch_assoc($result);

// $user = $data['user'];

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


	<form action="girls_checkloginTotop.php" method="GET">
	<p>ログイン</p>

    <p>メールアドレス:<input type="email" name="email"></p>
    <p>パスワード:<input type="passward" name="passward"></p>
    <p><input type="submit" value="ログイン"></p>
    <p><a href='http://a1.zeroprm.com/b31_c467/examples/girls_login.php'>
	<img src='./images/account/back.png' id='back' alt='前のページへ' >
</a></p>
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

