<?php
/*
examples.phpがわかりづらいと思うので
ここにexamples.phpを簡略化したプログラムを書いておきます。
これからの課題はこちらを参考にしてください。
*/

/*
このファイルの１つ上の階層のフォルダ(=../)にある
srcというフォルダの中にあるfacebook.php
(=facebook社から提供されたプログラム)を使うよ、という意味
*/
require '../src/facebook.php';

// ここにアプリのIDとパスワードを書きます
// 今回はこのままでOKです。
$facebook = new Facebook(array(
  'appId'  => '334993866548043',
  'secret' => '9a185006487e4f063059f26f2aa32859',
));

// $userにはfacebook社が１人１人に与えているidが入っています
// 大学生なら学籍番号、社会人であれば社員番号と同じイメージです。
$user = $facebook->getUser();

//ここのif文は「もしこのfacebookアプリにログインしていたら」という意味です。
//facebookアプリにログインしていないとfacebookから情報を貰ったり、
//情報を送ったりすることはできません。
if ($user) {
  try {
    // apiという召使いに対して me = 自分のアカウント情報をくれ という命令
    // 変数 $user_profileには自分がFacebookに登録しているアカウント情報が入っています
    // 取得したデータを画面に表示するプログラムは下の方に書いてあります。var_dumpというところ。
    // /me と書いたので自分の情報が表示されていますが、/me/XXX とXXXのところにある文字を入れると
    // 自分の、XXXな情報を取得することができます。(これが次の課題です。)
    $user_profile = $facebook->api('/me');
    $friends_info = $facebook->api('/me/friends');

            $connect = mysql_connect("localhost","b31_c467","b31_c467");

        mysql_query("SET NAMES utf8", $connect);


        // mysql_db_query("test","delete from book_tbl
        // where tweet_id = $tweet_id");

      $id = $_SESSION['id'];
      $name = $_SESSION['name'];

        $result = mysql_db_query("b31_c467","insert  sessionrensyu_tbl (id,name) values($id,'$name')");

     print_r($friends_info);
    
    //ログアウト用のURLを取得
    $logoutUrl = $facebook->getLogoutUrl();




  } catch (FacebookApiException $e) {
  	//途中で何かしらのエラーが発生したら
    error_log($e);
    $user = null;
  }
  
} else {//ログインしてなかったら
  $loginUrl = $facebook->getLoginUrl(array('scope' => 'publish_stream'));
}


?>
<!doctype html>
<html>
  <head>
    <title>facebook連携サンプル</title>
  </head>
  <body>
    <h1>Facebook連携サイト</h1>


    <?php 
    	//もしログインしていたら
    	if ($user){

        session_start();

        echo $_SESSION['id'];
        echo $_SESSION['name'];



    		//ログアウト用のリンクを表示する
    		echo "<a href= $logoutUrl >Logout</a></br>";
    		
    		//var_dumpとはechoとほとんど一緒の命令です
    		//このプログラムで画面に先ほど取得した自分の情報が表示されます
    		var_dump($user_profile);
    		
    	}else{
    		//ログイン用のリンクを表示する
    		echo "<a href= $loginUrl >Login with Facebook</a>";
    	}
    ?>
  </body>
</html>
