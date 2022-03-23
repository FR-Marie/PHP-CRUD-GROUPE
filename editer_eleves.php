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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container px-5">
        <a class="navbar-brand" href="#!">Lycée Henri IV</a>
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
    
    
      //Requète SQL de selection des produits
      $sql = "SELECT * FROM etudiants WHERE id_etudiant = ?";

      $etudiant_id = $_GET['id_etudiant'];

      //Requète préparée = PDO::prepare — Prépare une requête à l'exécution et retourne un objet
      //https://www.php.net/manual/fr/pdo.prepare.php
      $request = $db->prepare($sql);
      //Lié les paramètres = 1 = ? dans = sql : ca valeur est id recuperer dans URL grace a $_GET['id_produit']
      $request->bindParam(1, $etudiant_id);

      //Execution de la requète(un tableau de string) execute(array)
      $request->execute();
      //Retourne un tableau associatif de resultats et on le stock dans une variable sous forme  cle/valeur
      $details = $request->fetch(PDO::FETCH_ASSOC);
      $dateNaissance=new \DateTime($details["date_naissance_etudiant"]);

}
?>


<!-------------------------AFFICHAGE INFOS PERSONNELLES------------------------>

<div class="container text-center justify-content-center mt-5">
    <div class="row">

     


        <!----------------------IDENTIFIANTS----------------------->


          
                <div class="mb-5 w-50 m-auto">
                    <div class="card h-100"><div class="container text-left">

            <!--On passe ID pour le traitement-->

            <form action="traitement_editer.php?id_etudiant=<?= $details['id_etudiant'] ?>"  id="form-update" method="post" enctype="multipart/form-data">
                <h3 class="text-white">EDITER INFORMATION ELEVE</h3>
                <div class="mb-3">
                    <label for="nom_etudiant" class="form-label">Nom  élève</label>
                    <input type="text" class="form-control" id="nom_etudiant" name="nom_etudiant" placeholder="<?= $details['nom_etudiant'] ?>" required>
                </div>
           
                <div class="mb-3">
                    <label for="prenom_etudiant" class="form-label">Prénom élève</label>
                    <input type="text" class="form-control" id="prenom_etudiant" name="prenom_etudiant" placeholder="<?= $details['prenom_etudiant'] ?>" required>
                </div>
               
                <div class="mb-3">
                    <label for="formation_etudiant" class="form-label">Formation  élève</label>
                    <input type="text" class="form-control" id="formation_etudiant" name="formation_etudiant" placeholder="<?= $details['formation_etudiant'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="adresse_etudiant" class="form-label">Adresse  élève</label>
                    <input type="text" class="form-control" id="adresse_etudiant" name="adresse_etudiant" placeholder="<?= $details['adresse_etudiant'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="telephone_etudiant" class="form-label">N° téléphone</label>
                    <input type="text" class="form-control" id="telephone_etudiant" name="telephone_etudiant" placeholder="<?= $details['telephone_etudiant'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="age_etudiant" class="form-label">Age</label>
                    <input type="text" class="form-control" id="age_etudiant" name="age_etudiant" placeholder="<?= $details['age_etudiant'] ?>" required>
                </div>

                <div class="mb-3">
                    <label for="email_etudiant" class="form-label">Email  élève</label>
                    <textarea class="form-control" rows="5" id="email_etudiant" name="email_etudiant" placeholder="<?= $details['email_etudiant'] ?>" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="date_naissance_etudiant" cproduitlass="form-label">Date de naissance élève</label>
                    <textarea class="form-control" rows="5" id="date_naissance_etudiant" name="date_naissance_etudiant" placeholder="<?= $details['date_naissance_etudiant'] ?>" required></textarea>
                </div>
            
                <div class="mb-3">
                    <label for="avatar_etudiant" class="form-label">Image élève</label>
                    <input type="file" class="form-control" id="avatar_etudiant" name="avatar_etudiant" required placeholder="<?= $details['avatar_etudiant'] ?>">
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
</div>






<!-----------------------SI SESSION PAS OK------------------------->


<!-- Footer-->
<footer class="py-5 bg-dark">

    <div class="container px-4 px-lg-5 w-100"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>

    

