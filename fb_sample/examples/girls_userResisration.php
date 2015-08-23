
<?php
function showOption($start, $end, $step =1){
	for ($i = $start; $i<=$end; $i += $step) {
		print ('<option value="'.$i.'">'.$i.'</option>');
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>ユーザー登録</title>
<link rel ="stylesheet" type="text/css" href="account.css">
<link rel ="stylesheet" type="text/css" href="table.css">
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>

	<style>

		body{
			text-align: center;
		}
	</style>
</head>
<body>
<h3>会員登録フォーム</h3>
<form method="POST" action="girls_Resistered.php">
	<div class="containe">
		<label for="title">名前</label><br />
		<textarea class="text" id="title" name="name"
			cols="40" maxlength="30" ></textarea>
	</div>
	<div class="container">
		<label for="title">メールアドレス</label><br />
		<input type="email" id="mailaddress" name="mailaddress" size="30" maxlength="50"/>
	<div class="container">
		<label for="title">パスワード</label><br />
		<input type="password" id="password" name="password" size="10" maxlength="40"/>
	</div>
	<input type="submit" value="登録"/>
</form>
<br><br>
<div id="back-bt">
	<a href="http://a1.zeroprm.com/b31_c467/examples/girls_loginselect.php">
	<img src="./images/account/back.png" id="back" alt="前のページへ" >
</a>
</body>
