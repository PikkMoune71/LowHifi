<?php
    require '../database.php';
 
    if(!empty($_GET['id'])) 
    {
        $id = checkInput($_GET['id']);
    }
    $db = Database::connect();
    $req = $db->query("SELECT * FROM produit WHERE IdProd = ?");

    if(!empty($_POST)) {
        $errors = array();
        $id = checkInput($_POST['id']);
        $reponse = $db->prepare('SELECT Imgsrc FROM produit WHERE IdProd = ?');
        $reponse->execute(array($id));
        $donnees = $reponse->fetch();
        unlink('../../img/product/' . $donnees['Imgsrc']);
        $statement = $db->prepare("DELETE FROM produit WHERE IdProd = ?");
        $statement->execute(array($id));
        header("Location: index.php"); 
    }

    function checkInput($data) 
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
                <h1><strong>Supprimer un item</strong></h1>
                <br>
                <form class="form" action="delete.php" role="form" method="post">
                    <input type="hidden" name="id" value="<?php echo $id;?>"/>
                    <p class="alert alert-warning">Etes vous sur de vouloir supprimer ?<?php echo $req['IdProd'];?></p>
                    <div class="form-actions">
                      <button type="submit" class="btn btn-warning">Oui</button>
                      <a class="btn btn-default" href="../index.php">Non</a>
                    </div>
                </form>
            </div>
        </div>   
    </body>
</html>

