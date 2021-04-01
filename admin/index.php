<!DOCTYPE html>
<html lang="fr">
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
        <title>LowHifi - Admin</title>
    </head>
    <body>
        <?php
            // Connexion à la base de données et utilisation des produits qui sont dans la base de données
            require 'database.php';
            $db = Database::connect();
        ?>
        <div class="wrapper" align="center">
            <h1><strong>LowHifi<span class="orange">.</span></strong></h1>
            <a class="btn btn-danger" href="../"><span class="glyphicon glyphicon-off"></span> Quitter</a>
            <a class="btn btn-warning" href="statistiques.php"><span class="glyphicon glyphicon-list-alt"></span> Statistiques</a>
        </div>
        <br>
        <div class="container admin" align="center">
            <div class="row">
                <h1><strong>Liste des produits </strong><a href="Produit/insert.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter</a></h1>
            </div>
            <!-- Tableau Affiche tout les produits -->
            <table class="table table-stripped table-bordered">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>QteProd</th>
                        <th>SeuilReappro</th>
                        <th>Caracteristiques</th>
                        <th>Couleur</th>
                        <th>Largeur</th>
                        <th>Longueur</th>
                        <th>Profondeur</th>
                        <th>Poids</th>
                        <th>NumCat</th>
                        <th>NumFour</th>
                        <th>Imgsrc</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $statement = $db->query('SELECT * FROM produit ORDER BY produit.NumProd DESC');
                    while($produit = $statement->fetch()) 
                    {
                        echo '<tr>';
                        echo '<td>'. $produit['NumProd'] . '</td>';
                        echo '<td>'. $produit['NomProd'] . '</td>';
                        echo '<td>'. $produit['PrixProd'] . '€</td>';
                        echo '<td>'. $produit['QteProd'] . '</td>';
                        echo '<td>'. $produit['SeuilReappro'] . '</td>';
                        echo '<td>'. $produit['Caracteristiques'] . '</td>';
                        echo '<td>'. $produit['Couleur'] . '</td>';
                        echo '<td>'. $produit['Largeur'] . '</td>';
                        echo '<td>'. $produit['Longueur'] . '</td>';
                        echo '<td>'. $produit['Profondeur'] . '</td>';
                        echo '<td>'. $produit['Poids'] . '</td>';
                        echo '<td>'. $produit['NumCat'] . '</td>';
                        echo '<td>'. $produit['NumFour'] . '</td>';
                        echo '<td>'. $produit['Imgsrc'] . '</td>';
                        echo '<td width=3s00>';
                        echo '<a class="btn btn-default" style="margin-bottom: 4px;" href="Produit/view.php?id='.$produit['NumProd'].'"><span class="glyphicon glyphicon-eye-open"></span> Voir</a>';
                        echo '<br>';
                        echo '<a class="btn btn-primary" style="margin-bottom: 4px;" href="Produit/update.php?id='.$produit['NumProd'].'"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>';
                        echo '<br>';
                        echo '<a class="btn btn-danger" style="margin-bottom: 4px;" href="Produit/delete.php?id='.$produit['NumProd'].'"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>';
                        if($produit['Catalogue'] == 1)
                        {
                            echo ' ';
                            echo '<a class="btn btn-warning" href="Produit/supprimercatalogue.php?id='.$produit['NumProd'].'"><span class="glyphicon glyphicon-list-alt"></span> Enlever du catalogue</a>';
                        }
                        else
                        {
                            echo ' ';
                            echo '<a class="btn btn-success" href="Produit/affichercatalogue.php?id='.$produit['NumProd'].'"><span class="glyphicon glyphicon-list-alt"></span> Ajouter au catalogue</a>';
                        }
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
            <br>
            <div class="row">
                <h1><strong>Liste des clients </strong><a href="Client/insertuti.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter</a></h1>
            </div>
            <!-- Tableau Affiche tout les produits -->
            <table class="table table-stripped table-bordered">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Mail</th>
                        <th>Mdp</th>
                        <th>Adresse</th>
                        <th>CP</th>
                        <th>Ville</th>
                        <th>Tel</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $statement = $db->query('SELECT * FROM client ORDER BY client.NumCli DESC');
                    while($utilisateur = $statement->fetch()) 
                    {
                        echo '<tr>';
                        echo '<td>'. $utilisateur['NumCli'] . '</td>';
                        echo '<td>'. $utilisateur['NomCli'] . '</td>';
                        echo '<td>'. $utilisateur['PrenomCli'] . '</td>';
                        echo '<td>'. $utilisateur['MailCli'] . '</td>';
                        echo '<td>'. $utilisateur['MdpCli'] . '</td>';
                        echo '<td>'. $utilisateur['AdrCli'] . '</td>';
                        echo '<td>'. $utilisateur['CPCLi'] . '</td>';
                        echo '<td>'. $utilisateur['VilleCli'] . '</td>';
                        echo '<td>'. $utilisateur['TelCli'] . '</td>';
                        echo '<td width=300>';
                        echo '<a class="btn btn-primary" href="Client/update.php?id='.$utilisateur['NumCli'].'"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>';
                        echo ' ';
                        echo '<a class="btn btn-danger" href="Client/delete.php?id='.$utilisateur['NumCli'].'"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
            <br>
            <div class="row">
                <h1><strong>Liste des fournisseurs </strong><a href="Fournisseur/insert.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter</a></h1>
            </div>
            <!-- Tableau Affiche tout les produits -->
            <table class="table table-stripped table-bordered">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nom</th>
                        <th>Adresse</th>
                        <th>CP</th>
                        <th>Ville</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $statement = $db->query('SELECT * FROM fournisseur ORDER BY NumFour');
                        while($fournisseur = $statement->fetch()) 
                        {
                            echo '<tr>';
                            echo '<td>'. $fournisseur['NumFour'] . '</td>';
                            echo '<td>'. $fournisseur['NomFour'] . '</td>';
                            echo '<td>'. $fournisseur['AdrFour'] . '</td>';
                            echo '<td>'. $fournisseur['CPFour'] . '</td>';
                            echo '<td>'. $fournisseur['VilleFour'] . '</td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
            <br>
            <div class="row">
                <h1><strong>Liste des approvisionnements </strong><a href="Approvisionnement/insert.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter</a></h1>
            </div>
            <!-- Tableau Affiche tout les approvisionnements -->
            <table class="table table-stripped table-bordered">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Date</th>
                        <th>Produit</th>
                        <th>Quantité</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $statement = $db->query('SELECT * FROM approvisionnement ORDER BY DateAppro');
                        while($approvisionnement = $statement->fetch()) 
                        {
                            echo '<tr>';
                            echo '<td>'. $approvisionnement['NumAppro'] . '</td>';
                            echo '<td>'. $approvisionnement['DateAppro'] . '</td>';
                            echo '<td>'. $approvisionnement['NumProd'] . '</td>';
                            echo '<td>'. $approvisionnement['QteAch'] . '</td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
            <br>
            <div class="row">
                <h1><strong>Liste des commandes non réglées </strong></h1>
            </div>
            <!-- Tableau Affiche toutes les commandes -->
            <table class="table table-stripped table-bordered">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Client</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $statement = $db->query('SELECT * FROM commande c INNER JOIN client cli ON c.NumCli = cli.NumCli WHERE Statut = "Non reglee" ORDER BY NumCom');
                        while($commande = $statement->fetch()) 
                        {
                            // mysql_query("SET NAME 'utf-8'");
                            echo '<tr>';
                            echo '<td>'. $commande['NumCom'] . '</td>';
                            echo '<td>'. $commande['NomCli'] . ' ' . $commande['PrenomCli'] . '</td>';
                            echo '<td>'. $commande['Statut'] . '</td>';
                            echo '<td width=300>';
                            echo '<a class="btn btn-warning" href="Commande/accepterpaiement.php?id='.$commande['NumCom'].'"><span class="glyphicon glyphicon-shopping-cart"></span> À Payer</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
        Database::disconnect();
        ?>
    </body>
</html>