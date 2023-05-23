<?php

require_once '../Modele/Service/DBCommettreManager.class.php';
require_once '../Modele/Commettre.class.php';

session_start();



$donnees = DBCommettreManager::selectAllPenalitys();


$tab = json_decode(json_encode($donnees), true);

print_r($tab);

$_SESSION["donneesCommettre"] = $tab;



header('Location: ../View/balance.php');

