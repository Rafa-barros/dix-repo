<?php

require_once("vendor/facebook/graph-sdk/src/Facebook/autoload.php");

$facebook = new \Facebook\Facebook([
	'app_id' => '1635473683301633',
	'app_secret' => '82730d7839e23486228aaa379cfe8366',
	'default_graph_version' => 'v2.10'
]);

$facebook_output = '';

$facebook_helper = $facebook->getRedirectLoginHelper();

if(isset($_GET['code'])){
	if(isset($_SESSION['access_token'])){
		$access_token = $_SESSION['access_token'];
	}else{
		$access_token = $facebook_helper->getAccessToken();
		$_SESSION['access_token'] = $access_token;
		$facebook->setDefaultAccessToken($_SESSION['access_token']);
	}

	$graph_response = $facebook->get("/me?fields=name,email,birthday", $access_token);

	$facebook_user_info = $graph_response->getGraphUser();
}

$facebook_permissions = ['email'];
$facebook_login_url = $facebook_helper->getLoginUrl('http://localhost:8080', $facebook_permissions);

?>