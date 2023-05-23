<?php
session_start();
require_once '../Modele/Service/DBUtilisateurManager.class.php';
$login = $_SESSION['currentUser']->login_utilisateur;
$allowed_filetypes = array('.jpg','.gif','.bmp','.png'); // type d'extension autorisée
$max_filesize = 9999999999; // max filesize
$upload_path = '../users/'.$login.'/photo/'; // Filepath du fichier
//on test si le filepath existe pas
if (!is_dir($upload_path)){
    //si il existe pas alors on creer la direction
    mkdir($upload_path, 0777, true);
}

//on recupere le nom du fichier
$filename = $_FILES['photo']['name'];
//on recupere l'extension du fichier
$ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);

// on test si l'extension du fichier est valide
if(!in_array($ext,$allowed_filetypes))
    die('The file you attempted to upload is not allowed.');

// on test si il dépasse pas le poids max
if(filesize($_FILES['photo']['tmp_name']) > $max_filesize)
    die('The file you attempted to upload is too large.');

// on test si on peut deplacer le fichier dans le dossier
if(!is_writable($upload_path))
    die('You cannot upload to the specified directory, please CHMOD it to 777.');


// on test de deplacer le fichier dans le dossier
if(move_uploaded_file($_FILES['photo']['tmp_name'],$upload_path . $filename)){
    //on ajoute le filepath et on le met dans la bdd
    $file_path = $upload_path. $filename;
    $status = DButilisateurManager::updatePhoto($file_path,$login);
    if ($status){
        //on redirige vers profil
        echo 'ok';
        $_SESSION['currentUser'] = DButilisateurManager::selectUtilisateurByLogin($login);
        header('Location:../View/profil.php');
    }else{
        //si erreur il y a, on envoie l'erreur
        echo 'fail';
    }

} else{
    echo 'There was an error during the file upload. Please try again.'; // It failed
}

