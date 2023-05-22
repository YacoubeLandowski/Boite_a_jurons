<?php
session_start();
require_once "../Modele/service/DBRolesManager.class.php";
require_once "../Modele/service/DBUtilisateurManager.class.php";
require_once '../Modele/Utilisateur.class.php';
require_once '../Modele/Roles.class.php';
require_once '../Modele/function.php';

$login = $_SESSION['currentUser']->login_utilisateur;
$id_role = $_SESSION['currentUser']->id_roles;
$role = DBRolesManager::selectRolesByType($id_role);
$roles = new Roles($id_role, $role->type_roles);



if (isset($_POST)) {
    if (!empty($_FILES['photo'])){
        $upload = "../Users/".$login."/photo/";
        $filename = $_FILES['photo']['name'];
        $filepath = $_FILES['photo']['tmp_name'];
        $status = pdp($upload,$filename,$filepath);
        if ($status){
            $filepath = $upload.$filename;
            $status = DBUtilisateurManager::updatePhoto($filepath,$login);
            if ($status) {
                $_SESSION['message'] = 'Ok';
            }
        }
    }
    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email'])
        && !empty($_POST['date_naissance']) && !empty($_POST['password'])) {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            echo "Email address non valide";
        }
        $nom = strip_tags($_POST['nom']);
        $prenom = strip_tags($_POST['prenom']);
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $date = $_POST['date_naissance'];
        $utilisateur = new Utilisateur($nom, $prenom, $date, $login, $email, $password, $roles);
        $status = DButilisateurManager::updateUtilisateur($utilisateur);
        if ($status){
            header('Location: ../View/profil.php');
        }else{
            echo 'Impossible de changez vos info';
        }
    }else{
        print_r($_POST);
        echo "Erreur le formulaire n'est pas remplis";
    }
}