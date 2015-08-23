<?php

session_start();

if(isset($_SESSION['name'])){
	$name = $_SESSION['name'];
}else{
	$name = "";
}

$connect = mysql_connect("localhost","b31_c467","b31_c467");

//SQLをUTF8形式で書くよ、という意味
mysql_query("SET NAMES utf8",$connect);


	$tweet = mysql_db_query("b31_c467", "select * from tweet_tbl");
	$user =	mysql_db_query("b31_c467", "select * from User_profile");

//登録された時間の新しい時間に並べて表示したい
//この１行で実行
		$tweet_id = $_GET['tweet_id'];
		$account_name = $_GET['account_name'];


		$tweet = mysql_db_query("b31_c467","select * from tweet_tbl WHERE tweet_id={$_GET['tweet_id']}");

		$nusi = mysql_fetch_assoc($tweet);

	

	//$rs = mysql_db_query("b31_c467","select * from tweet_tbl order by tseet_time desc");

 	$usercomments = mysql_db_query("b31_c467","select * from ApliComment_tbl where userid = $tweet_id order by datetime desc");
 	
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <style>
      body{
        text-align: center;
        background-color: #FFBEDA;
      }

      #back{
        text-align: center;
      }

      .col-md-3{
      	margin-left: 38%;
      	margin-top: 3%;
      }

      .table-responsive{
        margin-top: 20%;
        margin-left: 8%;
      }

    </style>

    <title><?php echo$nusi['account_name']; ?>へのコメント</title>

    <!-- Bootstrap core CSS -->
    <link href="css/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
        <link rel ="stylesheet" type="text/css" href="examples/top.css">
<link rel ="stylesheet" type="text/css" href="examples/table.css">
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="css/assets/js/ie-emulation-modes-warning.js"></script>

    <div class="top"><a href="http://a1.zeroprm.com/b31_c467/examples/girls_login.php">

    	<div class="user">
    		<?php 
    			echo$nusi['account_name'].":";
				echo$nusi['contents'];

    		?>
    	</div>

		  <div class="col-md-3">
          
          <form action ="aplicomment_inf.php" method="GET">
            <br>
            コメントを入力しよう！(100字以内)<br> 
           <?php 
           //echo"<input type='hydden' name='".$name."'>
           echo"<input type='hidden' name='user' value='{$nusi['account_name']}'>";
           echo"<input type='hidden' name='userid' value='{$tweet_id}'>";
            //echo"<input type='hidden' name='me' value='{$name}'>";
           
           ?>
            書き込み：<textarea class="text" name="contents" cols="40" rows="4"></textarea>
            <br>
            
            <input type="submit" value="コメント" class="btn btn-primary" >
          </form>
        </div>
        <br> <br>
          <div class="table-responsive">
            <p>コメント一覧</p>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>時間 </th>
                   <th>名前</th>
                  <th>内容</th>
                </tr>
              </thead>
              <tbody>
        <?php
        	while(true){
        		$userrebue = mysql_fetch_assoc($usercomments);
        		if($userrebue == null){
        			break;
        		}else{
        			echo"<tr>
        			<td>{$userrebue['datetime']}</td>
        			<td>{$userrebue['user']}</td>
        			<td>{$userrebue['contents']}";
        			if(isset($_SESSION['username'])){
        				if($userrebue['user'] == $_SESSION['username']){
        				echo"<form action= 'g_aplicom_del.php' method='GET'>
        				<input type='hidden' name='user' value='{$userrebue['user']}'>
        				<input type='hidden' name='id' value='{$userrebue['com_id']}'>
        				<input type='submit' class='btn-primary' value='削除'>";
        				}
        			}
        			//echo$name;
        			echo"</td>
        			</tr>";
        		}
        	}
        	echo"</tbody>
        	</table>";

        ?>

        <a class="btn-primary" id="back" href="http://a1.zeroprm.com/b31_c467/girls_tweetZatsudan.php">戻る</a>
        <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="css/dist/js/bootstrap.min.js"></script>
    <script src="css/assets/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="css/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>



