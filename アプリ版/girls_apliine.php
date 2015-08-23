<?php
$connect = mysql_connect("localhost","b31_c467","b31_c467");
			mysql_query("SET NAMES utf8", $connect);

			$tweet = mysql_db_query("b31_c467", "select * from tweet_tbl");
			$users = mysql_db_query("b31_c467", "select account_name from tweet_tbl WHERE tweet_id={$_GET['tweet_id']}");
			$user = mysql_fetch_assoc($users);

			//mysql_db_query("b31_c467","UPDATE User_profile SET iine=iine+1 WHERE id={$_GET['id']}");
			mysql_db_query("b31_c467","UPDATE tweet_tbl SET iine=iine+1 WHERE tweet_id={$_GET['tweet_id']}");

			mysql_db_query("b31_c467","UPDATE User_profile SET iine=iine+1 WHERE name ={$user['name']}");

			mysql_close($connect);

			header("Location: http://a1.zeroprm.com/b31_c467/girls_tweetZatsudan.php");

?>