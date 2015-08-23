<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Creative - Start Bootstrap Theme</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">

    <script type="text/javascript" src="jquery-1.11.3.min.js"></script>
    
    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/PrefecturePullDown.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="css/animate.min.css" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="creative.css" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="../../../../../wp-content/themes/minimatica/uikit.css" media="all">
<link rel="stylesheet" href="css/uikit.css" media="all">
<script src="js/uikit.min.js"></script>
<script src="pulldown.js"></script>

</head>



<body id="event">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Start Bootstrap</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="change-header-02 collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right" style="padding:0px;">
                    <li>
                        <a class="page-scroll" href="http://a1.zeroprm.com/b31_c467/Pla*pla%E2%88%80/fb_sample/examples/mypage.php">BACK</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="login.html">login</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#portfolio">Portfolio</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

	<div class="uk-container uk-container-center">
	<h1 style="margin-top: 100px;">イベント情報</h1>
	</div>


<div class="uk-container uk-container-center">
	<ul class="uk-grid uk-grid-width-1-4" style="padding: 0;">
		<li><a href="">日付</a></li>
		<ul id="menu">

<li>都道府県

<ul>

<li><a href="#">東京都</a></li>

<li><a href="#">大阪府</a></li>

<li><a href="#">愛知県</a></li>

</ul>
</li>
</ul>
        <li><a href="">性別</a></li>
        <li><a href="http://a1.zeroprm.com/b31_c467/GoogleMap.html" target="_blank">マップ</a></li>
    </ul>
</div>
<?php

set_time_limit(120);
///↓facebook連携
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

//$logoutUrl = $facebook->getLogoutUrl();

//db接続
$connect = mysql_connect("localhost","b31_c467","b31_c467");
            mysql_query("SET NAMES utf8", $connect);

            $url = "";


//facebookログイン認証
if ($user){//fbログイン時
     try {
    // apiという召使に対して me = 自分のアカウント情報をくれ という命令
    // $usersには自分がFacebookに登録しているアカウント情報が入っています
      $users = $facebook->api('/me');
     //$userold_profile = $facebook->api('/me/gender');
       } catch (FacebookApiException $e) {
        error_log($e);
        $user = null;
       }
 }


     if($user){  //facebookにログインしてる場合
        $logoutUrl = $facebook->getLogoutUrl();

        $fbname = $users['name'];
        //DBに既に登録されてるかチェック。

        //$fbdata = mysql_db_query("b31_c467","select * from users where name = '$fbname'");
        $fbdata = mysql_db_query("b31_c467","select * from users");
        $users = mysql_fetch_assoc($fbdata);

        $fbuser = mysql_db_query("b31_c467","select * from users where name = $fbname");

        //session_start();
        $_SESSION['username'] = $fbname;

            if(!isset($fbuser)){
                echo$fbname."さんを登録しました。";
                //今登録したユーザー
                mysql_db_query("b31_c467","insert  users (username)  values('$fbname')");
            }

        //$name = $fbname;
            if(isset($_SESSION['username'])){
                $name = $_SESSION['username'];
            }else{
                $name = "ゲスト";
            }
        
         echo"facebookログイン中";

     }else{//facebookログアウト
            $loginUrl = $facebook->getLoginUrl();
         if(isset($_SESSION['username'])){ //メールログインもしくはfbログアウト前
            //echo"セッション中";

            if(isset($_SESSION['username']) && isset($fbuser)){ //facebookでログアウトの正式な処理
                session_unset($_SESSION['username']);
                session_destroy($_SESSION['username']);
                header("Location: http://localhost/KyotoHackson/fb_sample/examples/plaplTop.php");
            }else{//メールでログインしてる場合
                $result1 = mysql_db_query("b31_c467","select * from users where username ='{$_SESSION['username']}'");

                $data = mysql_fetch_assoc($result1);
                $url = "http://localhost/KyotoHackson/fb_sample/examples/PlaplLogout.php";
                echo$data['username'];
                if(isset($data['username'])){
                    $name = $data['username'];
                }else{//何かしらのエラーによるセッションを消す。
                    //session_unset($_SESSION['username']);
                    //header("Location: http://localhost/KyotoHackson/fb_sample/examples/plaplTop.php");
                    $name = "ゲスト";
                }
            }
        }else{//何でもログインしてない場合
            $name = "ゲスト";
            $url = "#tomypage";
            //echo"ログアウト中";
        }
        //echo"ログアウト中";
    }
    
    function facebookLogout() {
                $facebook->destroySession();
                header("Locaiton: ".$logoutUrl);
    }

    // $email = $data['email'];
