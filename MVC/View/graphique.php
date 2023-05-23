<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graphique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="./assets/css/graphiqueStyle.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body onload="adminLoad()">

    <?php session_start(); ?>

    <?php
    require '../Modele/function.php';
    if (!est_connecte()) {
        header('Location: login.php');
        exit();
    }
    ?>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link mx-2 " aria-current="page" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2 active" href="../Controller/executeGraphique.php">Le graphique des
                            jurons</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="../View/balance.php">Top Balance</a>
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


    <?php
    $_SESSION["requete"];

    foreach ($_SESSION["requete"] as $data) {
        $prenom[] = $data['prenom'];
        $totalPrix[] = $data['totalPrix'];
    }

    $total = $_SESSION['total'];
    ?>



    <?php if (empty($_SESSION["requete"])): ?>
        <div class="container">
            <h1>Le graphique des Jurons est momentanément vide</h1>
        </div>
    <?php else: ?>
        <div class="container">
            <h1>Le graphique des Jurons</h1>
        </div>
    <?php endif ?>






    <div class="graphique">
        <div>
            <canvas id="myChart"></canvas>
        </div>
        <div>

            <script>
                const ctx = document.getElementById('myChart');

                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: <?php echo json_encode($prenom) ?>,
                        datasets: [{
                            label: 'Total tarif en euros',
                            data: <?php echo json_encode($totalPrix) ?>,
                            backgroundColor: [
                                'rgb(0, 0, 0)',
                                'rgb(51, 0, 102)',
                                'rgb(102, 178, 255)',
                                'rgb(0, 153, 153)',
                                'rgb(128, 128, 128)',
                                'rgb(204, 102, 0)',
                                'rgb(255, 204, 229)',
                                'rgb(128, 128, 128)',
                                'rgb(153, 153, 0)',
                                'rgb(255, 255, 204)',
                                'rgb(255, 255, 204)',
                                'rgb(255, 255, 255)',
                                'rgb(51, 0, 51)',
                                'rgb(0, 255, 255)',
                                'rgb(0, 0, 153)',
                                'rgb(255, 153, 153)',
                                'rgb(204, 204, 0)',

                            ],
                            borderWidth: 5
                        }]
                    },
                    options: {
                        scales: {

                        }
                    }
                });
            </script>
        </div>
        <?php if (empty($_SESSION["total"])): ?>
            <h1>Aucun montant n'est à régler pour le moment</h1>
        <?php else: ?>
            <h1>Total :
                <?php echo $total;
                echo " €" ?>
            </h1>
        <?php endif ?>
    </div>





    <footer class="text-center text-white" style="background-color: #673ab7">
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

        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <script
            src="https://code.jquery.com/jquery-3.6.3.min.js"
            integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
            crossorigin="anonymous"></script>
    <script src="../View/assets/js/functions.js"></script>

</body>



</html>