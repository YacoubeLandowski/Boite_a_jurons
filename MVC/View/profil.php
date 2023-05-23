<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../View/assets/css/profilStyle.css">
    <title>Document</title>
</head>
<body onload="profil(); adminLoad();">
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link mx-2" href="index.php">Accueil</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link mx-2" href="../Controller/executeGraphique.php">Le graphique des jurons</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2" href="../View/balance.php">Top Balance</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link mx-2" href="tableau.html">Balancer quelqu'un</a>
                </li>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2 active" aria-current="page" href="../View/profil.php">Mon profil</a>
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



<div class="container bootstrap snippets bootdey">
    <div class="row">
        <div class="profile-nav col-md-3">
            <div class="panel">
                <div class="user-heading round">
                    <a href="#" id="pdp">
                    </a>
                    <h1 id="nomPrenom"></h1>
                    <p id="profilEmail"></p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Modifier profil
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier profil</h1>
                                    <P type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></P>
                                </div>

                                <div class="modal-body">
                                    <form method="post" action="../Controller/executeProfilModif.php" enctype="multipart/form-data" class="form">

                                        <div>
                                            <label for="login" >Login</label>
                                            <input disabled id="login" class="form-control" type="text" name="login">
                                        </div>
                                        <div>
                                            <label for="email" >Changer adresse email</label>
                                            <input class="form-control" id="email" type="text" name="email" placeholder="Nouvelle adresse email">
                                        </div>

                                        <div>
                                            <label for="photo" >Changer Photo de profil</label>
                                            <input class="form-control" id="photo" type="file" accept=".jpeg,.gif,.png,.bmp" name="photo" >
                                        </div>

                                        <div>
                                            <label for="nom" >Changer Nom</label>
                                            <input class="form-control" id="nom" type="text" name="nom">
                                        </div>

                                        <div>
                                            <label for="prenom">Changer prenom</label>
                                            <input class="form-control" type="text" name="prenom" id="prenom" >
                                        </div>
                                        <div>
                                            <label class="label" for="date_naissance" >Changer date de naissance</label>
                                            <input class="form-control" type="date" id="date_naissance" name="date_naissance" >
                                        </div>
                                        <div>
                                            <input hidden="hidden"  class="form-control" type="password" id="password" name="password" >
                                        </div>
                                        <div>
                                            <input type="submit" value="Modifier" class="btn btn-primary">
                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-info col-md-9">
            <div class="panel">

                <div class="panel-body bio-graph-info">
                    <div class="card">
                        <div class="tools">

                        </div>
                        <div class="card__content">

                            <h1>Bio Graph</h1>
                            <div class="">
                                <div class="bio-row">
                                    <p id="bioLogin"></p>
                                </div>

                                <div class="bio-row">
                                    <p id="bioPrenomNom"></p>
                                </div>

                                <div class="bio-row">
                                    <p id="bioDate"></p>
                                </div>
                                <div class="bio-row">
                                    <p id="bioEmail"></p>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="containeurHistorique" >
    <div class="cardDeux">
        <div class="tools">
        </div>
        <div class="card__contentDeux">
            <p id="profilJ" style="display: none">Bravo tu n'as commis aucune infraction</p>
            <h5 class="profilTabJuron">Historique des Jurons :</h5>
                <table class="profilTabJuron" class="table">
                    <thead>
                    <tr>
                        <th scope="col">Retard</th>
                        <th scope="col">Petite insulte</th>
                        <th scope="col">Grosse insulte</th>
                        <th scope="col">Rot</th>
                        <th scope="col">Geste</th>
                        <th scope="col">Total</th>
                    </tr>
                    </thead>
                    <tbody id="profilJurons" class="table-group-divider">
                    </tbody>

                </table>
            <h5>Qui as tu balancé(e) ? </h5>
            <p id="profilB" style="display: none">Bravo t'es pas une balance</p>
            <table id="profilTabBalance" class="table">
                <thead>
                <tr>
                    <th scope="col">Motif</th>
                    <th scope="col">Login</th>
                    <th scope="col">Date</th>
                </tr>
                </thead>
                <tbody id="profilBalance" class="table-group-divider">
                </tbody>

            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script
        src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
        crossorigin="anonymous"></script>
<script type="text/javascript" src="assets/js/functions.js" ></script>

</body>
</html>