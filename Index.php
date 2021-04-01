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
    </head>
    <body>
        <header>
            <div class="wrapper">
                <h1>LowHifi<span class="orange">.</span></h1>
                <nav>
                    <ul>
                        <li><a href="#main-image">Accueil</a></li>
                        <li><a href="produit.php">Produits</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <?php
                        if(isset($_SESSION['MailCli']) and $_SESSION['MdpCli']) //Si la Session pseudo et mdp n'est pas nul alors CONNEXION
                        {   
                            echo'<li class="log"><a href="Panier.php">Mon Panier</a></li>';            
                            echo'<li class="log"><a href="logout.php">Déconnexion</a></li>';
                            echo'<li class="deroulant"><a class="deroulant" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                    </svg></a>
                                    <ul class="sous">
                                        <li><a href="profil.php?id='.$_SESSION['NumCli'].'">Mon profil</a></li>
                                        <li><a href="mescommandes.php">Mes commandes</a></li>
                                        <li><a href="admin/index.php">Administration</a></li>
                                    </ul>
                            </li>';
                        }else{
                            echo'<li class="log"><a href="login.php">Connexion</a></li>';
                            echo'<li class="log"><a href="signup.php">Inscription</a></li>';
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </header>

        <section id="main-image">
            <div class="wrapper">
                <h2>Découvrez votre<br><strong>produit sur mesure</strong></h2>
                <a href="produit.php" class="button-1">Par ici</a>
            </div>
        </section>
        
        <section id="steps">
            <div class="wrapper">
                <ul>
                    <li id="step-1">
                        <h4>Planifier</h4>
                        <p>Confiez-nous vos envies : en famille ou entre amis, nous trouverons la formule qui comblera vos attentes.</p>
                    </li>
                    <li id="step-2">
                        <h4>Organiser</h4>
                        <p>Bénéficiez de l'expertise de nos spécialistes de chaque produit, ils vous accompagneront dans la réalisation de votre projet.</p>
                    </li>
                    <li id="step-3">
                        <h4>Consommer</h4>
                        <p>A vous de profiter à fond de votre produit high tech.</p>
                    </li>
                    <div class="clear"></div>
                </ul>
            </div>
        </section>
        <section id="possibilities">
            <div class="wrapper">
                <?php
                    include 'database.php';
                    $req = $db->query('SELECT * FROM produit ORDER BY RAND() LIMIT 2');
                    while($donnees = $req->fetch()) {
                            echo'<article  style="background: url(Images/'.$donnees['Imgsrc'].') no-repeat center;width:450px; height:300px;">';
                                echo'<div class="overlay">';
                                    echo '<h4>'.$donnees['NomProd'].'</h4>';
                                    echo'<p><small>'.$donnees['Caracteristiques'].'</small></p>';
                                    echo'<a class="button-2" href="produit.php">Plus d\'infos</a>';
                                echo'</div>';                       
                            echo'</article>';
                    }
                ?>
                <div class="clear"></div>
             </div>
        </section>

        <section id="contact">
            <div class="wrapper">
                <h3>Contactez-nous</h3>
                <p>Chez LowHifi nous savons que le choix de votre produit est souvent hésitant. C'est pourquoi nous mettons un point d'honneur à prendre en compte chacune de vos attentes pour vous aider dans le choix de produit idéal.</p>
                <form method="post">
                    <label>Nom</label>
                    <input type="text" name="nom" required placeholder="Votre nom">
                    <label>Email</label>
                    <input type="email" name="email" required placeholder="Votre email"><br><br>
                    <!-- <label>Message</label> -->
                    <!-- <textarea name="message" required></textarea> -->
                    <input class="button-3" type="submit">
                </form>
                <?php
                if(isset($_POST['message'])){
                    $entete  = 'MIME-Version: 1.0' . "\r\n";
                    $entete .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                    $entete .= 'From: ' . $_POST['email'] . "\r\n";

                    $message = '<h1>Message envoyé depuis la page Contact de monsite.fr</h1>
                    <p><b>Nom : </b>' . $_POST['nom'] . '<br>
                    <b>Email : </b>' . $_POST['email'] . '<br>
                    <b>Message : </b>' . $_POST['message'] . '</p>';

                    $retour = mail('lowhifid5@gmail.com', 'Envoi depuis page Contact', $message, $entete);
                    if($retour) {
                        echo '<p>Votre message a bien été envoyé.</p>';
                    }
                }
                ?>
            </div>
        </section>

        <footer>
           <div class="wrapper">
               <h1>LowHifi<span class="orange">.</span></h1>
               <div class="copyright">Copyright &copy 2020. Tous les droits sont réservés.</div>
           </div> 
        </footer>
        <script type="text/javascript" src="script.js"></script>
    </body>
</html>