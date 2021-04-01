<?php 
session_start();
?>
<!DOCTYPE HTML>
<html>
    <head>  
        <meta charset="utf-8">
        <link href="style.css" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Crete+Round" rel="stylesheet">
        <link rel="shortcut icon" href="Images/Logo.png">
        <title>LowHifi</title>
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
                            echo'<li class="log"><a href="Panier.php">Mon Panier</a></li>';             
                            echo'<li class="log"><a href="logout.php">Déconnexion</a></li>';
                        }else{
                            echo'<li class="log"><a href="login.php">Connexion</a></li>';
                            echo'<li class="log"><a href="signup.php">Inscription</a></li>';
                        }
                        ?>
                    </ul>
                </nav>
        </header>
            <section class="filter-container">
                <ul>
                    <li class="list active" data-filter="All">Tous</li>
                    <li class="list" data-filter="TeleviseurLCD">Téléviseur LCD</li>
                    <li class="list" data-filter="TeleviseurPlasma">Téléviseur Plasma</li>
                    <li class="list" data-filter="HifiMini">Hifi Mini</li>
                    <li class="list" data-filter="HifiCompose">Hifi Composée</li>
                    <li class="list" data-filter="Amplificateur">Amplificateur</li>
                    <li class="list" data-filter="LecteurDVD">LecteurDVD</li>
                </ul>
            </section>

            <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <br>
        <!-- ELEMENT DE LA PAGE PRODUIT (différentes catégories) -->
        <div class="itemBox TeleviseurLCD">
            <h3 id="LCD" style="text-align:center">Nos Téléviseurs - LCD<h3>
            <div class="Plasma">
                <?php
                    include 'database.php';
                    global $db;

                    $req1 = $db->query('SELECT * FROM produit WHERE NumCat ="TV0" AND Catalogue = 1');
                    while($donnees = $req1->fetch()){
                        if($donnees['QteProd'] <= $donnees['SeuilReappro'] && $donnees['QteProd'] !=0)
                        {
                            echo'<section id="produit">';
                                echo'<article  style="background: url(Images/'.$donnees['Imgsrc'].') no-repeat center;width:500px; height:300px;">';
                                    echo'<div class="overlay">';
                                        echo'<h4>'.$donnees['NomProd'].'</h4>';
                                        echo'<p><small>Caractéristiques :'.$donnees['Caracteristiques'].'<br> Réf :'.$donnees['NumProd'].' <br>Prix : '.$donnees['PrixProd'].'€</small></p>';
                                        if(isset($_SESSION['MailCli']) and $_SESSION['MdpCli']) //Si la Session pseudo et mdp n'est pas nul alors CONNEXION
                                        {  
                                            ?>
                                            <a class="button-5" target="blank" href="panier.php?action=ajout&amp;id=<?php echo $_SESSION['NumCli'];?>&amp;l=<?php echo$donnees['NomProd'];?>&amp;q=1&amp;p=<?php echo $donnees['PrixProd'];?>">Ajouter Panier</a>
                                            <?php
                                        }else{
                                            ?>
                                            <a class="button-5" href="login.php">Connexion</a>
                                            <?php
                                        }
                                        echo'<p class="seuil"><span style=color:red;>'.$donnees['QteProd'].' produits restants !</span></p>';
                                    echo'</div>';
                                echo'</article>';
                            echo'</section>';
                        }
                        else
                        {
                            if($donnees['QteProd'] !=0)
                            {
                                echo'<section id="produit">';
                                    echo'<article  style="background: url(Images/'.$donnees['Imgsrc'].') no-repeat center;width:500px; height:300px;">';
                                        echo'<div class="overlay">';
                                            echo'<h4>'.$donnees['NomProd'].'</h4>';
                                            echo'<p><small>Caractéristiques :'.$donnees['Caracteristiques'].'<br> Réf :'.$donnees['NumProd'].' <br>Prix : '.$donnees['PrixProd'].'€ </small></p>';
                                            if(isset($_SESSION['MailCli']) and $_SESSION['MdpCli']) //Si la Session pseudo et mdp n'est pas nul alors CONNEXION
                                            {  
                                                ?>
                                                <a class="button-5" target="blank" href="panier.php?action=ajout&amp;id=<?php echo $_SESSION['NumCli'];?>&amp;l=<?php echo$donnees['NomProd'];?>&amp;q=1&amp;p=<?php echo $donnees['PrixProd'];?>">Ajouter Panier</a>
                                                <?php
                                            }else{
                                                ?>
                                                <a class="button-5" href="login.php">Connexion</a>
                                                <?php
                                            }
                                        echo'</div>';
                                    echo'</article>';
                                echo'</section>';
                            }
                            else
                            {
                                echo'<section id="produit">';
                                    echo'<article  style="background: url(Images/rupture-stock.jpg) no-repeat center;width:500px; height:300px;">';
                                        echo'<div class="overlay">';
                                            echo'<h4>'.$donnees['NomProd'].'</h4>';
                                            echo'<p><small>Caractéristiques :'.$donnees['Caracteristiques'].'<br> Réf :'.$donnees['NumProd'].' <br>Prix : '.$donnees['PrixProd'].'€</small></p><br>';
                                            // echo'<p class="seuil"><span style=color:red; font-weight: bold;>Rupture de stocks !</span></p>';
                                        echo'</div>';
                                    echo'</article>';
                                echo'</section>';
                            }
                        }
                    }
                ?>
            </div>
        </div>
        <br>

        <div class="itemBox TeleviseurPlasma">
            <h3 id="Plasma" style="text-align:center">Nos Téléviseurs - Plasma<h3>
            <div class="LCD">
                <?php

                    $req1 = $db->query('SELECT * FROM produit WHERE NumCat ="TV1" AND Catalogue = 1');
                    while($donnees = $req1->fetch()){
                        if($donnees['QteProd'] <= $donnees['SeuilReappro'] && $donnees['QteProd'] !=0)
                        {
                            echo'<section id="produit">';
                                echo'<article  style="background: url(Images/'.$donnees['Imgsrc'].') no-repeat center;width:500px; height:300px;">';
                                    echo'<div class="overlay">';
                                        echo'<h4>'.$donnees['NomProd'].'</h4>';
                                        echo'<p><small>Caractéristiques :'.$donnees['Caracteristiques'].'<br> Réf :'.$donnees['NumProd'].' <br>Prix : '.$donnees['PrixProd'].'€</small></p>';
                                        if(isset($_SESSION['MailCli']) and $_SESSION['MdpCli']) //Si la Session pseudo et mdp n'est pas nul alors CONNEXION
                                        {  
                                            ?>
                                            <a class="button-5" target="blank" href="panier.php?action=ajout&amp;id=<?php echo $_SESSION['NumCli'];?>&amp;l=<?php echo$donnees['NomProd'];?>&amp;q=1&amp;p=<?php echo $donnees['PrixProd'];?>">Ajouter Panier</a>
                                            <?php
                                        }else{
                                            ?>
                                            <a class="button-5" href="login.php">Connexion</a>
                                            <?php
                                        }
                                        echo'<p class="seuil"><span style=color:red;>'.$donnees['QteProd'].' produits restants !</span></p>';
                                    echo'</div>';
                                echo'</article>';
                            echo'</section>';
                        }
                        else
                        {
                            if($donnees['QteProd'] !=0)
                            {
                                echo'<section id="produit">';
                                    echo'<article  style="background: url(Images/'.$donnees['Imgsrc'].') no-repeat center;width:500px; height:300px;">';
                                        echo'<div class="overlay">';
                                            echo'<h4>'.$donnees['NomProd'].'</h4>';
                                            echo'<p><small>Caractéristiques :'.$donnees['Caracteristiques'].'<br> Réf :'.$donnees['NumProd'].' <br>Prix : '.$donnees['PrixProd'].'€ </small></p>';
                                            if(isset($_SESSION['MailCli']) and $_SESSION['MdpCli']) //Si la Session pseudo et mdp n'est pas nul alors CONNEXION
                                            {  
                                                ?>
                                                <a class="button-5" target="blank" href="panier.php?action=ajout&amp;id=<?php echo $_SESSION['NumCli'];?>&amp;l=<?php echo$donnees['NomProd'];?>&amp;q=1&amp;p=<?php echo $donnees['PrixProd'];?>">Ajouter Panier</a>
                                                <?php
                                            }else{
                                                ?>
                                                <a class="button-5" href="login.php">Connexion</a>
                                                <?php
                                            }
                                        echo'</div>';
                                    echo'</article>';
                                echo'</section>';
                            }
                            else
                            {
                                echo'<section id="produit">';
                                    echo'<article  style="background: url(Images/rupture-stock.jpg) no-repeat center;width:500px; height:300px;">';
                                        echo'<div class="overlay">';
                                            echo'<h4>'.$donnees['NomProd'].'</h4>';
                                            echo'<p><small>Caractéristiques :'.$donnees['Caracteristiques'].'<br> Réf :'.$donnees['NumProd'].' <br>Prix : '.$donnees['PrixProd'].'€</small></p>';
                                            // echo'<p class="seuil"><span style=color:red; font-weight: bold;>Rupture de stocks !</span></p>';
                                        echo'</div>';
                                    echo'</article>';
                                echo'</section>';
                            }
                        }
                    }
                ?>
            </div>
        </div>
        <br>
        <div class="itemBox HifiMini">
            <h3 id="Hifi-mini" style="text-align:center">Nos Chaîne Hifi - Mini<h3>
            <div class="Plasma">
                <?php
                    $req1 = $db->query('SELECT * FROM produit WHERE NumCat ="CH0" AND Catalogue = 1');
                    while($donnees = $req1->fetch()){
                        if($donnees['QteProd'] <= $donnees['SeuilReappro'] && $donnees['QteProd'] !=0)
                        {
                            echo'<section id="produit">';
                                echo'<article  style="background: url(Images/'.$donnees['Imgsrc'].') no-repeat center;width:500px; height:300px;">';
                                    echo'<div class="overlay">';
                                        echo'<h4>'.$donnees['NomProd'].'</h4>';
                                        echo'<p><small>Caractéristiques :'.$donnees['Caracteristiques'].'<br> Réf :'.$donnees['NumProd'].' <br>Prix : '.$donnees['PrixProd'].'€</small></p>';
                                        if(isset($_SESSION['MailCli']) and $_SESSION['MdpCli']) //Si la Session pseudo et mdp n'est pas nul alors CONNEXION
                                        {  
                                            ?>
                                            <a class="button-5" target="blank" href="panier.php?action=ajout&amp;id=<?php echo $_SESSION['NumCli'];?>&amp;l=<?php echo$donnees['NomProd'];?>&amp;q=1&amp;p=<?php echo $donnees['PrixProd'];?>">Ajouter Panier</a>
                                            <?php
                                        }else{
                                            ?>
                                            <a class="button-5" href="login.php">Connexion</a>
                                            <?php
                                        }
                                        echo'<p class="seuil"><span style=color:red;>'.$donnees['QteProd'].' produits restants !</span></p>';
                                    echo'</div>';
                                echo'</article>';
                            echo'</section>';
                        }
                        else
                        {
                            if($donnees['QteProd'] !=0)
                            {
                                echo'<section id="produit">';
                                    echo'<article  style="background: url(Images/'.$donnees['Imgsrc'].') no-repeat center;width:500px; height:300px;">';
                                        echo'<div class="overlay">';
                                            echo'<h4>'.$donnees['NomProd'].'</h4>';
                                            echo'<p><small>Caractéristiques :'.$donnees['Caracteristiques'].'<br> Réf :'.$donnees['NumProd'].' <br>Prix : '.$donnees['PrixProd'].'€ </small></p>';
                                            if(isset($_SESSION['MailCli']) and $_SESSION['MdpCli']) //Si la Session pseudo et mdp n'est pas nul alors CONNEXION
                                            {  
                                                ?>
                                                <a class="button-5" target="blank" href="panier.php?action=ajout&amp;id=<?php echo $_SESSION['NumCli'];?>&amp;l=<?php echo$donnees['NomProd'];?>&amp;q=1&amp;p=<?php echo $donnees['PrixProd'];?>">Ajouter Panier</a>
                                                <?php
                                            }else{
                                                ?>
                                                <a class="button-5" href="login.php">Connexion</a>
                                                <?php
                                            }
                                        echo'</div>';
                                    echo'</article>';
                                echo'</section>';
                            }
                            else
                            {
                                echo'<section id="produit">';
                                    echo'<article  style="background: url(Images/rupture-stock.jpg) no-repeat center;width:500px; height:300px;">';
                                        echo'<div class="overlay">';
                                            echo'<h4>'.$donnees['NomProd'].'</h4>';
                                            echo'<p><small>Caractéristiques :'.$donnees['Caracteristiques'].'<br> Réf :'.$donnees['NumProd'].' <br>Prix : '.$donnees['PrixProd'].'€</small></p>';
                                            // echo'<p class="seuil"><span style=color:red; font-weight: bold;>Rupture de stocks !</span></p>';
                                        echo'</div>';
                                    echo'</article>';
                                echo'</section>';
                            }
                        }
                    }
                ?>
            </div>
        </div>
        <br>  
        <div class="itemBox HifiCompose">
            <h3 id="Hifi-compose" style="text-align:center">Nos Chaîne Hifi - Composée<h3>
            <div class="LCD">
                <?php
                    $req1 = $db->query('SELECT * FROM produit WHERE NumCat ="CH1" AND Catalogue = 1');
                    while($donnees = $req1->fetch()){
                        if($donnees['QteProd'] <= $donnees['SeuilReappro'] && $donnees['QteProd'] !=0)
                        {
                            echo'<section id="produit">';
                                echo'<article  style="background: url(Images/'.$donnees['Imgsrc'].') no-repeat center;width:500px; height:300px;">';
                                    echo'<div class="overlay">';
                                        echo'<h4>'.$donnees['NomProd'].'</h4>';
                                        echo'<p><small>Caractéristiques :'.$donnees['Caracteristiques'].'<br> Réf :'.$donnees['NumProd'].' <br>Prix : '.$donnees['PrixProd'].'€</small></p>';
                                        if(isset($_SESSION['MailCli']) and $_SESSION['MdpCli']) //Si la Session pseudo et mdp n'est pas nul alors CONNEXION
                                        {  
                                            ?>
                                            <a class="button-5" target="blank" href="panier.php?action=ajout&amp;id=<?php echo $_SESSION['NumCli'];?>&amp;l=<?php echo$donnees['NomProd'];?>&amp;q=1&amp;p=<?php echo $donnees['PrixProd'];?>">Ajouter Panier</a>
                                            <?php
                                        }else{
                                            ?>
                                            <a class="button-5" href="login.php">Connexion</a>
                                            <?php
                                        }
                                        echo'<p class="seuil"><span style=color:red;>'.$donnees['QteProd'].' produits restants !</span></p>';
                                    echo'</div>';
                                echo'</article>';
                            echo'</section>';
                        }
                        else
                        {
                            if($donnees['QteProd'] !=0)
                            {
                                echo'<section id="produit">';
                                    echo'<article  style="background: url(Images/'.$donnees['Imgsrc'].') no-repeat center;width:500px; height:300px;">';
                                        echo'<div class="overlay">';
                                            echo'<h4>'.$donnees['NomProd'].'</h4>';
                                            echo'<p><small>Caractéristiques :'.$donnees['Caracteristiques'].'<br> Réf :'.$donnees['NumProd'].' <br>Prix : '.$donnees['PrixProd'].'€ </small></p>';
                                            if(isset($_SESSION['MailCli']) and $_SESSION['MdpCli']) //Si la Session pseudo et mdp n'est pas nul alors CONNEXION
                                            {  
                                                ?>
                                                <a class="button-5" target="blank" href="panier.php?action=ajout&amp;id=<?php echo $_SESSION['NumCli'];?>&amp;l=<?php echo$donnees['NomProd'];?>&amp;q=1&amp;p=<?php echo $donnees['PrixProd'];?>">Ajouter Panier</a>
                                                <?php
                                            }else{
                                                ?>
                                                <a class="button-5" href="login.php">Connexion</a>
                                                <?php
                                            }
                                        echo'</div>';
                                    echo'</article>';
                                echo'</section>';
                            }
                            else
                            {
                                echo'<section id="produit">';
                                    echo'<article  style="background: url(Images/rupture-stock.jpg) no-repeat center;width:500px; height:300px;">';
                                        echo'<div class="overlay">';
                                            echo'<h4>'.$donnees['NomProd'].'</h4>';
                                            echo'<p><small>Caractéristiques :'.$donnees['Caracteristiques'].'<br> Réf :'.$donnees['NumProd'].' <br>Prix : '.$donnees['PrixProd'].'€</small></p>';
                                            // echo'<p class="seuil"><span style=color:red; font-weight: bold;>Rupture de stocks !</span></p>';
                                        echo'</div>';
                                    echo'</article>';
                                echo'</section>';
                            }
                        }
                    }
                ?>
            </div> 
        </div>
        <br>
        <div class="itemBox Amplificateur">
            <h3 id="Ampli" style="text-align:center">Ampli Home Cinéma<h3>
            <div class="Plasma">
                <?php
                    $req1 = $db->query('SELECT * FROM produit WHERE NumCat ="AMP0" AND Catalogue = 1');
                    while($donnees = $req1->fetch()){
                        if($donnees['QteProd'] <= $donnees['SeuilReappro'] && $donnees['QteProd'] !=0)
                        {
                            echo'<section id="produit">';
                                echo'<article  style="background: url(Images/'.$donnees['Imgsrc'].') no-repeat center;width:500px; height:300px;">';
                                    echo'<div class="overlay">';
                                        echo'<h4>'.$donnees['NomProd'].'</h4>';
                                        echo'<p><small>Caractéristiques :'.$donnees['Caracteristiques'].'<br> Réf :'.$donnees['NumProd'].' <br>Prix : '.$donnees['PrixProd'].'€</small></p>';
                                        if(isset($_SESSION['MailCli']) and $_SESSION['MdpCli']) //Si la Session pseudo et mdp n'est pas nul alors CONNEXION
                                        {  
                                            ?>
                                            <a class="button-5" target="blank" href="panier.php?action=ajout&amp;id=<?php echo $_SESSION['NumCli'];?>&amp;l=<?php echo$donnees['NomProd'];?>&amp;q=1&amp;p=<?php echo $donnees['PrixProd'];?>">Ajouter Panier</a>
                                            <?php
                                        }else{
                                            ?>
                                            <a class="button-5" href="login.php">Connexion</a>
                                            <?php
                                        }
                                        echo'<p class="seuil"><span style=color:red;>'.$donnees['QteProd'].' produits restants !</span></p>';
                                    echo'</div>';
                                echo'</article>';
                            echo'</section>';
                        }
                        else
                        {
                            if($donnees['QteProd'] !=0)
                            {
                                echo'<section id="produit">';
                                    echo'<article  style="background: url(Images/'.$donnees['Imgsrc'].') no-repeat center;width:500px; height:300px;">';
                                        echo'<div class="overlay">';
                                            echo'<h4>'.$donnees['NomProd'].'</h4>';
                                            echo'<p><small>Caractéristiques :'.$donnees['Caracteristiques'].'<br> Réf :'.$donnees['NumProd'].' <br>Prix : '.$donnees['PrixProd'].'€ </small></p>';
                                            if(isset($_SESSION['MailCli']) and $_SESSION['MdpCli']) //Si la Session pseudo et mdp n'est pas nul alors CONNEXION
                                            {  
                                                ?>
                                                <a class="button-5" target="blank" href="panier.php?action=ajout&amp;id=<?php echo $_SESSION['NumCli'];?>&amp;l=<?php echo$donnees['NomProd'];?>&amp;q=1&amp;p=<?php echo $donnees['PrixProd'];?>">Ajouter Panier</a>
                                                <?php
                                            }else{
                                                ?>
                                                <a class="button-5" href="login.php">Connexion</a>
                                                <?php
                                            }
                                        echo'</div>';
                                    echo'</article>';
                                echo'</section>';
                            }
                            else
                            {
                                echo'<section id="produit">';
                                    echo'<article  style="background: url(Images/rupture-stock.jpg) no-repeat center;width:500px; height:300px;">';
                                        echo'<div class="overlay">';
                                            echo'<h4>'.$donnees['NomProd'].'</h4>';
                                            echo'<p><small>Caractéristiques :'.$donnees['Caracteristiques'].'<br> Réf :'.$donnees['NumProd'].' <br>Prix : '.$donnees['PrixProd'].'€</small></p>';
                                            // echo'<p class="seuil"><span style=color:red; font-weight: bold;>Rupture de stocks !</span></p>';
                                        echo'</div>';
                                    echo'</article>';
                                echo'</section>';
                            }
                        }
                    }
                ?>
            </div>
        </div>
        <br>  
        <div class="itemBox LecteurDVD">
            <h3 id="Dvd" style="text-align:center">Nos Lecteur DVD<h3>
            <div class="LCD">
                <?php

                    $req1 = $db->query('SELECT * FROM produit WHERE NumCat ="DVD0" AND Catalogue = 1');
                    while($donnees = $req1->fetch()){
                        if($donnees['QteProd'] <= $donnees['SeuilReappro'] && $donnees['QteProd'] !=0)
                        {
                            echo'<section id="produit">';
                                echo'<article  style="background: url(Images/'.$donnees['Imgsrc'].') no-repeat center;width:500px; height:300px;">';
                                    echo'<div class="overlay">';
                                        echo'<h4>'.$donnees['NomProd'].'</h4>';
                                        echo'<p><small>Caractéristiques :'.$donnees['Caracteristiques'].'<br> Réf :'.$donnees['NumProd'].' <br>Prix : '.$donnees['PrixProd'].'€</small></p>';
                                        if(isset($_SESSION['MailCli']) and $_SESSION['MdpCli']) //Si la Session pseudo et mdp n'est pas nul alors CONNEXION
                                        {  
                                            ?>
                                            <a class="button-5" target="blank" href="panier.php?action=ajout&amp;id=<?php echo $_SESSION['NumCli'];?>&amp;l=<?php echo$donnees['NomProd'];?>&amp;q=1&amp;p=<?php echo $donnees['PrixProd'];?>">Ajouter Panier</a>
                                            <?php
                                        }else{
                                            ?>
                                            <a class="button-5" href="login.php">Connexion</a>
                                            <?php
                                        }
                                        echo'<p class="seuil"><span style=color:red;>'.$donnees['QteProd'].' produits restants !</span></p>';
                                    echo'</div>';
                                echo'</article>';
                            echo'</section>';
                        }
                        else
                        {
                            if($donnees['QteProd'] !=0)
                            {
                                echo'<section id="produit">';
                                    echo'<article  style="background: url(Images/'.$donnees['Imgsrc'].') no-repeat center;width:500px; height:300px;">';
                                        echo'<div class="overlay">';
                                            echo'<h4>'.$donnees['NomProd'].'</h4>';
                                            echo'<p><small>Caractéristiques :'.$donnees['Caracteristiques'].'<br> Réf :'.$donnees['NumProd'].' <br>Prix : '.$donnees['PrixProd'].'€ </small></p>';
                                            if(isset($_SESSION['MailCli']) and $_SESSION['MdpCli']) //Si la Session pseudo et mdp n'est pas nul alors CONNEXION
                                            {  
                                                ?>
                                                <a class="button-5" target="blank" href="panier.php?action=ajout&amp;id=<?php echo $_SESSION['NumCli'];?>&amp;l=<?php echo$donnees['NomProd'];?>&amp;q=1&amp;p=<?php echo $donnees['PrixProd'];?>">Ajouter Panier</a>
                                                <?php
                                            }else{
                                                ?>
                                                <a class="button-5" href="login.php">Connexion</a>
                                                <?php
                                            }
                                        echo'</div>';
                                    echo'</article>';
                                echo'</section>';
                            }
                            else
                            {
                                echo'<section id="produit">';
                                    echo'<article  style="background: url(Images/rupture-stock.jpg) no-repeat center;width:500px; height:300px;">';
                                        echo'<div class="overlay">';
                                            echo'<h4>'.$donnees['NomProd'].'</h4>';
                                            echo'<p><small>Caractéristiques :'.$donnees['Caracteristiques'].'<br> Réf :'.$donnees['NumProd'].' <br>Prix : '.$donnees['PrixProd'].'€</small></p>';
                                            // echo'<p class="seuil"><span style=color:red; font-weight: bold;>Rupture de stocks !</span></p>';
                                        echo'</div>';
                                    echo'</article>';
                                echo'</section>';
                            }
                        }
                    }
                ?>
            </div> 
        </div>
        <!-- BOUTON QUI SCROLL -->
            <div id="scrollUp">
                <a href="#top"><img src="Images/top.png" height="40" width="40" ><br><p>Haut de page<p></a>
            </div>
        </div>
        
        <!-- SCRIPT POUR LE FILTRE -->
        <script type="text/javascript">
            $(document).ready(function() {
                $('.list').click(function() {
                    const value = $(this).attr('data-filter');
                    if (value == 'All') {
                        $('.itemBox').show('1000');
                    } else {
                        $('.itemBox').not('.' +value).hide('1000');
                        $('.itemBox').filter('.' +value).show('1000');
                    }
                })
                $('.list').click(function(){
                    $(this).addClass('active').siblings().removeClass('active')
                })
            })
        </script>

        <footer>
           <div class="wrapper">
               <h1>LowHifi<span class="orange">.</span></h1>
               <div class="copyright">Copyright &copy 2020. Tous les droits sont réservés.</div>
           </div> 
        </footer>
    </body>
</html>