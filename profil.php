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
        <!-- #endregion -->

        <!-- #region Profil -->
            <?php
                include('database.php');
                global $db;
                // Récupére l'id utilisateur dans l'url
                if(isset($_GET['id']) AND $_GET['id'] > 0)
                {
                    $getid = intval($_GET['id']);
                    $requser = $db->prepare('SELECT * FROM client WHERE NumCli = ?'); //Requête
                    $requser->execute(array($getid)); //Execution de la requête
                    $userinfo = $requser->fetch();
                
            ?>
                <div class="main-image">
                    <?php
                        echo '<h1 class="profil">Voici ton Profil '.$userinfo['PrenomCli'].'</h1>';
                    ?>
                    <p style="text-align:center;">Tu peux modifier les données de ton profil si tu le souhaite !</p>
                    <br/><br/>
                    <div class="btn">
                        <button class="profil" href="modifprofil.php">Modifier mon Profil</button>
                    </div>
                    <div class="profil">
                    <ul>
                        <li class="profil"><?php echo '<label>Mon Adresse Mail :</label><h2 class="profil">'.$userinfo['MailCli'].'</h2>'; ?></li>
                        <li class="profil"><?php echo '<label>Mon Nom :</label><h2 class="profil">'.$userinfo['NomCli'].'</h2>'; ?></li>
                        <li class="profil"><?php echo '<label>Mon Prénom :</label><h2 class="profil">'.$userinfo['PrenomCli'].'</h2>'; ?></li>
                        <li class="profil"><?php echo '<label>Adresse :</label><h2 class="profil">'.$userinfo['AdrCli'].'</h2>'; ?></li>
                        <li class="profil"><?php echo '<label>Code Postale :</label><h2 class="profil">'.$userinfo['CPCLi'].'</h2>'; ?></li>
                        <li class="profil"><?php echo '<label>Ville :</label><h2 class="profil">'.$userinfo['VilleCli'].'</h2>'; ?></li>
                        <li class="profil"><?php echo '<label>N°Tel :</label><h2 class="profil">'.$userinfo['TelCli'].'</h2>'; ?></li>
                    </ul>
                </div>
                </div>
                <br />

            <?php
                }
            ?>
        <!-- #endregion -->
        <footer>
           <div class="wrapper">
               <h1>LowHifi<span class="orange">.</span></h1>
               <div class="copyright">Copyright &copy 2021. Tous les droits sont réservés.</div>
           </div> 
    </body>
</html>