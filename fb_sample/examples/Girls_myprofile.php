
<?php

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
//echo$user;
		
			
	if ($user) {
  try {
    // apiという召使いに対して me = 自分のアカウント情報をくれ という命令
    // 変数 $User_profileには自分がFacebookに登録しているアカウント情報が入っています
    // 取得したデータを画面に表示するプログラムは下の方に書いてあります。var_dumpというところ。
    // /me と書いたので自分の情報が表示されていますが、/me/XXX とXXXのところにある文字を入れると
    // 自分の、XXXな情報を取得することができます。(これが次の課題です。)
    // $fridnds_data = $facebook->api('/me/friends');
    // $gender_data = $facebook->api('/me/gender');


   //  $friend;
   //  
   //  foreach($friends_data['name'] as $friends_data){
   //        var_dump($friend['name']);
   //        echo"<br>";
   //          $i++;
   // }


$tmp = $facebook->api(array(
  'method' => 'fql.query',
  'query' => "select name from user where uid=me()",
));

  } catch (FacebookApiException $e) {
  	//途中で何かしらのエラーが発生したら
    error_log($e);
    $user = null;
  }
  
} else {//ログインしてなかったら
  $loginUrl = $facebook->getLoginUrl(array('scope' => 'publish_stream'));
}

//db接続
$connect = mysql_connect("localhost","b31_c467","b31_c467");
			mysql_query("SET NAMES utf8", $connect);
			
		
				$result = mysql_db_query("b31_c467","select * from User_profile where id = '{$_SESSION['id']}'");
			echo$_SESSION['id'];

			$mydata = mysql_fetch_assoc($result);


?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>マイページ</title>

<link rel ="stylesheet" type="text/css" href="top.css">
<link rel ="stylesheet" type="text/css" href="table.css">
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<style>
	body{
		text-align: center;
	}

</style>

</style>
</head>
<body>
	<h1><?php echo$_SESSION['username'];?>のマイプロフィール</h1>

	<table>
			<thead>
				<tr>
					<th class='dothesort' data-type="string">項目<span></span></th>
					<th class='dothesort' data-type="string">内容<span></span></th>			
				</tr>
				
			</thead>
		<tbody>
			<tr>
				<td>名前</td>
				<td><?php
				if(isset($_mydata['name'])){
							echo$_mydata['name'];
				}else{
					echo"名無しさん";
				}
	  ?></td>
			</tr>
				<tr>
				<td>性別</td>
				<td><?php echo$mydata['gender'] ?></td>
			</tr>
			<tr>
				<td>年齢</td>
				<td><?php echo$mydata['old'] ?></td>
			</tr>
			<tr>
				<td>都道府県</td>
				<td><?php echo$mydata['pref'] ?></td>
			</tr>
			<tr>
				<td>得意デザイン</td>
				<td><?php 
				if($mydata['design'] != null){
					echo$mydata['design'];
				}
				?></td>
			</tr>
			<tr>
				<td>得意アプリケーション（例、スマホアプリ）</td>
				<td><?php 
				if($mydata['program'] != null){
					echo$mydata['program'];
					} ?></td>
			</tr>
				<tr>
				<td>その他、お気に入りのツール</td>
				<td><?php if($mydata['others'] != null){
					echo$mydata['others'];
					}  ?></td>
			</tr>
			<tr>
				<td>一言</td>
				<td><?php 
				if($mydata['comment'] != null){
					echo$mydata['comment'];
					}  ?>
				</td>
			</tr>
</tbody>
</table>

<p style="text-align:center;">
<a class='btn'  id='back' href='http://a1.zeroprm.com/b31_c467/examples/girls_edit.php'>プロフィールを編集する</a>
</p>

</div>

<div id="back-bt" style="text-align:center;">
	<a href="http://a1.zeroprm.com/b31_c467/examples/girls_Top.php">
	<img src="./images/account/back.png" id="back" alt="前のページへ" >
</a>
</div>

 <!-- <input type="reset" value="取消"> -->

</body>
</html>