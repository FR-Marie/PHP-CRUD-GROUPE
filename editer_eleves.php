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
    
    
      //Requète SQL de selection des produits
      $sql = "SELECT * FROM etudiants WHERE id_etudiant = ?";

      $etudiantID = $_GET["id_etudiant"];

      //Requète préparée = PDO::prepare — Prépare une requête à l'exécution et retourne un objet
      //https://www.php.net/manual/fr/pdo.prepare.php
      $request = $db->prepare($sql);
      //Lié les paramètres = 1 = ? dans = sql : ca valeur est id recuperer dans URL grace a $_GET['id_produit']
      $request->bindParam(1, $etudiantID);

      //Execution de la requète(un tableau de string) execute(array)
      $request->execute();
      //Retourne un tableau associatif de resultats et on le stock dans une variable sous forme  cle/valeur
      $etudiant_edit = $request->fetch(PDO::FETCH_ASSOC);
      $dateNaissance = new \DateTime($etudiant_edit["date_naissance_etudiant"]);

}
?>


<!-------------------------AFFICHAGE INFOS PERSONNELLES------------------------>

<div class="container text-center justify-content-center mt-5">
    <div class="row">

     


        <!----------------------IDENTIFIANTS----------------------->


          
                <div class="mb-5 w-50 m-auto">
                    <div class="card h-100"><div class="container text-left">

            <!--On passe ID pour le traitement-->

            
            <form method="POST" enctype="multipart/form-data" class="m-auto text-white bg-secondary rounded  border border-dark text-start p-5 mb-5 ">
                <h3 class="text-white">EDITER INFORMATION ELEVE<?= $etudiant_edit["nom_etudiant"] . " " . $etudiant_edit["nom_etudiant"] ?></h3>
                <div class="mb-3">
                    <label for="nom_etudiant" class="form-label">Nom  élève</label>
                    <input type="text" class="form-control" id="nom_etudiant" name="nom_etudiant" placeholder="<?= $etudiant_edit['nom_etudiant'] ?>" required>
                </div>
           
                <div class="mb-3">
                    <label for="prenom_etudiant" class="form-label">Prénom élève</label>
                    <input type="text" class="form-control" id="prenom_etudiant" name="prenom_etudiant" placeholder="<?= $etudiant_edit['prenom_etudiant'] ?>" required>
                </div>
               
                <div class="mb-3">
                    <label for="formation_etudiant" class="form-label">Formation  élève</label>
                    <input type="text" class="form-control" id="formation_etudiant" name="formation_etudiant" placeholder="<?= $etudiant_edit['formation_etudiant'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="adresse_etudiant" class="form-label">Adresse  élève</label>
                    <input type="text" class="form-control" id="adresse_etudiant" name="adresse_etudiant" placeholder="<?= $etudiant_edit['adresse_etudiant'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="telephone_etudiant" class="form-label">N° téléphone</label>
                    <input type="text" class="form-control" id="telephone_etudiant" name="telephone_etudiant" placeholder="<?= $etudiant_edit['telephone_etudiant'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="age_etudiant" class="form-label">Age</label>
                    <input type="text" class="form-control" id="age_etudiant" name="age_etudiant" placeholder="<?= $etudiant_edit['age_etudiant'] ?>" required>
                </div>

                <div class="mb-3">
                    <label for="email_etudiant" class="form-label">Email  élève</label>
                    <textarea class="form-control" rows="5" id="email_etudiant" name="email_etudiant" placeholder="<?= $etudiant_edit['email_etudiant'] ?>" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="date_naissance_etudiant" class="form-label">Date de naissance élève</label>
                    <input type ="date" class="form-control" id="date_naissance_etudiant" name="date_naissance_etudiant" required></input>
                </div>
            
                <div class="mb-3">
                    <label for="avatar_etudiant" class="form-label">Image élève</label>
                    <input type="file" class="form-control" id="avatar_etudiant" name="avatar_etudiant" required >
                </div>

                <div class="d-flex justify-content-around">
                    <button type="submit" name="btn-connexion" class="btn btn-secondary btn-sm">Mettre a jour</button>
                    <a href="eleves.php" class="btn btn-dark btn-sm">Annuler</a>
                </div>
            </form>

        </div>
        </div>
        

        </div>

    </div>







<!-----------------------SI SESSION PAS OK------------------------->



<?php
/////////////NE PAS OUBLIER : <form enctype="multipart/form-data">//////////////////

//Upload de fichier
//Existance de ma superglobale $_FILES
//<input de type file + attribut name="">


if (isset($_POST["btn-connexion"])){
        
    if(isset($_FILES['avatar_etudiant'])){
        //Repertoire de destination
        $repertoireDestination = "assets/";
        //La photo uploader
        //basename — Retourne le nom de la composante finale d'un chemin
        //dans tableau multi dimmension 1 = image 2 = son nom
        $avatar_etudiant =  $repertoireDestination . basename($_FILES['avatar_etudiant']['name']);
        //Recup de l'image uploader
        //On assigne l'image uploader au repertoire de destination + la photo + son nom
        $_POST['avatar_etudiant'] =  $avatar_etudiant;

        //Les conditions de resussite
        //move_uploaded_file — Déplace un fichier téléchargé
        //On assigne a la photo un nom temporaire random en cas d'echec d'upload
        if(move_uploaded_file($_FILES['avatar_etudiant']['tmp_name'], $avatar_etudiant)){
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
    //Requète SQL de selection des produits
    $sql = "UPDATE `etudiants` SET `nom_etudiant`= ?,`prenom_etudiant`= ?,`formation_etudiant`= ?,`adresse_etudiant`= ?,`telephone_etudiant`=?,`age_etudiant`=?,`email_etudiant`=?,`date_naissance_etudiant`= ?,`avatar_etudiant`= ? WHERE id_etudiant = ?";
    //Requète préparée = connexion + methode prepare + requete sql
    //Les requètes préparée lutte contre les injections SQL
    //PDO::prepare — Prépare une requête à l'exécution et retourne un objet
    $request = $db->prepare($sql);
    //executer la requète préparée
    //PDOStatement::execute — Exécute une requête préparée
    //Elle execute la reqète passé dans un tableau de valeur
    $id = $_GET['id_etudiant'];
    $request->execute(array(
        $_POST['nom_etudiant'],
        $_POST['prenom_etudiant'],
        $_POST['formation_etudiant'],
        $_POST['adresse_etudiant'],
        $_POST['telephone_etudiant'],
        $_POST['age_etudiant'],
        $_POST['email_etudiant'],
        $_POST['date_naissance_etudiant'],
        $_POST['avatar_etudiant'],
        $id
    ));

  
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
</div><!-- Footer-->
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