<?php

require_once("vendor/facebook/graph-sdk/src/Facebook/autoload.php");

$facebook = new \Facebook\Facebook([
	'app_id' => '1635473683301633',
	'app_secret' => '82730d7839e23486228aaa379cfe8366',
	'default_graph_version' => 'v2.10'
]);

$facebook_helper = $facebook->getRedirectLoginHelper();

if(isset($_GET['state'])) {
    $facebook_helper->getPersistentDataHandler()->set('state', $_GET['state']);
}

if(isset($_GET['code']) && isset($_GET['state'])){
	if(isset($_SESSION['token_access'])){
		$token_access = $_SESSION['token_access'];
	}else{
		$token_access = $facebook_helper->getAccessToken();
		$_SESSION['token_access'] = $token_access;
		$facebook->setDefaultAccessToken($_SESSION['token_access']);
	}

	$graph_response = $facebook->get("/me?fields=name,email,birthday", $token_access);

	$facebook_user_info = $graph_response->getGraphUser();

	$registerFacebookAuth = new App\Models\registroUsuario();

	if(isset($facebook_user_info['email'])){
		if($registerFacebookAuth->verificaEmail($facebook_user_info['email'])){
			$registerFacebookAuth->newUserAuth(htmlentities($facebook_user_info['email']), htmlentities($facebook_user_info['name']), $facebook_user_info['id']);
			// header("Location: /home");
		}else{
			$loginFacebookAuth = new App\Models\loginUsuario();
			$loginFacebookAuth->loginAuth($facebook_user_info['email'], $facebook_user_info['id']);
			header("Location: /home");
		}
		unset($_SESSION['token_access']);
	}
}

$facebook_permissions = ['email'];
$facebook_login_url = $facebook_helper->getLoginUrl('https://dix.net.br', $facebook_permissions);

?>