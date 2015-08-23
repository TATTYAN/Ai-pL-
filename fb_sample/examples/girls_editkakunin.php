<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>マイページ(編集)</title>

<link rel ="stylesheet" type="text/css" href="top.css">
<link rel ="stylesheet" type="text/css" href="table.css">
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>


</head>
<body>

<?php
$connect = mysql_connect("localhost","b31_c467","b31_c467");
			mysql_query("SET NAMES utf8", $connect);



$name = $_GET['name'];

$_SESSION['username'] = $name;

$gender = $_GET['gender'];
$old = $_GET['old'];

echo"名前：".$name."</br>";
echo"性別：".$gender."</br>";
echo"年齢：".$old."</br>";


if(isset($_GET['pref'])){
	$pref = $_GET['pref'];
	echo"都道府県：".$pref."</br>";
}else{
	$pref = "";
	echo"選択してません</br>";
}

if(isset($_GET['purpose'])){
	$purpose = $_GET['purpose'];
	echo"利用目的".$purpose."</br>";
}else{
	$purpose = "";
	echo"選択してません</br>";
}

if(isset($_GET['twitter'])){
	$twitter = $_GET['twitter'];
	echo"利用目的".$twitter."</br>";
}else{
	$twitter = "";
	echo"選択してません</br>";
}

if(isset($_GET['facebook'])){
	$facebook = $_GET['facebook'];
	echo"利用目的".$facebook."</br>";
}else{
	$facebook = "";
	echo"選択してません</br>";
}

if(isset($_GET['github'])){
	$github = $_GET['github'];
	echo"利用目的".$github."</br>";
}else{
	$github = "";
	echo"選択してません</br>";
}



if(isset($_GET['design'])){
	$design = $_GET['design'];
	echo"得意なデザイン:".$design."</br></br>";
	// foreach($_GET[design] as $value ){
 // 	   $i=1;
	// 	echo$design[$i].",";
	// 	$i++;
	//}
}else{
	$design = "";
}




if(isset($_GET['program'])){
	$program = $_GET['program'];
	echo"得意なプログラム:".$program."</br>";
	// foreach($_GET[program] as $value ){
 // 	   $j=1;
	// 	echo$program[$j].",";
	// 	$j++;
	// }
}else{
	$program = "";
}

echo"</br>";


if(isset($_GET['others'])){

	$others = $_GET['others'];
	echo"その他得意な技術：".$others."</br>";
}else{
	$others = "";
}

if(isset($_GET['comment'])){
$comment = $_GET['comment'];
echo$comment."</br></br>";
}else{
	$comment = "";
}

//session_start();

echo"<a class='btn' id='back' href='http://a1.zeroprm.com/b31_c467/examples/Girls_myprofile.php'>プロフィールへ</a>";

//mysql_db_query("b31_c467","UPDATE User_profile SET(gender,old,addres,purpose,twitter,facebook,github,design , program,others,comment) values('$gender',$old,'$pref','$purpose','$twitter','$facebook','$github','$design', '$program','$others','$comment')");
mysql_db_query("b31_c467", "UPDATE User_profile  SET gender='$gender',old=$old,pref='$pref',purpose='$purpose',twitter='$twitter',facebook='$facebook',github='$github',design='$design' , program='$program',others='$others',comment='$comment'  where name='{$_SESSION['username']}'");

// if(isset($_SESSION['id'])){

// }else 
// if(isset($_SESSION['name'])){
// 		$_SESSION['id'] = mysql_db_query("b31_c467","SELECT id FROM User_profile where name = '{$_SESSION['name']}'");
// 	}else{
// 		header("Location: http://a1.zeroprm.com/b31_c467/examples/girls_login.php");
// 	}
	header("Location: http://a1.zeroprm.com/b31_c467/examples/Girls_myprofile.php");

?>

</body>
</html>

