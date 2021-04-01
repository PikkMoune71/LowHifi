<?php
    //Connexion à la BBD
    require '../../database.php';
    global $db;
 
    if(!empty($_GET['id'])) 
    {
        $id = checkInput($_GET['id']);
    }

    //Si le formulaire n'est pas vide alors:
    if(!empty($_POST)) {
        $errors = array();
        $id = checkInput($_POST['id']); //Récupère l'id
        $statement = $db->prepare("UPDATE produit SET Catalogue = 1 WHERE NumProd = ?"); //Prepare la modification du catalogue
        $statement->execute(array($id));//Execute la requete
        header("Location: ../index.php"); //Renvoie à la page index.php de l'admin
    }

    function checkInput($data) //Fonction permettant de sécuriser les données entrées dans le formulaire
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="../../script.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link href="http://fonts.googleapis.com/css?family=Crete+Round" rel="stylesheet">
        <link rel="shortcut icon" href="../../Images/Logo.png">
        <link href="../../style.css" rel="stylesheet">
        <title>LowHifi</title>
    </head>
    
    <body>
        <header> 
            <div class="wrapper">
                <h1>LowHifi<span class="orange">.</span></h1>
                <nav>
                    <ul>
                        <li><a href="../../#main-image">Accueil</a></li>
                        <li><a href="../../produit.php">Produits</a></li>
                        <li><a href="../../#contact">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </header>

         <div class="container admin">
            <div class="row">
                <?php 
                    //Si nous pouvons récupérer l'id à partir de l'url alors:
                    if(!empty($_GET['id'])) 
                    {
                        $id = checkInput($_GET['id']); //Déclaration de la variable id
                    }
                    // var_dump($donnees['NumProd']);
                    $reqU = $db->query("SELECT NumProd, NomProd FROM produit WHERE NumProd = '$id'");//Selectionne tous les produit dont le NumProd est égal à l'id
                    while($donnees = $reqU->fetch()){ //Tant qu'il reste des données à parcourir alors:
                        echo '<h1><strong>Ajouter le produit '.$donnees['NumProd'].' au catalogue ?</strong></h1>';
                    }
                ?>
                <br>
                <form class="form" action="affichercatalogue.php" role="form" method="post">
                    <input type="hidden" name="id" value="<?php echo $id;?>"/>
                    <p class="alert alert-warning">Voulez-vous ajouter le produit au catalogue ?</p>
                    <div class="form-actions">
                      <button type="submit" class="btn btn-warning">Oui</button>
                      <a class="btn btn-default" href="../index.php">Non</a>
                    </div>
                </form>
            </div>
        </div>   
    </body>
</html>