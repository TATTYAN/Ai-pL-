<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Twitter風掲示板</title>

    <!-- Bootstrap core CSS -->
    <link href="css/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="css/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="tweet.php">Twitter風掲示板</a>
        </div>
        
      </div>
    </nav>

        <div class="col-md-3">
          <form action ="tweet_fin.php" method="GET">
            <br>
            ツイート内容を入力してください。<br> 
            <textarea name="contents" cols="40" rows="4"></textarea>
            <br>
            
            <input type="submit" value="ツイート" class="btn btn-primary" >
          </form>
        </div>

        <div class="col-md-9">

          <div class="table-responsive">
            <p>ここにツイートを表示する。</p>
<?php


$connect = mysql_connect("localhost","b31_c467","b31_c467");

//SQLをUTF8形式で書くよ、という意味
mysql_query("SET NAMES utf8",$connect);


$contents = $_GET["contents"];
$url = $_GET["url"];
$title = $_GET["title"];

$len = mb_strlen($contents,"utf-8");
$len2 = mb_strlen($url,"utf-8");
$len3 = mb_strlen($title,"utf-8");

session_start();

//セッション
if(isset($_SESSION['username'])){
  $name = $_SESSION['username'];

}else{
  echo"<script>";
    echo"alert('書き込みは会員のみ行えます。会員サイトへ移動します。');";
  echo"</script>";

  //echo"{$_SESSION['username']}";
  header("Location: http://a1.zeroprm.com/b31_c467/examples/girls_loginselect.php");
  die;
}

if($len == 0 || $len2 == 0 || $len3 == 0){
  echo "空白です。タイトル、本文、作品urlを全て記載して下さい。";
}else if($len > 200 || $len2 > 200 || $len3 > 30){
  echo "文字数オーバーです。200字以内で入力して下さい。タイトルは３０字以内で入力して下さい。";
}else{
  //b31_c467というデータベースに対してSQLを実行する 
  mysql_db_query( "b31_c467", "insert tweetdes_tbl(account_name,title,url,contents,tseet_time)
  values('$name','$title','$url','$contents',sysdate())" );

  echo "ツイートしました";
  header("Location: http://a1.zeroprm.com/b31_c467/girls_designZatsudan.php");
}


echo"<a href='http://a1.zeroprm.com/b31_c467/girls_designZatsudan.php'>
 戻る</a>";

//データベースとの接続を切る
mysql_close($connect);
?>
       </div>
        </div>


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