</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>

<?php
/////////////NE PAS OUBLIER : <form enctype="multipart/form-data">//////////////////

//Upload de fichier
//Existance de ma superglobale $_FILES
//<input de type file + attribut name="">

if(isset($_FILES['avatar_etudiant'])){
    //Repertoire de destination
    $repertoireDestination = "../assets/img/";
    //La photo uploader
    //basename — Retourne le nom de la composante finale d'un chemin
    //dans tableau multi dimmension 1 = image 2 = son nom
    $photo_etudiant = $repertoireDestination . basename($_FILES['avatar_etudiant']['name']);
    //Recup de l'image uploader
    //On assigne l'image uploader au repertoire de destination + la photo + son nom
    $_POST['avatar_etudiant'] = $photo_etudiant;

    //Les conditions de resussite
    //move_uploaded_file — Déplace un fichier téléchargé
    //On assigne a la photo un nom temporaire random en cas d'echec d'upload
    if(move_uploaded_file($_FILES['avatar_']['tmp_name'], $avatar_etudiant)){
        echo "<p class='container alert alert-success'>Le fichier est valide et téléchargé avec succès !</p>";
    }else{
        echo "<p class='container alert alert-danger'>Erreur lors du téléchargement de votre fichier !</p>";
    }
}else{
    echo "<p class='container alert alert-danger'>Le fichier est invalide seul les format .png, .jpg, .bmp, .svg, .webp sont autorisé !</p>";
}


//Connexion a la base de donnée ecommer via PDO
//Les variable de phpmyadmin
$user = "root";
$pass = "";
//test d'erreur
try {
    /*
     * PHP Data Objects est une extension définissant l'interface pour accéder à une base de données avec PHP. Elle est orientée objet, la classe s’appelant PDO.
     */
    //Instance de la classe PDO (Php Data Object)
    $dbh = new PDO('mysql:host=localhost;dbname=ecole_assiamarie', $user, $pass);
    //Debug de pdo
    /*
     * L'opérateur de résolution de portée (aussi appelé Paamayim Nekudotayim) ou, en termes plus simples,
     * le symbole "double deux-points" (::), fournit un moyen d'accéder aux membres static ou constant, ainsi qu'aux propriétés ou méthodes surchargées d'une classe.
     */
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p class='container alert alert-success text-center'>Vous êtes connectez a PDO MySQL</p>";

} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

if($dbh){
    //Requète SQL de selection des produits
    $sql = "UPDATE `etudiants` SET `nom_etudiant`= ?,`prenom_etudiant`= ?,`formation_etudiant`= ?,`adresse_etudiant`= ?,`telephone_etudiant`=?,`age_etudiant`=?,`email_etudiant`=?,`date_naissance_etudiant`= ?,`avatar_etudiant`= ? WHERE id_etudiant = ?";
    //Requète préparée = connexion + methode prepare + requete sql
    //Les requètes préparée lutte contre les injections SQL
    //PDO::prepare — Prépare une requête à l'exécution et retourne un objet
    $update = $dbh->prepare($sql);
    //executer la requète préparée
    //PDOStatement::execute — Exécute une requête préparée
    //Elle execute la reqète passé dans un tableau de valeur
    $id_etudiant=$_GET['id_etudiant'];
    $update->execute(array(
        $_POST['nom_etudiant'],
        $_POST['prenom_etudiant'],
        $_POST['formation_etudiant'],
        $_POST['adresse_etudiant'],
        $_POST['telephone_etudiant'],
        $_POST['age_etudiant'],
        $_POST['email_etudiant'],
        $_POST['date_naissance_etudiant'],
        $_POST['image_etudiant'],
        $id_etudiant
    ));

    if($update){
        echo "<p class='container alert alert-success'>Votre produit a été mis a jour avec succès !</p>";
        echo "<div class='text-center'><a href='produits.php' class='container btn btn-success'>Voir mon produit</a></div> ";
    }else{
        echo "<p class='alert alert-danger'>Erreur lors de l'ajout de produit</p>";
    }
}
}else{
    echo "<a href='' class='btn btn-warning'>S'inscrire</a>";
}
?>

