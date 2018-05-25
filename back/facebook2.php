<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
  
</body>

<?php
include('template2.php');
require 'vendor/autoload.php';
if(!session_id()) {
    session_start();
}
$fb = new Facebook\Facebook([
  'app_id' => '958105207701084',
  'app_secret' => 'cbf2f50ebe27e71fc4ec50383e4b3477',
  'default_graph_version' => 'v2.2',
  ]);
$helper = $fb->getRedirectLoginHelper();
try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}
$token = $accessToken->getValue();
$oAuth2Client = $fb->getOAuth2Client();
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
if (! $accessToken->isLongLived()) {
  try {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } catch (Facebook\Exceptions\FacebookSDKException $e) {
    exit;
  }
}
  try {
  $response = $fb->get(
    '/'.$tokenMetadata->getUserId().'?fields=email,name',
    $accessToken->getValue()
  );
} catch(FacebookExceptionsFacebookResponseException $e) {
  exit;
} catch(FacebookExceptionsFacebookSDKException $e) {
  exit;
}
$graphNode = $response->getGraphNode();;
  $requete = $pdo->prepare("SELECT * FROM `user`");
if( $requete->execute() ){
  $resultats = $requete->fetchAll();
  
  $success = true;
  $data['nombre'] = count($resultats);
  $data = $resultats;
  $login = $tokenMetadata->getUserId() . $graphNode->getField('name') . $graphNode->getField('email');
  $id = 0;
  foreach ($data as $key => $value) {
    if($login == $value['login'])
    {
      $_SESSION['logged_on_user'] = $login;
      ?><script> setTimeout(function(){ document.location.href='http://localhost:8080/html/montage.php' }, 100);</script><?php
      exit();
    }
    if($id >= $value['id'])
      $id = $value['id'];
    $id++;
  }
  $requete = $pdo->prepare("INSERT INTO `user` (`login`, `passwd`, `email`, `id`, `img_id`, `mail`) VALUES ('".$login."', 'oui', '".$graphNode->getField('email')."', '".$id."', '', 1);");
  if( $requete->execute() ){
    $success = true;
    $msg = 'user added';
    $_SESSION['logged_on_user'] = $login;
    ?><script> setTimeout(function(){ document.location.href='http://localhost:8080/html/montage.php' }, 100);</script><?php
  } else {
    $msg = "user fail to added";
  }
} else {
  $msg = "Une erreur s'est produite";
}
?>
</html>