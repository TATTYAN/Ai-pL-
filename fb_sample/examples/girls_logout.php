<?php
require '../src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '334993866548043',
  'secret' => '9a185006487e4f063059f26f2aa32859',
));

// Get User ID
$user = $facebook->getUser();

if($user){
	$logoutUrl = $facebook->getLogoutUrl();
	facebookLogout();
	header("Location: $logoutUrl");
	header("Location: http://a1.zeroprm.com/b31_c467/examples/girls_login.php");
}
// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.


	function facebookLogout() {
			 	$facebook->destroySession();
			 	header("Locaiton: ".$logoutUrl);
	}
//session_start();
//$name = $_SESSION['username'];
if(isset($_SESSION['username'])){
session_unset($_SESSION['username']);
session_destroy($_SESSION['username']);
}

//$id = $_SESSION['id'];
if(isset($_SESSION['id'])){
	session_unset($_SESSION['id']);
}

//echo$_SESSION['username'];
echo"<a href='http://a1.zeroprm.com/b31_c467/examples/girls_login.php>ログアウトしました。</a>'";
header("Location: http://a1.zeroprm.com/b31_c467/examples/girls_login.php");

?>