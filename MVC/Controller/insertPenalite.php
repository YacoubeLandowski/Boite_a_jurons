<?php
session_start();
require_once '../Modele/Service/DBCommettreManager.class.php';
require_once '../Modele/Service/DBInfractionManager.class.php';
require_once '../Modele/Service/DBUtilisateurManager.class.php';
require_once '../Modele/Commettre.class.php';
require_once '../Modele/function.php';

if (empty($_REQUEST['loginCommettre'] || empty($_REQUEST['codeInfraction']))) {
    echo 'erreur';
}if (!empty($_REQUEST['loginCommettre'] && !empty($_REQUEST['codeInfraction']))) {
    $loginBalance = $_SESSION['currentUser']->login_utilisateur;
    $loginCommettre = $_REQUEST['loginCommettre'];
    $codeInfraction = $_REQUEST['codeInfraction'];

    $balance = new Commettre($codeInfraction, $loginCommettre ,$loginBalance);

    $status = DBCommettreManager::insertPenalite($balance);

    if ($status){
        $infra = DBInfractionManager::selectInfractionBycode($codeInfraction);
        $userEmail = DButilisateurManager::selectUtilisateurByLogin($loginCommettre);
        $email = $userEmail->email;
        $nom = $_SESSION['currentUser']->nom;
        $prenom = $_SESSION['currentUser']->prenom;
        $infraction = $infra->categorie_infraction;
        if (envoieMailPenality($email, $nom, $prenom, $infraction)) {
            echo 'ok';
        }else{
            echo 'erreur';
        }

    }else{
        echo 'erreur';
    }
}



