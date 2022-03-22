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

    <title>Détails formateur</title>


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
        $sql = "SELECT * FROM formateurs WHERE id_formateur = ?";
        $produitID = $_GET["id_formateur"];

        $request = $db->prepare($sql);
        $request->bindParam(1, $produitID);

        $request->execute();

        $details = $request->fetch(PDO::FETCH_ASSOC);

        $dateDeNaissance = new DateTime($details["date_naissance_formateur"]);
    }
    ?>

</div>
</div>


<?php


?>

<div class="container-fluid text-center mt-5">
    <div class="row">

        <h2 class=""> <?= $details["nom_formateur"] ." " .$details["prenom_formateur"] ?> </h2>
        <h3> <?= $details["matiere_formateur"] ?></h3>

        <div class="">
            <img src="<?= $details["avatar_formateur"] ?>" alt="<?= $details["nom_formateur"] ?>" title="<?= $details["nom_formateur"] ?>">
        </div>

        <div class="">
            <span>Date de naissance: </span><?= $dateDeNaissance->format("d-m-Y") . " (" . $details["age_formateur"] . " ans)"?>
        </div>
        <div class="">
            <span>Email: </span><?= $details["email_formateur"]?>
        </div>
        <div class="">
            <span>Téléphone: </span><?= $details["telephone_formateur"]?>
        </div>
        <div class="">
            <span>Adresse: </span><?= $details["adresse_formateur"]?>
        </div>

        <div class="d-flex justify-content-center mt-4">
        <!---------BTN EDITER-------->
        <form action="" method="POST" class="me-3">
            <a class="btn btn-outline-warning mb-5" href="editer_formateur.php?id_formateur=<?=$details["id_formateur"]?>">Editer</a>
        </form>

        <!---------BTN SUPPRIMER-------->
        <form action="" method="POST" class="">
            <button type="submit" name="btn-supprimer-formateur" class="btn btn-outline-danger mb-5">Supprimer</button>
        </form>
        </div>

        <div>
            <a class="btn btn-outline-info mb-5" href="affichage_formateurs.php">Retour</a>
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
