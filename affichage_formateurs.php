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

    <title>liste formateurs</title>


    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>



<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container px-5">
        <a class="navbar-brand" href="#!">LYCEE HENRI-IV</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="accueil.php">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">Connexion</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">Services</a></li>
            </ul>
        </div>
    </div>
</nav>


<!-------------------------SQL POUR INFOS PERSONNELLES------------------------>

<?php
$user = "root";
$pass = "";

try {
    $db = new PDO("mysql:host=localhost;dbname=ecole_assiamarie;charset=UTF8", $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "connexion à la BD réussie";

}catch (PDOException $exception){
    //echo "Echec de la connexion à la BD" . $exception->getMessage();
    die();
}


if($db){
    $sql = "SELECT * FROM formateurs";
    $statement = $db->query($sql);

}
?>


<!-------------------------AFFICHAGE INFOS PERSONNELLES------------------------>

<div class="container mt-5">
    <div class="row">

        <h2 class="text-center mb-5">Les formateurs</h2>


        <!----------------------IDENTIFIANTS----------------------->

            <?php
            foreach ($statement as $infosPersos){
            ?>

                <div class="col-md-4 mb-5">
                    <div class="card h-100">
                        <div class="card-header"><h2><?= $infosPersos["nom_formateur"] . "<br>" . $infosPersos["prenom_formateur"]?></h2></div>
                        <div class="card-body">
                            <h2><?= $infosPersos["matiere_formateur"]?></h2>

                            <p class="card-text">
                                <img src="<?= $infosPersos["avatar_formateur"]?>">
                            </p>
                        </div>


                        <div class="card-footer d-flex">
                        <div><a class="btn btn-secondary btn-sm me-2" href="details_formateurs.php?id_formateur=<?=$infosPersos["id_formateur"]?>">Plus d'infos</a></div>
                        <form method="POST">
                            <div>
                                <a class="btn btn-dark mb-5 btn-sm" href="supprimer_formateur.php?id_formateur=<?=$infosPersos["id_formateur"]?>">Supprimer</a>
                            </div>
                        </form>
                        </div>
                        </div>
                </div>

        <?php
        }
        ?>

    </div>
</div>

<div>
    <div class="d-flex justify-content-around">
        <a href="#" class="btn btn-outline-info mb-5"> Ajouter formateur</a>
        <a href="#" class="btn btn-outline-info mb-5"> Retour accueil</a>
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

<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container px-4 px-lg-5"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>

</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>

