<?php
//Demmarer une seesion utilisateur php
session_start();
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

        <title>Connexion</title>


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
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Accueil</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Connexion</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Services</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        

<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card px-5 py-5" id="form1">
                <div class="form-data" v-if="!submitted">
                    <div class="text-center">
                    <img src="assets/logo-lycee-henri4-500.jpg" width="50%"  alt="Lycée Henri IV" title="Lycée Henri IV.com">
        </div>
    <form  id="formulaire-connexion" method="post">
      <!-- method = "post" va permettre de recupérer  l'attribut name="" !-->
        <div class="forms-inputs mb-4">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email"  required/>
        </div>


    <form method="post">
        <div class="forms-inputs mb-4">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
        </div>
        <div class="mb-3"> <button type="submit" name="btn-connexion" class="btn btn-dark w-100">Connexion</button> </div>
    
    </form>

</div>
</div>
        </div>
    </div>
    </div>
    </div>


        <!-----------------------------------CONDITIONS DE LA FONCTION CONNEXION------------------------------------>
        <?php
        function connexion(){
            //-------------CONNEXION A LA BD----------------
            $user = "root";
            $pass = "";

            try{

                //instance de la classe PDO (PHP DATA OBJECT!)
                $db = new PDO("mysql:host=localhost;dbname=ecole_assiamarie;charset=UTF8", $user, $pass);

                //debug ATTR_ERRMODE : rapport d'erreurs.  ERRMODE_EXCEPTION : émet une exception.
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                ?>
                <div>
                    <p class="connexionPDOMYSQL text-center text-warning">Connexion à PDO MySQL réussie</p>
                </div>
                <?php
            }catch(PDOException $a){
                ?>
                <div>
                    <p class="text-center text-warning">Erreur! <?= $a->getMessage() ?></p>
                </div>
                <?php
                die();
            }


            //Existence des champs et non vide
            if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])){

                ;
                //faille xss = ON DESINFECTE LES DONNÉES = Sanitize
                //trim — Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
                //htmlspecialchars — Convertit les caractères spéciaux en entités HTML :: Cette fonction retourne une chaîne de caractères avec ces modifications
                $emailAdmin = trim(htmlspecialchars($_POST['email']));
                $passwordAdmin = trim(htmlspecialchars($_POST['password']));

                //Debug
                //var_dump($emailAdmin);
                //var_dump($passwordAdmin);

                //Requete avec le prediquats AND = &&
                $sql = "SELECT * FROM admins WHERE email = ? AND password = ?";

                //requète préparée pour lutter contre les inection SQL
                $connexion = $db->prepare($sql);

                //Lie les paramètre du formulaire a  la requète SQL
                $connexion->bindParam(1, $emailAdmin);
                $connexion->bindParam(2, $passwordAdmin);

                //Execute la requète et retourne un tableau associatif
                $connexion->execute();

                //S'il y a au moins 1 utilisateur dans la table de la BD
                if($connexion->rowCount() >= 0){
                    //On stock dans une variable le dernier resultat
                    //PDOStatement::fetch — Récupère la ligne suivante d'un jeu de résultats PDO
                    $entree = $connexion->fetch();

                    //var_dump($connexion->rowCount());

                    //si résultat true=>
                    if($entree == true){
                        $email = $entree["email"];
                        $password = $entree["password"];

                        //var_dump($email);
                        //var_dump($password);

                        ///////////////-----SI C'EST OK--------
                        if ($emailAdmin === $email && $passwordAdmin === $password){
                            //Création et stockage de la "variable de connexion" avec $_SESSION et redirection sur la page d'accueil
                            $_SESSION["email"] = $emailAdmin;
                            header("location:accueil.php");
                        }else{
                            ?>
                            <div>
                                <p class="alertConnexion text-center">/!\ LA TABLE EST VIDE /!\</p>
                            </div>
                            <?php

                        }
                    }else{
                        //erreur de mail et/ou de mot de passe
                        ?>
                        <div>
                            <p class="alertConnexion text-center">!! Identifiants invalides !!</p>
                        </div>
                        <?php
                    }

                }
            }else{
                ?>
                <div>
                    <p class="alertConnexion text-center">!! Merci de remplir tous les champs</p>
                </div>
                <?php
            }

            //accolade fonction connexion
        }
        ?>


<!-----------------------------------FONCTION CONNEXION DU BOUTON APPELEE------------------------------------>
        <?php

        if (isset($_POST["btn-connexion"])){
            connexion();
        }

        ?>


        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container px-4 px-lg-5"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="/js/scripts.js"></script>
    </body>
</html>
