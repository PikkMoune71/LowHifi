<?php
    require '../database.php';

    if(!empty($_GET['id'])) 
    {
        $id = checkInput($_GET['id']);
    }
     
    $db = Database::connect();
    $statement = $db->prepare("SELECT NumProd, NomProd, PrixProd, QteProd, SeuilReappro, Caracteristiques, Couleur, Largeur, Longueur, Profondeur, Poids, NumCat, NumFour, Imgsrc FROM produit WHERE NumProd = ?");
    $statement->execute(array($id));
    $produit = $statement->fetch();
    Database::disconnect();

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
    <title>LowHifi - Produit</title>
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
               <div class="col-sm-6">
                    <h1><strong>Voir un produit</strong></h1>
                    <br>
                    <form>
                      <div class="form-group">
                        <label>Nom:</label><?php echo '  '.$produit['NomProd'];?>
                      </div>
                      <div class="form-group">
                        <label>Prix:</label><?php echo '  '.number_format((float)$produit['PrixProd'], 2, '.', ''). ' €';?>
                      </div>
                      <div class="form-group">
                        <label>Quantité:</label><?php echo '  '.$produit['QteProd'];?>
                      </div>
                      <div class="form-group">
                        <label>Seuil:</label><?php echo '  '.$produit['SeuilReappro'];?>
                      </div>
                      <div class="form-group">
                        <label>Caractéristiques:</label><?php echo '  '.$produit['Caracteristiques'];?>
                      </div>
                      <div class="form-group">
                        <label>Couleur:</label><?php echo '  '.$produit['Couleur'];?>
                      </div>
                      <div class="form-group">
                        <label>Largeur:</label><?php echo '  '.$produit['Largeur'];?>
                      </div>
                      <div class="form-group">
                        <label>Longueur:</label><?php echo '  '.number_format((float)$produit['Longueur'], 2, '.', ''). ' €';?>
                      </div>
                      <div class="form-group">
                        <label>Profondeur:</label><?php echo '  '.$produit['Profondeur'];?>
                      </div>
                      <div class="form-group">
                        <label>Poids:</label><?php echo '  '.$produit['Poids'];?>
                      </div>
                      <div class="form-group">
                        <label>Numéro Catégorie:</label><?php echo '  '.$produit['NumCat'];?>
                      </div>
                      <div class="form-group">
                        <label>Numéro Fournisseur:</label><?php echo '  '.$produit['NumFour'];?>
                      </div>
                      <div class="form-group">
                        <label>Image:</label><?php echo '  '.$produit['Imgsrc'];?>
                      </div>
                    </form>
                    <br>
                    <div class="form-actions">
                      <a class="btn btn-primary" href="../index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                    </div>
                </div> 
                <div class="col-sm-6 site">
                    <div class="thumbnail">
                        <img src="<?php echo '../../Images/'.$produit['Imgsrc'];?>" alt="...">
                        <div class="price"><?php echo number_format((float)$produit['PrixProd'], 2, '.', ''). ' €';?></div>
                          <div class="caption">
                            <h4><?php echo $produit['NomProd'];?></h4>
                            <p><?php echo $produit['Caracteristiques'];?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
    </body>
</html>

