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

        <title>Ajouter formateur</title>


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
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="accueil.php">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="affichage_admins.php">Admins</a></li>
                <li class="nav-item"><a class="nav-link" href="affichage_formateurs.php">Formateurs</a></li>
                <li class="nav-item"><a class="nav-link" href="eleves.php">Eleves</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>
<!------------------------------------------------->

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


<!------------------------------------------------->

    <div class="container-fluid">
        <div class="row" id="ajoutFormateurId">

            <h2 class="text-white text-center mt-5">Editer</h2>

            <div class="col mt-3">

                <form method="POST" enctype="multipart/form-data" class="w-25 m-auto text-white bg-secondary rounded  border border-dark text-start ps-5 mb-5 pb-5">

                    <div class="mt-5 mb-2">
                        <label for="nom_etudiant" class="d-block">Nom: </label>
                        <input type="text" name="nom_etudiant" required>
                    </div>

                    <div class="mb-2">
                        <label for="prenom_etudiant" class="d-block">Prénom: </label>
                        <input type="text" name="prenom_etudiant" required>
                    </div>

                    <div class="mb-3">
                        <label for="adresse_etudiant" class="d-block">Adresse postale: </label>
                        <textarea type="text" name="adresse_etudiant" required></textarea>
                    </div>

                    <div class="mb-2">
                        <label for="date_naissance_etudiant" class="d-block">Date de naissance: </label>
                        <input type="date" name="date_naissance_etudiant" required>
                    </div>

                    <div class="mb-3">
                        <label for="telephone_etudiant" class="d-block">Téléphone: </label>
                        <input type="number" min=0 name="telephone_etudiant" required>
                    </div>

                    <div class="mb-3">
                        <label for="email_etudiant" class="d-block">Adresse email: </label>
                        <input type="email" name="email_etudiant" required>
                    </div>

                    <div class="mb-2">
                        <label for="age_etudiant" class="d-block">Age: </label>
                        <input type="number" min=0 name="age_etudiant" required>
                    </div>

                    <div class="mb-2">
                        <label for="formation_etudiant" class="d-block">Formation: </label>
                        <input type="text" name="matiere_etudiant" required>
                    </div>

                    <div class="mb-4">
                        <label for="avatar_etudiant" class="d-block">Avatar: </label>
                        <input type="file" name="avatar_etudiant" class="" required>
                    </div>


                    <!-------------BTN SUBMIT------------>
                    <button type="submit" class="btn btn-success mt-1 mb-2" name="btn-valider-ajout">VALIDER</button>

                    <div>
                        <a href="details_formateurs.php" class="btn btn-outline-info">Retour</a>
                    </div>


                </form>

            </div>


        </div>
    </div>


