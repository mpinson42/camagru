<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<?php
require 'vendor/autoload.php';
if (!session_id()) {
    session_start();
}
$fb = new Facebook\Facebook([
  'app_id' => '958105207701084',
  'app_secret' => 'cbf2f50ebe27e71fc4ec50383e4b3477',
  'default_graph_version' => 'v2.2',
  ]);
$helper = $fb->getRedirectLoginHelper("http://localhost:8080/back/facebook2.php");
$permissions = ['email'];
$loginUrl = $helper->getLoginUrl('http://localhost:8080/back/facebook2.php', $permissions);
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<a class="oui" href=<?php echo htmlspecialchars($loginUrl) ?> ></a>
</body>
	<script> setTimeout(function(){ document.location.href=$('.oui').attr('href') }, 100);</script>
</html>