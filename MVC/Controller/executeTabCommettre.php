<?php
require_once '../Modele/Service/DBCommettreManager.class.php';
session_start();

$json = [];


if (!empty($_REQUEST['action'])) {
    if ($_REQUEST['action'] === 'load') {
        $penalitys = DBCommettreManager::selectAllPenalitys();


        if (empty($penalitys)) {
            $json = ['success' => 'erreur'];
        }if(!empty($penalitys)){
            $json = [
                'penalitys' => $penalitys,
                'success' => 'ok'
            ];


        }
        $json['currentUser'] = $_SESSION['currentUser'];
        echo json_encode($json);
    }
    if ($_REQUEST['action'] === 'search') {
        $login = $_REQUEST['login'];
        $penalitys = DBCommettreManager::selectPenalitysByLogin_Balance($login);


        if (empty($penalitys)) {
            $json = ['success' => 'erreur'];
        }if(!empty($penalitys)){
            $json = [
                'penalitys' => $penalitys,
                'success' => 'ok'
            ];


        }
        echo json_encode($json);
    }
}
