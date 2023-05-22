<?php

function countPenalite(array $retard, array $petitJurons, array $grosJurons, array $rot, array $geste, array $total): array {
    $array = [];
    for ($i = 0; $i < count($total); $i++) {
        if (!empty($total[$i])) {
            $array['data'][$i]['nom'] = $total[$i]->nom;
            $array['data'][$i]['prenom'] = $total[$i]->prenom;
            $array['data'][$i]['total'] = $total[$i]->total;



            if(!empty($retard)) {
                $statusRetard = false;
                for ($j = 0; $j < count($retard); $j++) {
                    if ($retard[$j]->login_utilisateur === $total[$i]->login_utilisateur) {
                        $valRetard = $retard[$j]->countInfra;
                        $statusRetard = true;
                    }
                }if ($statusRetard){
                    $array['data'][$i]['retard'] = $valRetard;
                }else{
                    $array['data'][$i]['retard'] = 0;
                }
            }if (empty($retard)){
                $array['data'][$i]['retard'] = 0;
            }
            if (!empty($petitJurons)) {
                $statusPetit = false;
                for ($j = 0; $j < count($petitJurons); $j++) {
                    if ($petitJurons[$j]->login_utilisateur === $total[$i]->login_utilisateur) {
                        $valPetit = $petitJurons[$j]->countInfra;
                        $statusPetit = true;
                    }
                }if ($statusPetit){
                    $array['data'][$i]['petit'] = $valPetit;
                }else{
                    $array['data'][$i]['petit'] = 0;
                }
            }if (empty($petitJurons)){
                $array['data'][$i]['petit'] = 0;
            }
            if (!empty($grosJurons)) {
                $statusGros = false;
                for ($j = 0; $j < count($grosJurons); $j++) {
                    if ($grosJurons[$j]->login_utilisateur === $total[$i]->login_utilisateur) {
                        $valGros = $grosJurons[$j]->countInfra;
                        $statusGros = true;
                    }
                }if ($statusGros){
                    $array['data'][$i]['gros'] = $valGros;
                }else{
                    $array['data'][$i]['gros'] = 0;
                }
            }if (empty($grosJurons)) {
                $array['data'][$i]['gros'] = 0;
            }
            if (!empty($rot)) {
                $statusRot = false;
                for ($j = 0; $j < count($rot); $j++) {
                    if ($rot[$j]->login_utilisateur === $total[$i]->login_utilisateur) {
                        $valRot = $rot[$j]->countInfra;
                        $statusRot = true;
                    }
                }if ($statusRot){
                    $array['data'][$i]['rot'] = $valRot;
                }else {
                    $array['data'][$i]['rot'] = 0;
                }
            }if (empty($rot)) {
                $array['data'][$i]['rot'] = 0;
            }
            if (!empty($geste)) {
                $statusGeste = false;
                for ($j = 0; $j < count($geste); $j++) {
                    if ($geste[$j]->login_utilisateur === $total[$i]->login_utilisateur) {
                        $valGeste = $geste[$j]->countInfra;
                        $statusGeste = true;
                    }
                }if ($statusGeste){
                    $array['data'][$i]['geste'] = $valGeste;
                }else {
                    $array['data'][$i]['geste'] = 0;
                }
            }if (empty($geste)) {
                $array['data'][$i]['geste'] = 0;
            }
        }
    }
    return $array;
}


function est_connecte() : bool {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return !empty($_SESSION['connecte']);
    }


function forcer_utilisateur_connecte () : void {
    if (!est_connecte()) {
        header('Location: login.php');
        exit();
    }
}

function envoieMailPenality(string $email, string $nom, string $prenom, string $infraction) : bool
{
    $to = $email;
    $subject = "Tu as été balancé(e)";
    $headers = "From: boiteajurons@gmail.com \r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $message = "<html><body style='margin: 0'>";
    $message .= "<div style='text-align: center'><img height='200' width='auto' src='https://www.zupimages.net/up/23/09/g7ms.png' alt='logo boite a jurons'/></div>";
    $message .= "<h3 style='text-align: center; font-family: sans-serif;' >".strtoupper($nom) . ' ' . ucfirst($prenom) . " t'a balancé(e)</h3>";
    $message .= "<div><p style='text-align: center; font-family: sans-serif; font: bold;'>".
        "Type d'infraction :". $infraction ."</p><br />".
        "<p style='text-align: center; font-family: sans-serif;'>".
        "Si il y a une erreur, veuillez nous en faire part en repondant a ce mail.</p><br />".
        "<p style='text-align:center; font-family: sans-serif;'>".
        "Cordialement, <br/>".
        "LA BOITE A JURONS</p></div>";
    $message.= "<footer style='background-color: #673ab7;'>".
        "<h6 style='text-align: center; font-family: sans-serif; color: white'>".
        "© Copyright : LA BOITE A JURONS tout droit reservé</h6></footer>";
    $message .= "</body></html>";


    return mail($to, $subject, $message, $headers);

}

//function pour avoir la donner de l'objet
function objetToInt($objet) : int {
    if (!is_object($objet)) {
        $rep = 0;
    }else {
        $rep = $objet->countInfra;
    }
    return $rep;
}

function pdp(string $upload_path, string $filename, string $filepath):bool{
    $allowed_filetypes = array('.jpg','.gif','.bmp','.png'); // type d'extension autorisée
    $max_filesize = 9999999999; // max filesize
//on test si le filepath existe pas
    if (!is_dir($upload_path)){
        //si il existe pas alors on creer la direction
        mkdir($upload_path, 0777, true);
    }

//on recupere l'extension du fichier
    $ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);

// on test si l'extension du fichier est valide
    if(!in_array($ext,$allowed_filetypes)){
        return false;
    }

// on test si il dépasse pas le poids max
    if(filesize($filepath) > $max_filesize){
        return false;
    }


// on test si on peut deplacer le fichier dans le dossier
    if(!is_writable($upload_path)){
        return false;
    }



// on test de deplacer le fichier dans le dossier
    if(move_uploaded_file($filepath,$upload_path . $filename)){
        return true;
    }

    else{
        return false;
    }

}