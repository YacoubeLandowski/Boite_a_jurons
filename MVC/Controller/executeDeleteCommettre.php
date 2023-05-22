<?php
require_once '../Modele/Service/DBCommettreManager.class.php';

if (empty($_REQUEST)){
    echo 'erreur';
}
if (!empty($_REQUEST)){
    $id = $_REQUEST['id'];
    $status = DBCommettreManager::deletePenalite($id);
    if ($status){
        echo 'ok';
    }else{
        echo 'erreur';
    }
}
