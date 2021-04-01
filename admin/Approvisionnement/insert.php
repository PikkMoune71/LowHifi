<?php
    //Connexion à la BBD
    require '../database.php';
 
    $dateError = $numprodError = $qteError = $date = $numprod = $qte = "";
    //Si le formulaire n'est pas vide alors:
    if(!empty($_POST)) 
    {
        //Création des variables d'un produit
        $date               = checkInput($_POST['date']);
        $numprod             = checkInput($_POST['numprod']); 
        $qte                 = checkInput($_POST['qte']); 
        $isSuccess          = true;
        $isUploadSuccess    = false;
        
        if(empty($date)) //Si la variable date est vide alors:
        {
            $dateError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        } 
        if(empty($numprod)) //Si la variable numprod est vide alors:
        {
            $numprodError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        }
        if(empty($qte)) //Si la variable qte est vide alors:
        {
            $qteError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        }
        else //Sinon
        {
            $isUploadSuccess = true;
        }
        
        if($isSuccess && $isUploadSuccess) //Si $isSuccess && $isUploadSuccess sont true alors on Insert les données dans la table utilisateur 
        {
            $db = Database::connect();
            $statement = $db->prepare("INSERT INTO approvisionnement (NumAppro,DateAppro,NumProd,QteAch) values(?, ?, ?, ?)");
            $statement->execute(array($num,$date,$numprod,$qte));
            $statement2 = $db->prepare("UPDATE produit set QteProd = QteProd + ? WHERE NumProd = ?");
            $statement2->execute(array($qte,$numprod));
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
                <h1><strong>Ajouter un approvisionnement</strong></h1>
                <br>
                <!-- Formulaire pour insérer un prosuit -->
                <form class="form" action="insert.php" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" class="form-control" id="date" name="date" placeholder="Date" value="<?php echo $date;?>">
                        <span class="help-inline"><?php echo $dateError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="numprod">N° Prod:</label>
                        <select class="form-control" id="numprod" name="numprod">
                        <?php
                           $db = Database::connect();
                           foreach ($db->query('SELECT * FROM produit') as $row) 
                           {
                                echo '<option value="'. $row['NumProd'] .'">'. $row['NomProd'] .'</option>';
                           }
                           Database::disconnect();
                        ?>
                        </select>
                        <span class="help-inline"><?php echo $numprodError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="qte">Quantité:</label>
                        <input type="text" class="form-control" id="qte" name="qte" placeholder="Quantité" value="<?php echo $qte;?>">
                        <span class="help-inline"><?php echo $qteError;?></span>
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