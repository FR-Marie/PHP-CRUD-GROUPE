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


<!-------------------------CONNEXION A LA BD VIA LA CLASSE PDO------------------------>

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
    $sql = "SELECT * FROM admins";
    $statement = $db->query($sql);
/////////////->query PERMET DE RECUP UNE TABLE DE LA BD PUIS UTILISITATION D'UNE BOUCLE FOR EACH POUR AFFICHER SON CONTENU
}
?>


<!-------------------------PAGE AFFICHAGE DES ADMINS------------------------>
<div class="container mt-5">
    <div class="d-flex justify-content-around">

        <!-------------------------BTN POUR AJOUTER UN ADMIN A LA BD------------------------>
        <a href="ajouter_admin.php" class="btn btn-outline-info mb-5"> Ajouter un admin</a>
    </div>

</div>

<div class="container mt-1">
    <div class="row">

        <h2 class="text-center mb-5">Les admins</h2>


        <!----------------------AFFICHAGE DES ADMINS GRACE A LA BOUCLE FOR EACH----------------------->

        <?php
        foreach ($statement as $infosPersos){
            ?>

            <div class="col-md-4 mb-5">
                <div class="card h-100">
                    <div class="card-header"><h2><?= $infosPersos["identite_admin"]?></h2></div>
                    <div class="card-body">
                        <p class="card-text">
                            <img src="<?= $infosPersos["avatar_admin"]?>">
                        </p>
                        <p class="card-text">
                        <p>adresse mail: <?= $infosPersos["email"] ?></p>
                        <p>password: <?= $infosPersos["password"] ?></p>
                        </p>


                    </div>


                    <div class="card-footer d-flex">
                        <div><a class="btn btn-secondary btn-sm me-2" href="editer_admin.php?id_admin=<?=$infosPersos["id_admin"]?>">Editer</a></div>
                        <form method="POST">
                            <div>
                                <a class="btn btn-dark mb-5 btn-sm" href="supprimer_admin.php?id_admin=<?=$infosPersos["id_admin"]?>">Supprimer</a>
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


