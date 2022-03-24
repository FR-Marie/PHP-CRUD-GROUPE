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
    ?>


    <!----------------------FORMULAIRE POUR AJOUTER UN FORMATEUR--------------------------->

    <div class="container-fluid">
        <div class="row" id="ajoutFormateurId">

            <h2 class="text-white text-center mt-5">Editer</h2>

            <div class="col mt-3">

                <form method="POST" enctype="multipart/form-data" class="w-25 m-auto text-white bg-secondary rounded  border border-dark text-start ps-5 mb-5 pb-5">

                    <div class="mt-5 mb-2">
                        <label for="nom_formateur" class="d-block">Nom: </label>
                        <input type="text" name="nom_formateur" required>
                    </div>

                    <div class="mb-2">
                        <label for="prenom_formateur" class="d-block">Prénom: </label>
                        <input type="text" name="prenom_formateur" required>
                    </div>

                    <div class="mb-3">
                        <label for="adresse_formateur" class="d-block">Adresse postale: </label>
                        <textarea type="text" name="adresse_formateur" required></textarea>
                    </div>

                    <div class="mb-2">
                        <label for="date_naissance_formateur" class="d-block">Date de naissance: </label>
                        <input type="date" name="date_naissance_formateur" required>
                    </div>

                    <div class="mb-3">
                        <label for="telephone_formateur" class="d-block">Téléphone: </label>
                        <input type="number" min=0 name="telephone_formateur" required>
                    </div>

                    <div class="mb-3">
                        <label for="email_formateur" class="d-block">Adresse email: </label>
                        <input type="email" name="email_formateur" required>
                    </div>

                    <div class="mb-2">
                        <label for="age_formateur" class="d-block">Age: </label>
                        <input type="number" min=0 name="age_formateur" required>
                    </div>

                    <div class="mb-2">
                        <label for="matiere_formateur" class="d-block">Poste: </label>
                        <input type="text" name="matiere_formateur" required>
                    </div>

                    <div class="mb-4">
                        <label for="avatar_formateur" class="d-block">Avatar: </label>
                        <input type="file" name="avatar_formateur" class="" required>
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

        if(isset($_FILES["avatar_formateur"])){

            //REPERTOIRE DE DESTINATION DES IMAGES
            $repertoireImage = "assets/";

            //répertoire de destination + composante finale d'un chemin (basename) avec en paramètres
            //un tableau associatif multi dim $_FILES["avatar_formateur"]["name"] (name = le nom de l'image)
            $avatar_formateur = $repertoireImage . basename($_FILES["avatar_formateur"]["name"]);

            //RECUP DE L'IMAGE téléchargée du formulaire ($_POST) avec son répertoire, son nom et son image
            $_POST["avatar_formateur"] = $avatar_formateur;


            //////["tmp_name"]nom temporaire donné à l'image le temps de l'action (au cas où ça crash)
            if(move_uploaded_file($_FILES["avatar_formateur"]["tmp_name"], $avatar_formateur)){
                ?>
                <div class="alert alert-success w-50 m-auto text-center mt-5 mb-5">
                    <p>Fichier validé et téléchargé avec succès</p>
                </div>
                <?php
            }else{
                ?>
                <div class="alert alert-danger w-50 m-auto text-center mt-5 mb-5">
                    <p>Erreur lors du téléchargement de l'image</p>
                    <a href="ajouter_formateur.php" class="btn btn-outline-warning">Réessayer</a>
                    <a href="accueil.php" class="btn btn-dark">Retour accueil</a>
                </div>
                <?php
            }
        }else{
            ?>
            <div class="alert alert-danger w-50 m-auto text-center mt-5 mb-5">
                <p>Format fichier invalide</p>
                <a href="ajouter_formateur.php" class="btn btn-outline-warning">Réessayer</a>
                <a href="accueil.php" class="btn btn-dark">Retour accueil</a>
            </div>
            <?php
        }


////////REQUETE SQL POUR INSERER LE FORMATEUR A LA TABLE FORMATEURS LORS DE LA VALIDATION///////////
        $sql = "INSERT INTO formateurs (id_formateur, nom_formateur, prenom_formateur, adresse_formateur, avatar_formateur, date_naissance_formateur, telephone_formateur, email_formateur, age_formateur, matiere_formateur) VALUES (?,?,?,?,?,?,?,?,?,?)";


    //Je crée la préparation de la requête (lutte contre les injections SQL)
    $requeteAjout = $db->prepare($sql);

    //Je lie les paramètres entrés dans le formulaire à ma ceux de ma BD
    $requeteAjout->bindParam(1, $_POST["id_formateur"]);
    $requeteAjout->bindParam(2, $_POST["nom_formateur"]);
    $requeteAjout->bindParam(3, $_POST["prenom_formateur"]);
    $requeteAjout->bindParam(4, $_POST["adresse_formateur"]);
    $requeteAjout->bindParam(5, $_POST["avatar_formateur"]);
    $requeteAjout->bindParam(6, $_POST["date_naissance_formateur"]);
    $requeteAjout->bindParam(7, $_POST["telephone_formateur"]);
    $requeteAjout->bindParam(8, $_POST["email_formateur"]);
    $requeteAjout->bindParam(9, $_POST["age_formateur"]);
    $requeteAjout->bindParam(10, $_POST["matiere_formateur"]);


    ///Condition si les champs sont existants et remplis =>
    if(isset($_POST["nom_formateur"]) && !empty($_POST["nom_formateur"]) && isset($_POST["prenom_formateur"]) && !empty($_POST["prenom_formateur"]) && isset($_POST["adresse_formateur"]) && !empty($_POST["adresse_formateur"])
    && isset($_POST["avatar_formateur"]) && !empty($_POST["avatar_formateur"]) && isset($_POST["date_naissance_formateur"]) && !empty($_POST["date_naissance_formateur"]) && isset($_POST["telephone_formateur"]) && !empty($_POST["telephone_formateur"])
    && isset($_POST["email_formateur"]) && !empty($_POST["email_formateur"]) && isset($_POST["age_formateur"]) && !empty($_POST["age_formateur"]) && isset($_POST["matiere_formateur"]) && !empty($_POST["matiere_formateur"])){


    //J'éxécute la requête et je pense à désinfecter les champs du formulaire où il y a des chaînes de caractère
    $requeteAjout->execute([
    $_POST["id_formateur"],
    trim(htmlspecialchars($_POST["nom_formateur"])),
    trim(htmlspecialchars($_POST["prenom_formateur"])),
    trim(htmlspecialchars($_POST["adresse_formateur"])),
    $_POST["avatar_formateur"],
    $_POST["date_naissance_formateur"],
    $_POST["telephone_formateur"],
    trim(htmlspecialchars($_POST["email_formateur"])),
    $_POST["age_formateur"],
    trim(htmlspecialchars($_POST["matiere_formateur"]))

    ]);

    ?>
    <div class="alert alert-success w-50 m-auto text-center mt-5 mb-5">
        <p>Liste des formateurs mise à jour</p>
        <a href="affichage_formateurs.php" class="btn btn-outline-dark">Voir formateurs</a>
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
            <a href="ajouter_formateur.php" class="btn btn-outline-warning">Réessayer</a>
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
