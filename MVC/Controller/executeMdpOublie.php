<?php 

include '../Modele/Service/DBUtilisateurManager.class.php';

// permet de changer le mot de passe et l'envoyer par mail à l'utilisateur 

if (isset($_POST['email'])) 
{

    $password = uniqid();
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $message = "Bonjour, voici votre nouveau mot de passe : $password " ; 
    $headers = 'Content-Type: text/plain; charset="utf-8"." "';

    if (mail($_POST['email'], 'Mot de passe oublié', $message, $headers)) {
        if (DButilisateurManager::changePassword($hashedPassword,$_POST['login'], $_POST['email'])) {
            header ('Location: ../View/login.php');
        }
    }
    else {
        echo "Une erreur est survenue veuillez réessayer";
    }

   
} 

?>