<?php 
session_start();
?>
<!DOCTYPE HTML>
<html>
    <head>  
    <meta charset="utf-8">
        <link rel="shortcut icon" href="Images/Logo.png">
        <script src="js/diashow.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link href="http://fonts.googleapis.com/css?family=Crete+Round" rel="stylesheet">
        <link rel="stylesheet" href="style.css" />
        <title>LowHifi</title>
    </head>
    <body>
        <header>
            <div class="wrapper">
                <h1>LowHifi<span class="orange">.</span></h1>
                <nav>
                    <ul>
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="produit.php">Produits</a></li>
                        <li><a href="index.php#contact">Contact</a></li>
                        <?php
                        if(isset($_SESSION['MailCli']) and $_SESSION['MdpCli']) //Si la Session pseudo et mdp n'est pas nul alors CONNEXION
                        {   
                            echo'<li class="log"><a href="Panier.php">Mon Panier</a></li>';            
                            echo'<li class="log"><a href="logout.php">Déconnexion</a></li>';
                            echo'<li class="deroulant"><a class="deroulant" href=""><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                    </svg></a>
                                    <ul class="sous">
                                        <li><a href="#">Mon profil</a></li>
                                        <li><a href="mescommandes.php?id='.$_SESSION['NumCli'].'">Mes commandes</a></li>';
                                        if(isset($_SESSION['MailCli']) and $_SESSION['MdpCli'] and $_SESSION['NumCli'] == 2) //Si la Session pseudo et mdp n'est pas nul alors CONNEXION
                                        {  
                                            echo'<li><a href="admin/index.php">Administration</a></li>';
                                        }    
                                    echo'</ul>';
                            echo'</li>';
                        }else{
                            echo'<li class="log"><a href="login.php">Connexion</a></li>';
                            echo'<li class="log"><a href="signup.php">Inscription</a></li>';
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </header>
        <?php
            // Connexion à la base de données et utilisation des produits qui sont dans la base de données
            require 'database.php';
            global $db
        ?>
        <div class="wrapper" align="center">
        </div>
        
        <div class="container admin" align="center">
            <div class="row">
                <h1><strong>Mes commandes </strong></h1>
            </div>
            <!-- Tableau Affiche tout les produits -->
            <table class="table table-stripped table-bordered">
                <thead>
                    <tr>
                        <th>N°Commande</th>
                        <th>Actions</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $statement = $db->query("SELECT distinct c.NumCom FROM composer c INNER JOIN commande co ON c.NumCom = co.NumCom WHERE co.NumCli = ".$_SESSION['NumCli']."");
                    while($composer = $statement->fetch()) 
                    {
                        echo '<tr>';
                        echo '<td>'. $composer['NumCom'] . '</td>';
                        echo '<td width=300>';
                        echo '<a class="btn btn-primary" href="facture.php?id='.$composer['NumCom'].'"><span class="glyphicon glyphicon-eye-open"></span> Voir Facture</a>';
                        echo ' ';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
    </body>