<?php
require_once '../Modele/Service/DBUtilisateurManager.class.php';
require_once '../Modele/Service/DBRolesManager.class.php';
require_once '../Modele/Utilisateur.class.php';
require_once '../Modele/Roles.class.php';
$role = DBRolesManager::selectRoles();
$id_role = $role[1]->id_roles;
$type_role = $role[1]->type_roles;
$roles = new Roles($id_role, $type_role);

//test si request existe.
if (isset($_REQUEST)) {
    //test si request n'est pas vide.
    if (!empty($_REQUEST['nom']) && !empty($_REQUEST['prenom']) && !empty($_REQUEST['email'])
        && !empty($_REQUEST['date']) && !empty($_REQUEST['login']) && !empty($_REQUEST['password'])) {
        if (!filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)) {
            echo "Email address non valide";
        }
        $nom = strip_tags($_REQUEST['nom']);
        $prenom = strip_tags($_REQUEST['prenom']);
        $email = $_REQUEST['email'];
        $login = strip_tags($_REQUEST['login']);
        $password = password_hash($_REQUEST['password'], PASSWORD_DEFAULT);
        $date = $_REQUEST['date'];
        $utilisateur = new Utilisateur($nom, $prenom, $date, $login, $email, $password, $roles);
        $status = DButilisateurManager::insertUtilisateur($utilisateur);
        //envoie la reponse
        if ($status){
            echo 'ok';
        }else{
            echo 'Impossible de vous inscrire';
        }
    }else{
        echo "Erreur le formulaire n'est pas remplis";
    }
}





