<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../View/assets/css/styleLogin.css">
    <title>MDP oublié</title>
</head>
<body>
    
<img src="../View/assets/img/pixouInscription.png" alt="" width="300px" class="imgPixou">


        <div class="responsiveFormMDP">
            

            <form method="post" class="bodyForm" action="../Controller/executeMdpOublie.php">

                <h1 class="titreInscription"> <a href="./login.php" class="imgFleche"><img src="./assets/Img/fleche-fine-contour-vers-la-gauche.png" alt="" width="20px"> </a>Inscription </h1>
                <p class="textMDP"> Nous allons vous envoyer un nouveau mot de passe par mail </br> Nous vous conseillons de le changer ensuite dans votre panel profil. </p>
               
                <div class="input-group">
                    <input type="text" name="login" autocomplete="off" class="input" required />
                    <label class="user-label"> Login </label>
                </div>
                
                <div class="input-group">
                    <input type="email" name="email" autocomplete="off" class="input" required />
                    <label class="user-label"> Email </label>
                </div>


                <button class="btn"> Envoyer un nouveau mot de passe ! </button>

            </form>

         </div> 

</body>
</html>



