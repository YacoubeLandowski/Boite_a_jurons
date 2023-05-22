<?php
session_start();
require_once "../Modele/service/DBUtilisateurManager.class.php";
require_once "../Modele/service/DBCommettreManager.class.php";
require_once "../Modele/function.php";
$retard = 'code_1';
$petit = 'code_2';
$gros = 'code_3';
$rot = 'code_4';
$geste = 'code_5';
$login = $_SESSION['currentUser']->login_utilisateur;
$_SESSION['currentUser'] = DButilisateurManager::selectUtilisateurByLogin($login);
$json = [];

$retard = DBCommettreManager::selectCountByCodeInfractionLogin($retard, $login);
$petitJurons = DBCommettreManager::selectCountByCodeInfractionLogin($petit, $login);
$grosJurons = DBCommettreManager::selectCountByCodeInfractionLogin($gros, $login);
$rot = DBCommettreManager::selectCountByCodeInfractionLogin($rot, $login);
$geste = DBCommettreManager::selectCountByCodeInfractionLogin($geste, $login);
$total = DBCommettreManager::selectCountTotalByLogin($login);
$balance = DBCommettreManager::selectPenalitysByLogin_Balance($login);


if (!is_object($retard) && !is_object($petitJurons) && !is_object($grosJurons) && !is_object($rot) && !is_object($geste) && !is_object($total)) {
    $json['success'] = 'aucun juron trouve';
}else{
    $retard = objetToInt($retard);
    $petit = objetToInt($petitJurons);
    $gros = objetToInt($grosJurons);
    $rot = objetToInt($rot);
    $geste = objetToInt($geste);
    if (!is_object($total)){
        $total = 0;
    }else{
        $total = $total->total;
    }
    $json['penality'] = [
        'retard' => $retard,
        'petit' => $petit,
        'gros' => $gros,
        'rot' => $rot,
        'geste' => $geste,
        'total' => $total,
    ];
    $json['success'] = 'ok';
}if (empty($balance)){
    $json['msg'] = 'rien';
}else{
    $json['balance'] = $balance;
    $json['msg'] = 'ok';
}
$json['currentUser'] = $_SESSION['currentUser'];
echo json_encode($json);




