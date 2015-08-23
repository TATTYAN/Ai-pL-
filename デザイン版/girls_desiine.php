<?php
$connect = mysql_connect("localhost","b31_c467","b31_c467");
			mysql_query("SET NAMES utf8", $connect);

			$tweet = mysql_db_query("b31_c467", "select * from Webdesigntweet_tbl");
			$user =	mysql_db_query("b31_c467", "select * from User_profile");

			mysql_db_query("b31_c467","UPDATE User_profile SET iine=iine+1 WHERE id={$_GET['id']}");
			//////ここを変える
			mysql_db_query("b31_c467","UPDATE destweet_tbl SET iine=iine+1 WHERE id={$_GET['id']}");
			//////
			mysql_close($connect);
			//////ここを変える
			header("Location: http://a1.zeroprm.com/b31_c467/girls_designZatsudan.php");

?>