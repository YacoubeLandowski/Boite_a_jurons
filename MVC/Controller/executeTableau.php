<?php
require_once '../Modele/Service/DBCommettreManager.class.php';
require_once '../Modele/function.php';
session_start();
$retard = 'code_1';
$petit = 'code_2';
$gros = 'code_3';
$rot = 'code_4';
$geste = 'code_5';

$retard = DBCommettreManager::selectCountByCodeInfraction($retard);
$petitJurons = DBCommettreManager::selectCountByCodeInfraction($petit);
$grosJurons = DBCommettreManager::selectCountByCodeInfraction($gros);
$rot = DBCommettreManager::selectCountByCodeInfraction($rot);
$geste = DBCommettreManager::selectCountByCodeInfraction($geste);
$total = DBCommettreManager::selectCountTotal();
$json = [];

if (empty($retard) && empty($petitJurons) && empty($grosJurons) && empty($rot) && empty($geste) && empty($total)) {
    $json['success'] = 'no users found';
}else{
    $json = countPenalite($retard, $petitJurons, $grosJurons, $rot, $geste, $total);
    $json['success'] = 'ok';
}
$json['currentUser'] = $_SESSION['currentUser'];
$json['users'] = $_SESSION['users'];
echo json_encode($json);
