<?php
$connect = mysql_connect("localhost","b31_c467","b31_c467");

//SQLをUTF8形式で書くよ、という意味
mysql_query("SET NAMES utf8",$connect);

//登録された時間の新しい時間に並べて表示したい
//この１行で実行
$test = "b31_c467";

//$tweet_id = $_GET['{$row['tweet_id'];

$del_id = $_GET['$id'];

$rs = mysql_db_query("b31_c467","select * from tweetdes_tbl where tweet_id = $del_id");

$deldata = mysql_fetch_assoc($rs);

$name = $deldata['name'];
$time = $deldata['time'];
$contents = $deldata['contents'];
$del =  $deldata['delete'];


$rs = mysql_db_query("b31_c467","select * from tweetdes_tbl");

mysql_db_query("b31_c467","delete  from tweetdes_tbl where tweet_id = $del_id");

 //where tweet_id = $del_id

// $deldata = mysql_fetch_assoc($rs);

// $name = $deldata['name'];
// $time = $deldata['time'];
// $contents = $deldata['contents'];
// $del =  $deldata['delete'];

header("Location: http://a1.zeroprm.com/b31_c467/girls_designZatsudan.php");

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>雑談</title>
<style>
	body{
		text-align: center;
	}
</style>
</head>
<body>
	<h1>出会い系</h1>

<form method="POST" action="girls_desdelkanrou.php">
	<?php
	echo$name."<br>";
	echo$time."<br>";
	echo$contents."<br>";
	echo"本当にこれらを削除してもよろしいですか？<br>";
	?>

 <input type="submit" value="削除">
 <!-- <input type="reset" value="取消"> -->
</form>

</body>
</html> 