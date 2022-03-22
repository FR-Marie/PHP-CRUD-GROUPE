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

    <title>Supprimer formateur</title>


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


?>
<!-----------------------------SI LA CO AVEC LA DB EST OK => TRAITEMENT-------------------------------->
<?php

if($db){
    $sql = "SELECT * FROM formateurs WHERE id_formateur = ?";
    $formateurID = $_GET["id_formateur"];

    $request = $db->prepare($sql);
    $request->bindParam(1, $formateurID);

    $request->execute();

    $formateur_edit = $request->fetch(PDO::FETCH_ASSOC);
}

?>

<!------------------SUPPRESSION DU PRODUIT------------------>
<!---------------------------REQUETE SQL PELUCHES----------------------------->
<?php
if($db){
    $sql = "SELECT * FROM formateurs WHERE id_formateur = ?";
    $id_formateur = $_GET["id_formateur"];

    $request = $db->prepare($sql);
    $request->bindParam(1, $id_formateur);

    $request->execute();

    $detailsFormateurDelete = $request->fetch(PDO::FETCH_ASSOC);

    $dateDeNaissance = new DateTime($detailsFormateurDelete["date_naissance_formateur"]);
}
?>



<!------------------------------CONTENU----------------------------------->
<!------------------------------------------------------------------------>
<div class="container-fluid text-center mt-5">
    <div class="row" id="affiche-formateurs">

        <h2 class=""> <?= $detailsFormateurDelete["nom_formateur"] ." " .$detailsFormateurDelete["prenom_formateur"] ?> </h2>
        <h3> <?= $detailsFormateurDelete["matiere_formateur"] ?></h3>

        <div class="">
            <img src="<?= $detailsFormateurDelete["avatar_formateur"] ?>" alt="<?= $detailsFormateurDelete["nom_formateur"] ?>" title="<?= $detailsFormateurDelete["nom_formateur"] ?>">
        </div>

        <div class="">
            <span>Date de naissance: </span><?= $dateDeNaissance->format("d-m-Y") . " (" . $detailsFormateurDelete["age_formateur"] . " ans)"?>
        </div>
        <div class="">
            <span>Email: </span><?= $detailsFormateurDelete["email_formateur"]?>
        </div>
        <div class="">
            <span>Téléphone: </span><?= $detailsFormateurDelete["telephone_formateur"]?>
        </div>
        <div class="">
            <span>Adresse: </span><?= $detailsFormateurDelete["adresse_formateur"]?>
        </div>

        <div class="d-flex justify-content-center mt-4">

            <!---------------------BTN CONFIRMER LA SUPPRESSION DU FORMATEUR + ANNULER (RETOUR AFFICHAGE FORMATEURS)------------------->
            <div class="text-center d-flex justify-content-center">
                <!--btn confirmer-->
                <form action="" method="POST">
                    <button id="btn-delete-formateur" type="submit" name="btnDeleteFormateur" class="btn btn-outline-dark me-2">Confirmer</button>
                </form>
                <!--btn annuler-->
                <a href="affichage_formateurs.php" id="btn-annuler-delete-formateur" class="btn btn-outline-secondary ms-2">Annuler</a>
            </div>

    </div>
</div>

    <div class="row mt-5">

        <?php

        if(isset($_POST["btnDeleteFormateur"])){
            //echo "btn supp ok";

            ///////////////////////////////////////
            $sql = "DELETE FROM formateurs WHERE id_formateur =?";

            ///////////////////////////////////////
            $delete = $db->prepare($sql);
            $id_formateur = $_GET["id_formateur"];

            ///////////////////////////////////////
            $delete->bindParam(1, $id_formateur);
            $delete->execute();

            if($delete){
                ?>
                <div class="alert alert-success w-50 m-auto text-center">Suppression réussie</div>
                <div class="text-center">
                    <a href="affichage_formateurs.php" class="btn btn-outline-dark">Voir formateurs</a>
                    <a href="accueil.php" class="btn btn-secondary w-25 m-auto text-center mt-5 mb-5">Retour accueil</a>
                </div>
                <style>
                    #affiche-formateurs{
                        display: none;
                    }
                </style>
                <?php
            }else{
                ?>
                <div class="alert alert-danger w-50 m-auto text-center">Echec de la suppression</div>
                <?php
            }
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

    <div class="container px-4 px-lg-5"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>

</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>


