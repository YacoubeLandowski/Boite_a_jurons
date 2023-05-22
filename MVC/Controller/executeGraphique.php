<?php

require_once '../Modele/Service/DBCommettreManager.class.php';

session_start();

$_SESSION["requete"] = DBCommettreManager::totalTarifByLogin();

if(empty($_SESSION["requete"])) {
    header('Location: ../View/graphique.php');
}
else{
    header('Location: ../View/graphique.php');
}

$_SESSION['total'] = DBCommettreManager::totalTarif();

if(empty($_SESSION["total"])) {
    header('Location: ../View/graphique.php');
}
else{
    header('Location: ../View/graphique.php');
}
    ?>