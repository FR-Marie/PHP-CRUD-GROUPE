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

    <title>Editer admin</title>


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
    $sql = "SELECT * FROM admins WHERE id_admin = ?";
    $adminID = $_GET["id_admin"];

    $request = $db->prepare($sql);
    $request->bindParam(1, $adminID);

    $request->execute();

    $admin_edit = $request->fetch(PDO::FETCH_ASSOC);
}

?>

<!------------------FORMULAIRE D'EDITION DU PRODUIT------------------>

<div class="container-fluid">
    <div class="row">

        <h2 class="text-white text-center mt-5">Editer <?=$admin_edit["identite_admin"]?></h2>

        <div class="col mt-3">

            <form method="POST" enctype="multipart/form-data" class="w-25 m-auto text-white bg-secondary rounded  border border-dark text-start ps-5 mb-5 pb-5">

                <div class="mt-5 mb-2">
                    <label for="identite_admin" class="d-block">Admin: </label>
                    <input type="text" name="identite_admin" placeholder="<?=$admin_edit["identite_admin"]?>" required>
                </div>

                <div class="mb-2">
                    <label for="email_admin" class="d-block">Email: </label>
                    <input type="email" name="email_admin" placeholder="<?=$admin_edit["email"]?>"required>
                </div>

                <div class="mb-3">
                    <label for="password_admin" class="d-block">Password: </label>
                    <input type="text" name="password_admin" placeholder="<?=$admin_edit["password"]?>"required>
                </div>

                <div class="mb-4">
                    <label for="avatar_admin" class="d-block">Avatar: </label>
                    <input type="file" name="avatar_admin" class="" required>
                </div>


                <!-------------BTN SUBMIT------------>
                <button type="submit" class="btn btn-success mt-1 mb-2" name="btn-valider-edit">VALIDER</button>

                <div>
                    <a href="affichage_admins.php" class="btn btn-outline-info">Retour</a>
                </div>


            </form>

        </div>


    </div>
</div>


<!-----------------------------TRAITEMENT DE L'EDITION ADMIN-------------------------------->
<?php

if (isset($_POST["btn-valider-edit"])){

    if(isset($_FILES["avatar_admin"])){

        //répertoire de destination des images
        $repertoireImage = "assets/";

        //répertoire de destination + composante finale d'un chemin (basename) avec en paramètres
        //un tableau associatif multi dim $_FILES["image_produit"]["name"] (name = le nom de l'image)
        $avatar_admin = $repertoireImage . basename($_FILES["avatar_admin"]["name"]);

        //Image téléchargée du formulaire ($_post) avec son répertoire, son nom et son image
        $_POST["avatar_admin"] = $avatar_admin;

        if(move_uploaded_file($_FILES["avatar_admin"]["tmp_name"], $avatar_admin)){
            ?>
            <div class="alert alert-success w-50 m-auto">
                <p>Fichier validé et téléchargé avec succès</p>
                <a href="accueil.php" class="btn btn-warning">Retour accueil</a>
            </div>
            <?php
        }else{
            ?>
            <div class="alert alert-danger w-50 m-auto">
                <p>Erreur lors du téléchargement de l'image</p>
                <a href="accueil.php" class="btn btn-warning">Retour accueil</a>
            </div>
            <?php
        }
    }else{
        ?>
        <div class="alert alert-danger w-50 m-auto">
            <p>Format fichier invalide</p>
            <a href="accueil.php" class="btn btn-warning">Retour accueil</a>
        </div>
        <?php
    }



    if($db){
        $sql = "INSERT INTO `admins`(`identite_admin`, `email`, `password`, `avatar_admin`) VALUES (?,?,?,?,)";

        $request = $db->prepare($sql);

        $id = $_GET["id_admin"];

        $request->execute([
            $_POST["identite_admin"],
            $_POST["email"],
            $_POST["password"],
            $_POST["avatar_admin"],
            $id

        ]);

        if($request){
            ?>
            <div>
                <p class="alert alert-success">Réussite de la mise à jour produit</p>
                <a href="accueil.php" class="btn btn-warning">Retour accueil</a>
            </div>
            <?php
        }else{
            ?>
            <div>
                <p class="alert alert-danger">Echec de la mise à jour produit</p>
                <a href="accueil.php" class="btn btn-warning">Retour accueil</a>
            </div>
            <?php
        }
    }
}

?>



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

