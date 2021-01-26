<?php

require("../../vendor/autoload.php");

$google_client = new Google\Client();

$google_client->setClientId('662087267373-pnt38uracj02i9gj1a7itqpt3d6hsklq.apps.googleusercontent.com');

$google_client->setClientSecret('UkGukwl_VSb9orO_Jt3TOr5L');

$google_client->setRedirectUri('http://localhost:8080/app/Models/googleAuth.php');

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
			$registerGoogleAuth->newUserAuth($data['email'], htmlentities($data['name']), $data['id']);
			header("Refresh:0");
		}else{
			$loginGoogleAuth = new App\Models\loginUsuario();
			$loginGoogleAuth->loginAuth($data['email'], $data['id']);
			header("Refresh:0");
		}
		unset($_SESSION['access_token']);
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>a</title>
	</head>
	<body>
		<?php
			echo '<a href="' . $google_client->createAuthUrl() . '"><img src="/app/View/assets/css/img/google-icon3.png" alt="ícone google" class="midia-icon"></a>';
		?>
	</body>
</html>