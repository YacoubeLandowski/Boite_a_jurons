<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../View/assets/css/balanceStyle.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body onload="adminLoad()">
<?php session_start() ?>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link mx-2"  href="index.php">Accueil</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link mx-2" href="../Controller/executeGraphique.php">Le graphique des jurons</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2 active" aria-current="page" href="../View/balance.php">Top Balance</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link mx-2" href="tableau.html">Balancer quelqu'un</a>
                </li>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2" href="../View/profil.php">Mon profil</a>
                </li>
                <li id="panelAdmin" style="display: none" class="nav-item">
                    <a class="nav-link mx-2" href="../View/panelAdmin.html">Panel admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2" href="../Controller/executeLogout.php">Se déconnecter</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="contenu container">
    <div class="headTab">
        <div class="titre">
            <h1 id="titreBalance" class="text-center">Top All time des balances : </h1>
        </div>
        <div class="bouton">
            <button class="btn btn-primary" id="btnBalanceWeek" type="button" onclick="viewTabBalance('week')">Afficher top de la semaine</button>
            <button class="btn btn-primary" id="btnBalanceAll" type="button" onclick="viewTabBalance('allTime')">Afficher le top AllTime</button>
        </div>
    </div>

    <div class="tableau">
        <table id="allTime" class="table table-striped">
            <thead class="black white-text" style="background-color: #673ab7">
            <tr>
                <th scope="col">Place : </th>
                <th scope="col">Nom</th>
                <th scope="col">Prenom</th>
                <th scope="col">Total</th>
            </tr>
            </thead>
            <tbody id="balance">

            </tbody>

        </table>
    </div>
</div>



<footer class="text-center text-white fixed-bottom" style="background-color: #673ab7">
    <!-- Grid container -->
    <div class="container p-4"></div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2023 Copyright:
        <a class="text-white" href="https://www.afpa.fr/">Afpa.fr</a>
    </div>
    <!-- Copyright -->
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script
        src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
        crossorigin="anonymous"></script>
<script type="text/javascript" src="assets/js/functions.js" onload="viewTabBalance('allTime')"></script>
</body>

</html>