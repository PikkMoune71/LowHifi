<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
        <link rel="shortcut icon" href="Images/Logo.png">
        <script src="js/diashow.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link href="http://fonts.googleapis.com/css?family=Crete+Round" rel="stylesheet">
        <link rel="stylesheet" href="../style.css" />
    <title>Statistiques - LowHifi</title>
</head>
<body>
    <div class="container admin" align="center">
        <section>
            <form class="form" action="statistiques.php" role="form" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="month" class="form-control" id="date" name="date" placeholder="Date">
                </div>
                <div class="form-actions">
                    <input type="submit" class="btn btn-success" name="subdate" id="subdate">
                    <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                </div>
            </form>
        </section>
        <div class="row">
            <h1><strong>CA par mois</strong></h1>
        </div>
        <br>
        <!-- Tableau Affiche le ca par mois-->
        <table class="table table-stripped table-bordered">
            <thead>
                <tr>
                    <th>Mois</th>
                    <th>Chiffre d'affaire</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../database.php';
                global $db;

                if(isset($_POST['date']))
                    {
                        extract($_POST);
                        $date = date_parse($_POST['date']); 
                        $mois = $date['month'];
                        $annee = $date['year'];

                        $statement = $db->query("SELECT MONTH(DateCom) AS Mois, SUM(QteCom*PrixProd) AS CATotalMois
                        FROM commande c inner join composer cp on c.NumCom = cp.NumCom 
                        left join produit p on p.NumProd = cp.NumProd 
                        WHERE c.NumCom = cp.NumCom AND MONTH(DateCom) = '$mois' AND YEAR(DateCom) = '$annee' 
                        GROUP BY Mois"); //Fais le cumul du temps de travail par mois
                        while($TravailM = $statement->fetch())
                        {
                            echo '<tr>';
                            if($TravailM['Mois'] == 1) {$NomMois = 'Janvier';}
                            if($TravailM['Mois'] == 2) {$NomMois = 'Février';}
                            if($TravailM['Mois'] == 3) {$NomMois = 'Mars';}
                            if($TravailM['Mois'] == 4) {$NomMois = 'Avril';}
                            if($TravailM['Mois'] == 5) {$NomMois = 'Mai';}
                            if($TravailM['Mois'] == 6) {$NomMois = 'Juin';}
                            if($TravailM['Mois'] == 7) {$NomMois = 'Juillet';}
                            if($TravailM['Mois'] == 8) {$NomMois = 'Août';}
                            if($TravailM['Mois'] == 9) {$NomMois = 'Septembre';}
                            if($TravailM['Mois'] == 10) {$NomMois = 'Octobre';}
                            if($TravailM['Mois'] == 11) {$NomMois = 'Novembre';}
                            if($TravailM['Mois'] == 12) {$NomMois = 'Décembre';}
                            echo '<td>'. $NomMois . '</td>';
                            if($TravailM['CATotalMois'] != null)
                            {
                                echo '<td>'. $TravailM['CATotalMois'] . ' €' .'</td>';
                            } else {
                                echo '<td>Il n\'y a pas eu de commande lors de ce mois.</td>';
                            }
                            echo '</tr>';
                        }
                    }
                ?>
                
            </tbody>
        </table>
        <section>
            <form class="form" action="statistiques.php" role="form" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="categorie">Catégorie :</label>
                    <select class="form-control" id="categorie" name="categorie">
                    <?php
                        foreach ($db->query('SELECT * FROM categorie') as $row) //Sélectionne tous les roles
                        {
                            echo '<option selected="selected" value="'.$row['NumCat'].'">'.$row['LibCat'].'</option>';
                        }
                    ?>
                    </select>
                </div>
                <div class="form-actions">
                    <input type="submit" class="btn btn-success" name="subcat" id="subcat">
                    <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                </div>
            </form>
        </section>
        <div class="row">
            <h1><strong>CA par catégorie</strong></h1>
        </div>
        <br>
        <!-- Tableau Affiche le ca par mois-->
        <table class="table table-stripped table-bordered">
            <thead>
                <tr>
                    <th>Catégorie</th>
                    <th>Chiffre d'affaire</th>
                </tr>
            </thead>
            <tbody>
                <?php
                global $db;

                if(isset($_POST['categorie']))
                    {
                        extract($_POST);

                        $categorie = $_POST['categorie'];

                        $statement = $db->query("SELECT LibCat, SUM(QteCom*PrixProd) AS CATotalCat
                        FROM commande c inner join composer cp on c.NumCom = cp.NumCom 
                        inner join produit p on p.NumProd = cp.NumProd 
                        inner join categorie cat on cat.NumCat = p.NumCat
                        WHERE c.NumCom = cp.NumCom AND p.NumCat = '$categorie'
                        GROUP BY LibCat"); //Fais le cumul du temps de travail par mois
                        while($cat = $statement->fetch())
                        {
                            echo '<tr>';
                            echo '<td>'. $cat['LibCat'] . '</td>';
                            echo '<td>'. $cat['CATotalCat'] . ' €' .'</td>';
                            echo '</tr>';
                        }
                    }
                ?>
            </tbody>
        </table>
        <div class="row">
            <h1><strong>Commande la plus élevée</strong></h1>
        </div>
        <br>
        <!-- Tableau Affiche le ca par mois-->
        <table class="table table-stripped table-bordered">
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Coût</th>
                </tr>
            </thead>
            <tbody>
                <?php
                global $db;

                $statement = $db->query("SELECT NomCli, PrenomCli, MAX(QteCom*PrixProd) AS MAXCom
                FROM client cl inner join commande c on cl.NumCli = c.NumCli 
                inner join composer cp on c.NumCom = cp.NumCom 
                inner join produit p on p.NumProd = cp.NumProd 
                inner join categorie cat on cat.NumCat = p.NumCat
                WHERE c.NumCom = cp.NumCom
                GROUP BY NomCli, PrenomCli"); //Fais le cumul du temps de travail par mois
                while($max = $statement->fetch())
                {
                    echo '<tr>';
                    echo '<td>'. $max['NomCli'] . ' ' . $max['PrenomCli'] .'</td>';
                    echo '<td>'. $max['MAXCom'] . ' €' .'</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>