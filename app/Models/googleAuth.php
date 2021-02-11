<?php

$google_client = new Google\Client();

$google_client->setClientId('662087267373-pnt38uracj02i9gj1a7itqpt3d6hsklq.apps.googleusercontent.com');

$google_client->setClientSecret('UkGukwl_VSb9orO_Jt3TOr5L');

$google_client->setRedirectUri('http://dix.net.br');

$google_client->addScope('email');
$google_client->addScope('profile');

if(isset($_GET["code"])){
	$token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

	if(!isset($token['error'])){
		$google_client->setAccessToken($token['access_token']);
		$_SESSION['access_token'] = $token['access_token'];

		$google_service = new Google_Service_Oauth2($google_client);

		$data = $google_service->userinfo->get();
		$registerGoogleAuth = new App\Models\registroUsuario();
		if($registerGoogleAuth->verificaEmail($data['email'])){
			$registerGoogleAuth->newUserAuth($data['email'], $data['name'], $data['id']);
			header("Location: http://dix.net.br");
		}else{
			$loginGoogleAuth = new App\Models\loginUsuario();
			$loginGoogleAuth->loginAuth($data['email'], $data['id']);
			header("Location: http://dix.net.br");
		}
		unset($_SESSION['access_token']);
	}
}

?>