<?php
include('template.php');
	$requete = $pdo->prepare("SELECT * FROM `user`");
if( $requete->execute() ){
  $resultats = $requete->fetchAll();
  //var_dump($resultats);
  
  $success = true;
  $data['nombre'] = count($resultats);
  $data = $resultats;
  $login = $_POST['id_g'] . $_POST['full_name'] . $_POST['email'];
  $id = 0;
  foreach ($data as $key => $value) {
   // echo $value['login'];
    if($login == $value['login'])
    {
      $_SESSION['logged_on_user'] = $login;
      print_r ($_POST);
      exit();
    }
    if($id >= $value['id'])
      $id = $value['id'];
    $id++;
  }
  $requete = $pdo->prepare("INSERT INTO `user` (`login`, `passwd`, `email`, `id`, `img_id`, `mail`) VALUES ('".$login."', 'oui', '".$_POST['email']."', '".$id."', '', 1);");
  if( $requete->execute() ){
    $success = true;
    $msg = 'user added';
    $_SESSION['logged_on_user'] = $login;
    echo $_POST['email'];
  } else {
    $msg = "user fail to added";
  }
}
?>