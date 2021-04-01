<?php 
session_start();
?>
<!DOCTYPE html>
<html>
    <head>  
        <meta charset="utf-8">
        <link href="style.css" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Crete+Round" rel="stylesheet">
        <link rel="shortcut icon" href="Images/Logo.png">
        <title>Récapitulatif</title>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
        <script>
            jQuery(function(){
                $(function () {
                    $(window).scroll(function () { //Fonction appelée quand on descend la page
                        if ($(this).scrollTop() > 200 ) {  // Quand on est à 200pixels du haut de page,
                            $('#scrollUp').css('right','20px'); // Replace à 10pixels de la droite l'image
                        } else { 
                            $('#scrollUp').removeAttr( 'style' ); // Enlève les attributs CSS affectés par javascript
                        }
                    });
                });
            });
        </script>
    </head>
<body>
    <header>
        <div class="wrapper">
            <h1>LowHifi<span class="orange">.</span></h1>
            <nav>
                <ul>
                    <li><a href="Index.php">Accueil</a></li>
                    <li><a href="produit.php">Produits</a></li>
                    <li><a href="Index.php#contact">Contact</a></li>
                    <?php
                    if(isset($_SESSION['MailCli']) and $_SESSION['MdpCli']) //Si la Session pseudo et mdp n'est pas nul alors CONNEXION
                    {  
                        echo'<li class="log"><a href="Panier.php?id='.$_SESSION['NumCli'].'">Mon Panier</a></li>';             
                        echo'<li class="log"><a href="logout.php">Déconnexion</a></li>';
                    }else{
                        echo'<li class="log"><a href="login.php">Connexion</a></li>';
                        echo'<li class="log"><a href="signup.php">Inscription</a></li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </header>
    <div class="center">
        <h1 style="text-align: center; margin: 40px 0">Votre commande a été effectuée.</h1>
        <?php
            include 'database.php';
            global $db;
                
            $Com = $db->query('SELECT MAX(NumCom) AS Com FROM commande'); // Récupère la dernière commande
            while($donnees = $Com->fetch())
            {
                $NumCom = $donnees['Com'];
            }
        ?>
        <a href="facture.php?id=<?php echo $NumCom; ?>" class="button-facture">Voir Facture</a>
    </div>
    
</body>
</html>