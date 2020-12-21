<?php

require('./Connect_bdd.php');

if (isset($_POST['inscription'])){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $cin = $_POST['cin'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $query = new Query_bdd();
    echo $query->inscription($nom, $prenom, $cin, $email, $phone, $password);
}


if (isset($_POST['connexion'])):
  $mail = $_POST['email'];
  $password = $_POST['password'];

  $query = new Query_bdd();
  echo $query->connexion($email, $password);
endif;


if (isset($_POST['gamelist'])):
  $query = new Query_bdd();
  echo $query->all_products();
endif;

?>
