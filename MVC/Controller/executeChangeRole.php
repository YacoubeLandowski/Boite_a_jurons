<?php
session_start();
require_once '../Modele/Service/DBUtilisateurManager.class.php';
require_once '../Modele/Service/DBRolesManager.class.php';
require_once '../Modele/Utilisateur.class.php';
require_once '../Modele/Roles.class.php';

if (!empty($_REQUEST['login']) && !empty($_REQUEST['role'])) {
    $id_role = $_REQUEST['role'];
    $role = DBRolesManager::selectRolesByType($id_role);
    if (!empty($role)) {
        $login = $_REQUEST['login'];
        $user = DButilisateurManager::selectUtilisateurByLogin($login);
        $password = $user->password;
        $email = $user->email;
        $nom = $user->nom;
        $prenom = $user->prenom;
        $date = $user->date_naissance;
        $role = new Roles($role->id_roles, $role->type_roles);
        $user = new Utilisateur($nom, $prenom, $date,  $login, $email, $password, $role);
        $status = DButilisateurManager::updateUtilisateur($user);
        if ($status) {
            echo 'ok';
            $_SESSION['users'] = DButilisateurManager::selectUtilisateur();
        }else{
            echo 'error';
        }
    }else{
        echo 'erreur';
    }
}
