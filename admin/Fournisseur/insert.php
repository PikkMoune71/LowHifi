<?php
    //Connexion à la BBD
    require '../database.php';
 
    $numError = $nameError = $adresseError = $cpError = $villeError = $num = $name = $adresse = $cp = $ville = "";
    //Si le formulaire n'est pas vide alors:
    if(!empty($_POST)) 
    {
        //Création des variables d'un produit
        $num               = checkInput($_POST['num']);
        $name               = checkInput($_POST['name']);
        $adresse             = checkInput($_POST['adresse']); 
        $cp                 = checkInput($_POST['cp']); 
        $ville              = checkInput($_POST['ville']);
        $isSuccess          = true;
        $isUploadSuccess    = false;
        
        if(empty($num)) //Si la variable num est vide alors:
        {
            $numError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        }
        if(empty($name)) //Si la variable nomP est vide alors:
        {
            $nameError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        } 
        if(empty($adresse)) //Si la variable adresse est vide alors:
        {
            $adresseError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        }
        if(empty($cp)) //Si la variable cp est vide alors:
        {
            $cpError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        }
        if(empty($ville)) //Si la variable ville est vide alors:
        {
            $villeError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        }
        else //Sinon
        {
            $isUploadSuccess = true;
        }
        
        if($isSuccess && $isUploadSuccess) //Si $isSuccess && $isUploadSuccess sont true alors on Insert les données dans la table utilisateur 
        {
            $db = Database::connect();
            $statement = $db->prepare("INSERT INTO fournisseur (NumFour,NomFour,AdrFour,CPFour,VilleFour) values(?, ?, ?, ?, ?)");
            $statement->execute(array($num,$name,$adresse,$cp,$ville));
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
                <h1><strong>Ajouter un fournisseur</strong></h1>
                <br>
                <!-- Formulaire pour insérer un prosuit -->
                <form class="form" action="insert.php" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="num">N°:</label>
                        <input type="text" class="form-control" id="num" name="num" placeholder="Numéro Fournisseur" value="<?php echo $num;?>">
                        <span class="help-inline"><?php echo $numError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="name">Nom:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name;?>">
                        <span class="help-inline"><?php echo $nameError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse:</label>
                        <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse" value="<?php echo $adresse;?>">
                        <span class="help-inline"><?php echo $adresseError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="cp">CP:</label>
                        <input type="number" class="form-control" id="cp" name="cp" placeholder="CP" value="<?php echo $cp;?>">
                        <span class="help-inline"><?php echo $cpError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="ville">Ville:</label>
                        <input type="text" class="form-control" id="ville" name="ville" placeholder="Ville" value="<?php echo $ville;?>">
                        <span class="help-inline"><?php echo $villeError;?></span>
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