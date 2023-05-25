<?php
session_start();
require_once "../Modele/service/DBRolesManager.class.php";
require_once "../Modele/service/DBUtilisateurManager.class.php";
require_once '../Modele/Utilisateur.class.php';
require_once '../Modele/Roles.class.php';
require_once '../Modele/function.php';

$login = $_SESSION['currentUser']->login_utilisateur;
$_SESSION['currentUser'] = DButilisateurManager::selectUtilisateurByLogin($login);

$nom = ['nom'];