<?php


    //INSERER LE NOUVEAU FORMATEUR

    if (isset($_POST["btn-valider-ajout"])){


    if($db){

        if(isset($_FILES["avatar_etudiant"])){

            //répertoire de destination des images
            $repertoireImage = "assets/";

            //répertoire de destination + composante finale d'un chemin (basename) avec en paramètres
            //un tableau associatif multi dim $_FILES["image_produit"]["name"] (name = le nom de l'image)
            $avatar_etudiant = $repertoireImage . basename($_FILES["avatar_etudiant"]["name"]);

            //Image téléchargée du formulaire ($_post) avec son répertoire, son nom et son image
            $_POST["avatar_etudiant"] = $avatar_etudiant;

            if(move_uploaded_file($_FILES["avatar_etudiant"]["tmp_name"], $avatar_etudiant)){
                ?>
                <div class="alert alert-success w-50 m-auto text-center mt-5 mb-5">
                    <p>Fichier validé et téléchargé avec succès</p>
                </div>
                <?php
            }else{
                ?>
                <div class="alert alert-danger w-50 m-auto text-center mt-5 mb-5">
                    <p>Erreur lors du téléchargement de l'image</p>
                    <a href="ajouter_etudiant.php" class="btn btn-outline-warning">Réessayer</a>
                    <a href="accueil.php" class="btn btn-dark">Retour accueil</a>
                </div>
                <?php
            }
        }else{
            ?>
            <div class="alert alert-danger w-50 m-auto text-center mt-5 mb-5">
                <p>Format fichier invalide</p>
                <a href="ajouter_etudiant.php" class="btn btn-outline-warning">Réessayer</a>
                <a href="accueil.php" class="btn btn-dark">Retour accueil</a>
            </div>
            <?php
        }



        $sql = "INSERT INTO etudiants (id_etudiant, nom_etudiant, prenom_etudiant, adresse_etudiant, avatar_etudiant, date_naissance_etudiant, telephone_etudiant, email_etudiant, age_etudiant, formation_etudiant) VALUES (?,?,?,?,?,?,?,?,?,?)";


    //Je crée la préparation de la requête
    $requeteAjout = $db->prepare($sql);

    //Je lie les paramètres entrés dans le formulaire à ma BD
    $requeteAjout->bindParam(1, $_POST["id_etudiant"]);
    $requeteAjout->bindParam(2, $_POST["nom_etudiant"]);
    $requeteAjout->bindParam(3, $_POST["prenom_etudiant"]);
    $requeteAjout->bindParam(4, $_POST["adresse_etudiant"]);
    $requeteAjout->bindParam(5, $_POST["avatar_etudiant"]);
    $requeteAjout->bindParam(6, $_POST["date_naissance_etudiant"]);
    $requeteAjout->bindParam(7, $_POST["telephone_etudiant"]);
    $requeteAjout->bindParam(8, $_POST["email_etudiant"]);
    $requeteAjout->bindParam(9, $_POST["age_etudiant"]);
    $requeteAjout->bindParam(10, $_POST["formation_etudiant"]);


    if(isset($_POST["nom_etudiant"]) && !empty($_POST["nom_etudiant"]) && isset($_POST["prenom_etudiant"]) && !empty($_POST["prenom_etudiant"]) && isset($_POST["adresse_etudiant"]) && !empty($_POST["adresse_etudiant"])
    && isset($_POST["avatar_etudiant"]) && !empty($_POST["avatar_etudiant"]) && isset($_POST["date_naissance_etudiant"]) && !empty($_POST["date_naissance_etudiant"]) && isset($_POST["telephone_etudiant"]) && !empty($_POST["telephone_etudiant"])
    && isset($_POST["email_etudiant"]) && !empty($_POST["email_etudiant"]) && isset($_POST["age_etudiant"]) && !empty($_POST["age_etudiant"]) && isset($_POST["matiere_etudiant"]) && !empty($_POST["matiere_etudiant"])){

    //J'éxécute la requête
    $requeteAjout->execute([
    $_POST["id_etudiant"],
    trim(htmlspecialchars($_POST["nom_etudiant"])),
    trim(htmlspecialchars($_POST["prenom_etudiant"])),
    trim(htmlspecialchars($_POST["adresse_etudiant"])),
    $_POST["avatar_etudiant"],
    $_POST["date_naissance_etudiant"],
    $_POST["telephone_etudiant"],
    trim(htmlspecialchars($_POST["email_etudiant"])),
    $_POST["age_etudiant"],
    trim(htmlspecialchars($_POST["matiere_etudiant"]))

    ]);

    ?>
    <div class="alert alert-success w-50 m-auto text-center mt-5 mb-5">
        <p>Liste des formateurs mise à jour</p>
        <a href="eleves.php" class="btn btn-outline-dark">Voir l'étudiant</a>
        <a href="accueil.php" class="btn btn-secondary">Retour accueil</a>
    </div>
        <style>
            #ajoutFormateurId{
                display: none;
            }
        </style>
    <?php

    }else{
        ?>
        <div class="alert alert-danger w-50 m-auto text-center mt-5 mb-5">
            <p>Echec de l'ajout du formateur, tous les champs doivent être remplis</p>
            <a href="ajouter_etudiant.php" class="btn btn-outline-warning">Réessayer</a>
            <a href="accueil.php" class="btn btn-secondary">Retour accueil</a>

        </div>
        <style>
            #ajoutFormateurId{
                display: none;
            }
        </style>
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
