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
                        <li><a href="Index.php">Accueil</a></li>
                        <li><a href="produit.php">Produits</a></li>
                        <li><a href="Index.php#contact">Contact</a></li>
                        <li class="log"><a href="login.php">Connexion</a></li>
                        <li class="log"><a href="signup.php">Inscription</a></li>
                    </ul>
                </nav>
            </div>
        </header>


            <!-- Création du "Container" permettant la connexxion -->
            <div class="login">
                <div class="connexion-login">
                    <h3>Bon retour sur LowHifi !</h3>
                    <form method="POST">
                            <input class="connexion" type="email" name="lmail" placeholder="Votre Email" autocomplete="off" required/>
                            <input class="connexion" type="password" name="lpassword" minlength="8" autocomplete="off" placeholder="Votre mot de passe" required/>
                        <input class="button-4" type="submit" value="Connexion" name="formlogin" id="formlogin">
                    </form>
                    <p>Vous n'avez pas de compte ? <a class="create-account" href="signup.php">Créer un compte</a></p>
                    <?php
                    if(isset($_POST['formlogin'])) {
                        extract($_POST);

                        include 'database.php';
                        global $db;

                        if(!empty($lmail) && !empty($lpassword)) {
                            $q = $db->prepare("SELECT * FROM client WHERE MailCli = '$lmail'");
                            $q->execute(['MailCli' => $lmail]);
                            $result = $q->fetch();

                            
                            if($result == true) {                                
                                //Le compte existe bien 
                                $hashpassword = $result['MdpCli'];
                            
                                if(password_verify($lpassword, $result['MdpCli'])) {
                                    session_start();
                                    $_SESSION['MailCli'] = $result['MailCli'];
                                    $_SESSION['MdpCli'] = $result['MdpCli'];
                                    $_SESSION['NumCli'] = $result['NumCli'];
                                    

                                    header('Location:Index.php?id='.$_SESSION['NumCli']);
                                    exit();
                                } else {
                                    echo '<h4>Mot de passe Inccorect.</h4>';
                                }
                            } else {
                                echo '<h4>' .$lmail. ' n\'existe pas.</h4>';
                            }
                        } else {
                            echo '<h4>Champs Incomplets</h4>';
                        }
                    }
                    ?>
                </div>
            </div>
            <footer>
           <div class="wrapper">
               <h1>LowHifi<span class="orange">.</span></h1>
               <div class="copyright">Copyright &copy 2020. Tous les droits sont réservés.</div>
           </div> 
        </footer>
    </body>
</html>