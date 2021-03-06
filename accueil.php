<?php
session_start();

if(isset($_SESSION["email"])){


if (isset($_POST["btn-deconnexion"])){
    echo "btn ok";
    session_unset();
    session_destroy();
    header("location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!-----bootstrap---->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Accueil</title>


    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>



<!-----------------------NAVBAR------------------------------>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark p-4">
    <div class="container px-5">
        <a class="navbar-brand" href="#!">☼ LYCEE HENRI-IV ☼</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item me-5 p-1"><a class="nav-link active text-info" aria-current="page" href="accueil.php">Accueil</a></li>
                <li class="nav-item p-1"><a class="nav-link text-white" href="affichage_admins.php">Admins</a></li>
                <li class="nav-item p-1"><a class="nav-link text-white" href="affichage_formateurs.php">Formateurs</a></li>
                <li class="nav-item p-1"><a class="nav-link text-white" href="eleves.php">Eleves</a></li>
                <li class="nav-item ms-3 p-1"><a class="nav-link text-info" href="#!">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>


<!----------------------PAGE------------------------->
<div class="container px-4 px-lg-5">
    <!-- Heading Row-->
    <div class="row gx-4 gx-lg-5 align-items-center my-5">
        <div class="col-lg-7"><img class="img-fluid rounded mb-4 mb-lg-0" src="assets/logo-lycee-henri4-500.jpg" alt="..." /></div>
        <div class="col-lg-5">
                <?php

////////////////////////SI L'ADMIN EST CONNECTE - MESSAGE PERSONNALISE DE BIENVENUE////////////////////////
                if (isset($_SESSION["email"])){
                    ?>
                    <div class="bg-dark p-5 text-center">
                        <h1 class="text-info">Bienvenue <?=$_SESSION["email"]?></h1>

                    <?php
                }
                ?>

            <p class="bg-secondary p-3 text-white rounded">This is a template that is great for small businesses. It doesn't have too much fancy flare to it, but it makes a great use of the standard Bootstrap core components. Feel free to use this template for any project you want!</p>
            <form method="POST">
                <button type="submit" class="btn btn-outline-info bg-dark text-info rounded" name="btn-deconnexion">DECONNEXION</button>
            </form>

             </div>


        </div>
    </div>
    <!------------------------ACCES A LA GESTION DES 3 BLOCS (ADMINS / FORMATEURS / ETUDIANTS)-->
    <div class="card text-white bg-dark my-5 py-4 text-center">
        <div class="card-body"><p class="text-white m-0">This call to action card is a great place to showcase some important information or display a clever tagline!</p></div>
    </div>

    <div class="row gx-4 gx-lg-5">

        <!----------------------------ADMINS------------------------------->
        <div class="col-md-4 mb-5">
            <div class="card h-100 bg-secondary text-white">
                <div class="card-body">
                    <h2 class="card-title p-2">ADMINS</h2>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem magni quas ex numquam, maxime minus quam molestias corporis quod, ea minima accusamus.</p>
                </div>
                <div class="card-footer p-3"><a class="btn btn-info btn-sm" href="affichage_admins.php">Gérer admins</a></div>
            </div>
        </div>

        <!-----------------------------FORMATEURS------------------------------>
        <div class="col-md-4 mb-5">
            <div class="card h-100 bg-secondary text-white">
                <div class="card-body">
                    <h2 class="card-title p-2">FORMATEURS</h2>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod tenetur ex natus at dolorem enim! Nesciunt pariatur voluptatem sunt quam eaque, vel, non in id dolore voluptates quos eligendi labore.</p>
                </div>
                <div class="card-footer p-3"><a class="btn btn-info btn-sm" href="affichage_formateurs.php">Gérer formateurs</a></div>
            </div>
        </div>


        <!-----------------------------ETUDIANTS------------------------------>
        <div class="col-md-4 mb-5">
            <div class="card h-100 bg-secondary text-white">
                <div class="card-body">
                    <h2 class="card-title p-2">ETUDIANTS</h2>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem magni quas ex numquam, maxime minus quam molestias corporis quod, ea minima accusamus.</p>
                </div>
                <div class="card-footer p-3"><a class="btn btn-info btn-sm" href="eleves.php">Gérer étudiants</a></div>
            </div>
        </div>
    </div>
</div>

<!-----------------------SI SESSION PAS OK------------------------->
<?php

}else{
    ?>
    <div class="alert alert-warning text-light">
        <p>vous devez être connecté pour voir cette page!</p>
        <button><a href="index.php">Se connecter</a></button>
    </div>
    <?php
}


?>

<!----------------------------FOOTER------------------------------->
<footer class="py-5 bg-dark">
    <div class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container px-5">
            <a class="navbar-brand" href="#!">☼ LYCEE HENRI-IV ☼</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="accueil.php">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="affichage_admins.php">Admins</a></li>
                    <li class="nav-item"><a class="nav-link" href="affichage_formateurs.php">Formateurs</a></li>
                    <li class="nav-item"><a class="nav-link" href="eleves.php">Eleves</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container px-4 px-lg-5 mt-4"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>




