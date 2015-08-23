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

		
			$connect = mysql_connect("localhost","b31_c588","b31_c588");
			mysql_query("SET NAMES utf8", $connect);

	if ($user) {
  try {
    // apiという召使いに対して me = 自分のアカウント情報をくれ という命令
    // 変数 $user_profileには自分がFacebookに登録しているアカウント情報が入っています
    // 取得したデータを画面に表示するプログラムは下の方に書いてあります。var_dumpというところ。
    // /me と書いたので自分の情報が表示されていますが、/me/XXX とXXXのところにある文字を入れると
    // 自分の、XXXな情報を取得することができます。(これが次の課題です。)
    $fridnds_data = $facebook->api('/me/friends');
    $my_profile = $facebook->api('/me');


   //  $friend;
   //  
   //  foreach($friends_data['name'] as $friends_data){
   //        var_dump($friend['name']);
   //        echo"<br>";
   //          $i++;
   // }

    //session_start();
    $name = $_SESSION['username'];
    $data = mysql_db_query("b31_c467", "select * from User_profile where name = '$name'");
    //$user = mysql_fetch_assoc($data);


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


//$name = $user['name'];
?>

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
	<h1>マイプロフィール編集</h1>

	<form action="girls_editkakunin.php" method="GET">
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
				<td><input type="text" name="name" value="<?php
	echo$name; ?>"></td>
			</tr>
			<tr>
				<td>性別</td>
				<td><label><input type="radio"  name="gender" value="男" >男</label>
	<label><input type="radio" name="gender" value="女" checked>女</label></td>
			</tr>
			<tr>
				<td>年齢</td>
				<td><input type="number" class="register" name="old" min="5" max="99" value="15"></td>
			</tr>
			 <tr>
			 	<dl>
 <td>都道府県</td>
 <dd>
 <td>
 	<select name="pref" id="pref">
<?php
$prefs = array('北海道','青森県','岩手県','宮城県','秋田県','山形県','福島県',
'茨城県','栃木県','群馬県','埼玉県','千葉県','東京都','神奈川県','新潟県','富山県',
 '石川県','福井県','山梨県','長野県','岐阜県','静岡県','愛知県','三重県','滋賀県', 
 '京都府','大阪府','兵庫県','奈良県','和歌山県','鳥取県','島根県','岡山県','広島県', 
 '山口県','徳島県','香川県','愛媛県','高知県','福岡県','佐賀県','長崎県','熊本県','大分県','宮崎県','鹿児島県','沖縄県');
foreach($prefs as $pref){
	if($prefs == '東京都'){
		print('<option value="' . $pref . '  selected">' . $pref. '</option>');
	}else{
    print('<option value="' . $pref . '">' . $pref. '</option>');
 }
}
 ?>
 </select>
 </td>
 </tr>
</dd>
</dl>
			<tr>
				<td>得意デザイン</td>
				<td><p><label><input type="radio"  class="register"  name="design"  value="illustrator" checked>illustrator</label>
	<label><input type="radio"  class="register" name="design" value="photoshop" >photoshop</label>
	<label><input type="radio" class="register" name="design" value="AfterEffect" >AfterEffect</label>
			</tr>
			<tr>
				<td>得意アプリケーション（例、スマホアプリ）</td>
				<td><p><label><input type="radio"  class="register" name="program"  value="IOSアプリ" checked>IOSアプリ</label>
	<label><input type="radio" class="register" name="program" value="Androidアプリ" >Androidアプリ</label>
	<label><input type="radio" class="register" name="program" value="Webアプリ" >Webアプリ</label>
			</tr>
				<tr>
				<td>その他、得意、お気に入りのツール</td>
				<td><input type="text" class="register" name="others" value="(例)　Scrach" ></label></td>
			</tr>
			<tr class="matsu">
				<td>一言</td>
				<td><textarea name="comment"  class="register" value="(例)　Scrach" width="20" height="60"  >(例)一緒に開発する仲間募集中です！</textarea></td>
			</tr>
		
</tbody>
</table>

	<input type="submit" id='save' value="確認">
	</form>

<script>
$(function(){
	if(localStorage.getItem('register')){
		$('#register').val(localStorage.getItem('register'));
	}
	
	//保存ボタン
	$('#save').click(function(){
		localStorage.setItem('register',$('#register').val());
		console.log(localStorage.getItem('register'));
	});
});
</script>
</body>
</html>