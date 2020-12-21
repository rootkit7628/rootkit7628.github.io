<?php
class Connect_bdd{
    protected function dbconnect(){
        try{
            $bdd = new PDO('mysql: host=localhost; dbname=e_hena; charset=utf8', 'username', 'passwd');
        }
        catch (Exception $e){
            die ('Erreur:' . $e->getMessage());
        }
        return $bdd;
    }
}
?>