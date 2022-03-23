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

      $id_etudiant = $_GET['id_etudiant'];

      //Requète préparée = PDO::prepare — Prépare une requête à l'exécution et retourne un objet
      //https://www.php.net/manual/fr/pdo.prepare.php
      $request = $db->prepare($sql);
      //Lié les paramètres = 1 = ? dans = sql : ca valeur est id recuperer dans URL grace a $_GET['id_produit']
      $request->bindParam(1, $id_etudiant);

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
                    <div class="card h-100">
                        <div class="card-header"><h2><?= $details["nom_etudiant"] . "<br>" . $details["prenom_etudiant"]?></h2></div>
                        <div class="card-body">
                            <h2><?= $details["formation_etudiant"]?></h2>

                            <p class="card-text">
                                <img src="<?= $details["avatar_etudiant"]?>">
                            </p>
                            <b class="text-dark">Adresse: </b><p class="text-dark"><?= $details["adresse_etudiant"]?></p>
                            <b class="text-dark">N° téléphone:</b> <p class="text-dark"><?= $details["telephone_etudiant"]?></p>
                            <b class="text-dark">Email: </b> <p class="text-dark"><?= $details["email_etudiant"]?></p>
                            <b class="text-dark">Age:  </b> <p class="text-dark"><?= $details["age_etudiant"]?> ans</p>
                            <b class="text-dark">Date de naissance: </b> <p class="text-dark"><?= $dateNaissance->format('d-m-Y')?></p>
                           
                        </div>

                        <div class ="card-footer d-flex text-center">
                        
                                      

                        
                            <div><a href="editer_eleves.php?id_etudiant=<?=$details['id_etudiant']?>"class="btn btn-secondary btn-sm me-2">Editer</a></div>
                        
                        <form method="POST">
                        <div><a href="supprimer_etudiant.php?id_etudiant=<?=$details['id_etudiant']?>"class="btn btn-secondary btn-sm me-2">Supprimer</a></div>
                        </form>

                        <div>
                
                        <a class="btn btn-primary btn-sm" href="eleves.php">Retour</a>
                    </div>
                    </div>

                    </div>
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

    <div class="container px-4 px-lg-5 w-100"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>

    

</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>

