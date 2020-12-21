<?php
require('./database.php');
 
class Query_bdd extends Connect_bdd{

  public function inscription($nom, $prenom, $cin, $phone, $email, $password){
    $bdd = $this->dbconnect();
    $yet_mail = $bdd->query("SELECT 1 FROM User WHERE telephone='$phone'");

    if ($yet_mail->rowCount() == 0){
      $ajouter = $bdd->prepare("INSERT INTO User(nom, prenom, cin, email, telephone, mot_de_passe) values(? , ? , ? , ?, ? , ?)");
      $ajouter->execute(array($nom, $prenom, $cin, $email, $phone, password_hash($password, PASSWORD_DEFAULT)));
      return true;
    }
    else{
      return "Téléphone déjà existant";
    }

  }

  public function connexion($phone, $password){
    $bdd = $this->dbconnect();

    $yet_mail = $bdd->query("SELECT 1 FROM User WHERE telephone='$phone'");

    if ($yet_mail->rowCount() == 0){
        return "Numéro Téléphone Incorrecte ou Inéxistant";
    }
    else{
        $password = password_hash($password, PASSWORD_DEFAULT);
        $login = $bdd->query("SELECT 1 FROM User WHERE telephone='$phone' AND mot_de_passe='$password'");

        if ($login->rowCount() == 0){
            return "Mot de passe Incorrecte";
        }
        else{
            return $this->info_user($phone)[0][4];
            // ceci retourne un tableau donc je recupere l indice du numero 
        }
    }

  }

  public function all_products(){
    $bdd = $this->dbconnect();
    $games = $bdd->query("SELECT * FROM Product");
    $all_games = $games->fetchall();
    return  json_encode($all_games);
  }


  public function info_user($phone){
    $bdd = $this->dbconnect();
    $user = $bdd->query("SELECT * FROM User WHERE telephone='$phone' ");

    return $user->fetchall();
  }
}
?>
