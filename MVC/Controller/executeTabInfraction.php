<?php
require_once '../Modele/Service/DBInfractionManager.class.php';
require_once '../Modele/Infraction.class.php';


$json = [];

if (!empty($_REQUEST['action'])) {
    if ($_REQUEST['action'] === 'load'){
        $infractions = DBInfractionManager::selectInfraction();

        if (empty($infractions)) {
            $json['success'] = 'error';
        }
        if(!empty($infractions)){
            $json['infractions'] = $infractions;
            $json['success'] ='ok';
        }

        echo json_encode($json);
    }
    if ($_REQUEST['action'] === 'add'){
        $code = $_REQUEST['code'];
        $categorie = $_REQUEST['categorie'];
        $tarif = $_REQUEST['tarif'];
        $infraction = new Infraction($code, $categorie, $tarif);
        $status = DBInfractionManager::insertInfraction($infraction);
        if($status){
            echo 'ok';
        }else{
            echo 'erreur';
        }
    }
    if ($_REQUEST['action'] === 'delete'){
        $code = $_REQUEST['code'];
        $status = DBInfractionManager::deleteInfraction($code);
        if($status){
            echo 'ok';
        }else{
            echo 'erreur';
        }
    }
}
