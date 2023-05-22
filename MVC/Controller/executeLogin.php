<?php
session_start();
require_once "../Modele/Service/DBLogin.class.php";
require_once "../Modele/Service/DBUtilisateurManager.class.php";
require_once "../Modele/function.php";

if (!empty($_REQUEST['login'] && $_REQUEST['password'])){
    $login = $_REQUEST['login'];
    $password = $_REQUEST['password'];

    $statut = DBLogin:: authentification($login, $password);
    //test si le status est vrai ou non
    if ($statut) {
        $_SESSION['currentUser'] = DBUtilisateurManager::selectUtilisateurByLogin($login);
        $_SESSION['users'] = DBUtilisateurManager::selectUtilisateur();
        $_SESSION['connecte'] = 1;
        echo 'ok';
    } else {
        echo 'error';
    }

}else{
    echo 'error';
}



?>