<?php
session_start();

$json = [];

//récupère les sessions pour les mettre aux forma json
$json['users'] = $_SESSION['users'];
$json['currentUser'] = $_SESSION['currentUser'];

echo json_encode($json);