//google calender情報
// $reqURL="https://www.googleapis.com/calendar/v3/calendars/".$email."/events";

echo$reqURL;

//google calender情報
$calId = "2rjkpjtbu40ehubsr5273ei08s%40group.calendar.google.com";
$feedURL = "http://www.google.com/calendar/feeds/$calId/public/basic?futureevents=false&orderby=starttime&sortorder=ascending";
$sxml = simplexml_load_file($feedURL);
$schedule = array();
foreach ($sxml->entry as $entry) {
	$title = stripslashes($entry -> title);
	$content = stripslashes($entry -> content);
	$content = ltrim($content, '開始日: ');
	$content =  substr($content, 0, 10);
	$content = mb_convert_encoding($content, "utf-8");
	//chr($content);
	//$location = stripslashes($entry -> children('gd', true) -> where -> attributes() -> valueString);
 	//echo '<span class="xxxx">' .$title . '<br/>' . $content . '</span>';
 	$schedule_count = array_push($schedule, $content);
}

//eventcast情報
$rss =  'http://clip.eventcast.jp/api/v1/Search?';
$xml = simplexml_load_file($rss);
$data = get_object_vars($xml);
/*

*/
//eventとscheduleのマッチング

echo '<div class="uk-container uk-container-center uk-grid-match" data-uk-grid-match="{target:.uk-panel}">';
echo '<ul class="uk-grid uk-grid-divider uk-grid-width-medium-1-2 uk-grid-width-large-1-3"  data-uk-grid-margin>';


//userのスケジュールを配列に保存
foreach($data['Items']->Item as $item){
    if(!array_search($item->StartDate, $schedule)){
        echo '<li class="uk-panel"><div class="panel-02" style="background-color: white;"><h2>' . $item->Title . '</h2>';
        echo '<p><詳細></p>';
        echo '<p><a href='.$item->Url.'>' . $item->Url . '</a></p>';
        echo '<p>' . $item->StartDate . 'から</p>';
        echo '<p>' . $item->EndDate . 'まで</p>';
        echo '<p>' . $item->Location->Location["Value"] . '</p>';
        echo '<p>' . $item->Tags->Tag->Name . '</p>';
        $startdate = str_replace("/", "", $item->StartDate);
          $enddate = str_replace("/", "", $item->EndDate);
        $curl = "http://www.google.com/calendar/event?"
           ."action="."TEMPLATE"
           ."&text=".$item->Title
           ."&details=".""
           ."&location=".$item->Location->Location["Value"]
           ."&dates="  .$startdate."/".$enddate;
        echo '<p style="text-align:center; background-color: red; color:white;">行く</p>';
        echo "<p style='text-align:center; background-color: green; color:white;' ><a href='".$curl."' target='_blank' style='color:white;'>カレンダー登録</a></p></div></li>";
        
        // var_dump($item->StartDate);
    }
}
echo"<a href='http://localhost/KyotoHackson/fb_sample/examples/mypage.php#about'>戻る</a>";
echo '</ul></div>';
//eventの配列でループを回し、userスケジュールの配列に同じ日時があるかないかを検証

	//同じ日時があればeventは非表示
	//同じ日時がなければeventは表示
?>

<script>
<!--
jQuery( function() {
    jQuery( '#jquery-sample-button' ) . toggle(
        function() {
            jQuery . ajax( {
                url: 'ajaxsample1.html',
                success: function( data ) {
                    jQuery( '#jquery-sample-ajax' ) . html( data );
                    jQuery( '#jquery-sample-textStatus' ) . text( '読み込み成功' );
                },
                error: function( data ) {
                    jQuery( '#jquery-sample-textStatus' ) . text( '読み込み失敗' );
                }
            } );
        },
        function() {
            jQuery( '#jquery-sample-ajax' ) . html( '' );
            jQuery( '#jquery-sample-textStatus' ) . text( '' );
        }
    );
} );
// -->
</script>
</body>
</html>
