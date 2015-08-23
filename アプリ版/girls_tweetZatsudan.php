<?php
$connect = mysql_connect("localhost","b31_c467","b31_c467");

//SQLをUTF8形式で書くよ、という意味
mysql_query("SET NAMES utf8",$connect);

//登録された時間の新しい時間に並べて表示したい
//この１行で実行
$test = "b31_c467";

$rs = mysql_db_query("b31_c467","select * from tweet_tbl order by tseet_time desc");

//$data = mysql_fetch_assoc($rs);


session_start();

if(isset($SESSION['user_id'])){
  $my_id = $SESSION['user_id'];
}else{
  $my_id = 0;
}


if(isset($_SESSION['username'])){
  $name = $_SESSION['username'];
}else{
  $name = "名無しさん";
}

$user = mysql_db_query("b31_c467","select * from User_profile where id = $my_id ");

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

    </style>

    <title>Twitter風掲示板</title>

    <!-- Bootstrap core CSS -->
    <link href="css/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="css/assets/js/ie-emulation-modes-warning.js"></script>

    <link rel ="stylesheet" type="text/css" href="examples/top.css">
<link rel ="stylesheet" type="text/css" href="examples/table.css">
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>

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
          <a class="navbar-brand" href="tweet.php">雑談:<?php echo$name; ?></a>
        </div>
      </div>
    </nav>

        <div class="col-md-3">
          
          <form action ="tweet_inf.php" method="GET">
            <br>
            投稿する動画URLとコメントを入力しよう！(100字以内)<br> 
            タイトル:<textarea name="title" cols="30" rows="1"></textarea><br>
             URL:<textarea name="url" cols="30" rows="1"></textarea><br>
            書き込み：<textarea name="contents" cols="40" rows="4"></textarea>
            <br>
            
            <input type="submit" value="投稿" class="btn btn-primary" >
          </form>
          <h2><a href="http://firestorage.jp/">URLの作り方！</a></h2>
        </div>
        <a class='btn' id='back' href='http://a1.zeroprm.com/b31_c467/examples/girls_Top.php'>トップへ</a>
        <div class="col-md-9">

          <div class="table-responsive">
            <p>ここに投稿を表示する。</p>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>投稿時間   :
                    名前</th>
                  <th>タイトル(URL)</th>
        
                  <th>投稿内容</th>
                  
                  <th>イイネ</th>
                  <th>コメント・編集</th>
                </tr>
              </thead>
              <tbody>
<?php
while(true){
  $row = mysql_fetch_assoc($rs);

  if($row == null){
    break;
  }else if($row['account_name'] == $name){
    $id = $row['tweet_id'];

    echo "
    <tr>
    <td>{$row['tseet_time']} ： <a href='http://a1.zeroprm.com/b31_c467/examples/Girls_myprofile.php'>{$row['account_name']}
     </a></td>
    <td><a href='{$row['url']}'>{$row['title']}</a></td>
    <td>{$row['contents']}</td>
    <td>
    <form action='girls_apliine.php' method='GET'>
    <input type='submit'  value='イイネを見る'>:<a>".
     $row['iine']."</form></td>
    <td><form action='girls_apl_del.php' method='GET'>
    <input type='hidden' name='id' value='".$id."'>
    <input type='submit' value='削除' class='btn-primary'>
    </form></td>
    </tr>
    </form>"; 
  }else{
    echo "
    <tr>
    <td>{$row['tseet_time']} ：  <form action='girls_Userprofile.php' method='GET'>
     <input type='hidden' name='username' value='".$row['account_name']."'>
     <input type='submit' class='btn-primary' value='".$row['account_name']."'>
     </form></td>
    <td></td>
    <td name='contents'>{$row['contents']}</td>
    <td><form action='girls_apliine.php' method='GET'>
    <input type='hidden' name='tweet_id' value='".$row['tweet_id']."'>
    <input type='hidden' name='account_name' value='".$row['account_name']."'>
     <input type='submit'  class='btn-primary' value='イイネ'>:<a class='btn-primary'>".
     $row['iine']."</a>
     </form></td>
  <td><form action='girls_aplicom.php' method='GET'>
       <input type='hidden' name='tweet_id' value='".$row['tweet_id']."'>
    <input type='hidden' name='account_name' value='".$row['account_name']."'>
    <input type='hidden' name='account_name' value='".$row['account_name']."'>
    <input type='submit'  class='btn-primary' value='コメント'>:<a class='btn-primary'>".
     $row['comment']."</a>
     </form></td>
   </tr>";
  }
}

echo"</tbody>
   </table>";

//データベースとの接続を切る
mysql_close($connect); 


?>
              </tbody>
            </table>
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
