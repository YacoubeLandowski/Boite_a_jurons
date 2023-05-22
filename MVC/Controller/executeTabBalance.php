<?php
session_start();
require_once '../Modele/Service/DBCommettreManager.class.php';




$json = [];

if (empty($_REQUEST['action'])){
    $json['success'] = 'erreur';
}if (!empty($_REQUEST['action'])){
    if ($_REQUEST['action'] === 'allTime'){
        $allTime = DBCommettreManager::selectBestBalance();
        if (empty($allTime)){
            $json['success'] = 'erreur';
        }if (!empty($allTime)){
            $json['success'] = 'ok';
            $json['action'] = 'allTime';
            $json['allTime'] = $allTime;
        }
    }if ($_REQUEST['action'] === 'week') {
        $week = DBCommettreManager::selectBestBalanceWeek();
        if (empty($week)){
            $json['success'] = 'erreur';
        }if (!empty($week)){
            $json['success'] = 'ok';
            $json['action'] = 'week';
            $json['week'] = $week;
        }
    }
}

echo json_encode($json);