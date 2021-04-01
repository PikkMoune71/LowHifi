<?php
     //Coonexion à la BBD
    require '../database.php';
 
    $numprodError = $nameError = $prixError = $qteError = $seuilError = $caracteristiquesError = $couleurError = $largeurError = $longueurError = $profondeurError = $poidsError = $numcatError = $numfourError = $imageError = $numprod = $name = $prix = $qte = $seuil = $caracteristiques = $couleur = $largeur = $longueur = $profondeur = $poids = $numcat = $numfour = $image = "";
    //Si le formulaire n'est pas vide alors:
    if(!empty($_POST)) 
    {
        //Création des variables d'un produit
        $numprod            = ($_POST['numprod']);
        $name               = ($_POST['name']);
        $prix               = ($_POST['prix']);
        $qte                = ($_POST['qte']);
        $seuil              = ($_POST['seuil']);
        $caracteristiques   = ($_POST['caracteristiques']);
        $couleur            = ($_POST['couleur']);
        $largeur            = ($_POST['largeur']);
        $longueur           = ($_POST['longueur']);
        $profondeur         = ($_POST['profondeur']);
        $poids              = ($_POST['poids']);
        $numcat             = ($_POST['numcat']);
        $numfour            = ($_POST['numfour']);
        $image              = ($_FILES["image"]["name"]);
        $imagePath          = '../../Images/'. basename($image);
        $imageExtension     = pathinfo($imagePath,PATHINFO_EXTENSION);
        $isSuccess          = true;
        $isUploadSuccess    = false;
        
        if(empty($numprod)) //Si la variable numprod est vide alors:
        {
            $numprodError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        }
        if(empty($name)) //Si la variable name est vide alors:
        {
            $nameError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        }
        if(empty($prix)) //Si la variable prix est vide alors:
        {
            $prixError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        } 
        if(empty($qte)) //Si la variable qte est vide alors:
        {
            $qteError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        } 
        if(empty($seuil)) //Si la variable seuil est vide alors:
        {
            $seuilError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        }
        if(empty($caracteristiques)) //Si la variable caracteristiques est vide alors:
        {
            $caracteristiquesError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        }
        if(empty($couleur)) //Si la variable couleur est vide alors:
        {
            $couleurError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        } 
        if(empty($largeur)) //Si la variable largeur est vide alors:
        {
            $largeurError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        } 
        if(empty($longueur)) //Si la variable longueur est vide alors:
        {
            $longueurError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        }
        if(empty($profondeur)) //Si la variable profondeur est vide alors:
        {
            $profondeurError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        }
        if(empty($poids)) //Si la variable poids est vide alors:
        {
            $poidsError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        } 
        if(empty($numcat)) //Si la variable numcat est vide alors:
        {
            $numcatError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        } 
        if(empty($numfour)) //Si la variable numfour est vide alors:
        {
            $numfourError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        }
        // else //Sinon
        // {
        //     $isUploadSuccess = true;
        // }
        if(empty($image)) //Si la variable image est vide alors:
        {
            $imageError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        }
        else //Sinon
        {
            $isUploadSuccess = true;
            if($imageExtension != "png") //Format de l'image uniquement en png
            {
                $imageError = "Les fichiers autorises sont: .png";
                $isUploadSuccess = false;
            }
            if(file_exists($imagePath)) 
            {
                $imageError = "Le fichier existe deja";
                $isUploadSuccess = true;
            }
            if($_FILES["image"]["size"] > 500000) 
            {
                $imageError = "Le fichier ne doit pas depasser les 500KB";
                $isUploadSuccess = false;
            }
            if($isUploadSuccess) 
            {
                if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) 
                {
                    $imageError = "Il y a eu une erreur lors de l'upload";
                    $isUploadSuccess = false;
                } 
            } 
        }
        
        if($isSuccess && $isUploadSuccess) //Si $isSuccess && $isUploadSuccess sont true alors on Insert les données dans la table produit 
        {
            $db = Database::connect();
            $statement = $db->prepare("INSERT INTO produit (NumProd,NomProd,PrixProd,QteProd,SeuilReappro,Caracteristiques,Couleur,Largeur,Longueur,Profondeur,Poids,NumCat,NumFour,Imgsrc) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $statement->execute(array($numprod,$name,$prix,$qte,$seuil,$caracteristiques,$couleur,$largeur,$longueur,$profondeur,$poids,$numcat,$numfour,$image));
            Database::disconnect();
            header("Location: ../index.php");
        }
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
                <h1><strong>Ajouter un produit</strong></h1>
                <br>
                <!-- Formulaire pour insérer un prosuit -->
                <form class="form" action="insert.php" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="numprod">N° Prod:</label>
                        <input type="text" class="form-control" id="numprod" name="numprod" placeholder="Numéro Produit" value="<?php echo $numprod;?>">
                        <span class="help-inline"><?php echo $numprodError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="name">Nom:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name;?>">
                        <span class="help-inline"><?php echo $nameError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="prix">Prix: (en €)</label>
                        <input type="number" step="1.00" class="form-control" id="prix" name="prix" placeholder="Prix" value="<?php echo $prix;?>">
                        <span class="help-inline"><?php echo $prixError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="qte">Quantité:</label>
                        <input type="text" class="form-control" id="qte" name="qte" placeholder="Quantité" value="<?php echo $qte;?>">
                        <span class="help-inline"><?php echo $qteError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="seuil">Seuil:</label>
                        <input type="text" class="form-control" id="seuil" name="seuil" placeholder="Seuil" value="<?php echo $seuil;?>">
                        <span class="help-inline"><?php echo $seuilError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="caracteristiques">Caractéristiques:</label>
                        <input type="text" class="form-control" id="caracteristiques" name="caracteristiques" placeholder="Caractéristiques" value="<?php echo $caracteristiques;?>">
                        <span class="help-inline"><?php echo $caracteristiquesError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="couleur">Couleur:</label>
                        <input type="text" class="form-control" id="couleur" name="couleur" placeholder="Couleur" value="<?php echo $couleur;?>">
                        <span class="help-inline"><?php echo $couleurError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="largeur">Largeur:</label>
                        <input type="text" class="form-control" id="largeur" name="largeur" placeholder="Largeur" value="<?php echo $largeur;?>">
                        <span class="help-inline"><?php echo $largeurError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="longueur">Longueur:</label>
                        <input type="text" class="form-control" id="longueur" name="longueur" placeholder="Longueur" value="<?php echo $longueur;?>">
                        <span class="help-inline"><?php echo $longueurError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="profondeur">Profondeur:</label>
                        <input type="text" class="form-control" id="profondeur" name="profondeur" placeholder="Profondeur" value="<?php echo $profondeur;?>">
                        <span class="help-inline"><?php echo $profondeurError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="poids">Poids:</label>
                        <input type="text" class="form-control" id="poids" name="poids" placeholder="Poids" value="<?php echo $poids;?>">
                        <span class="help-inline"><?php echo $poidsError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="numcat">Catégorie:</label>
                        <select class="form-control" id="numcat" name="numcat">
                        <?php
                           $db = Database::connect();
                           foreach ($db->query('SELECT * FROM categorie') as $row) 
                           {
                                echo '<option value="'. $row['NumCat'] .'">'. $row['LibCat'] . '</option>';;
                           }
                           Database::disconnect();
                        ?>
                        </select>
                        <span class="help-inline"><?php echo $numcatError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="numfour">Numéro Fournisseur:</label>
                        <input type="text" class="form-control" id="numfour" name="numfour" placeholder="Numéro Fournisseur" value="<?php echo $numfour;?>">
                        <span class="help-inline"><?php echo $numfourError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="image">Sélectionner une image:</label>
                        <input type="file" id="image" name="image"> 
                        <span class="help-inline"><?php echo $imageError;?></span>
                    </div>
                    <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Ajouter</button>
                        <a class="btn btn-primary" href="../index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                   </div>
                </form>
            </div>
        </div>   
    </body>
</html>