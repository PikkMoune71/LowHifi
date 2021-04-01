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
                        <li><a href="#possibilities">Produits</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <li class="log"><a href="login.php">Connexion</a></li>
                        <li class="log"><a href="signup.php">Inscription</a></li>
                    </ul>
                </nav>
            </div>
        </header>

            <!-- Création du "Container" permettant l'inscription -->
        <div class="wrapper">
                <div class="register">
                    <h3>Enregistre ton Compte LowHifi</h3>
                    <form  method="post">
                    <div class="forms-top">
                        <input class="inscription" type="text" id="nom" name="nom" required placeholder="Votre Nom" >

                        <input class="inscription" type="text" id="prenom" name="prenom" required placeholder="Votre Prénom" >

                        <input class="inscription" type="email" id="email" name="email" minlength="8" required placeholder="Votre Email">
                        <input class="inscription" type="text" id="adresse" name="adresse" required placeholder="Votre adresse" >

                        <input class="inscription" type="text" id="cp" name="cp" required placeholder="Code Postale" >
                        <input class="inscription" type="text" id="ville" name="ville" required placeholder="Ville" >
                        <input class="inscription" type="tel" id="tel" name="tel" required placeholder="N°téléphone" >

                        <input class="inscription" type="password" id="password" name="passwords" minlength="8" required placeholder="Votre mot de passe (8 caractères min)">
                        <input class="inscription" type="password" id="cpassword" name="cpassword" minlength="8" required placeholder="Comfirmer votre mot de passe (8 caractères min)">
                        <br />
                        <div class="check">
                            <input type='checkbox' name='case' class="general-condition" value='on' required> J'ai lu et j'accepte <a href="Charte.pdf">les conditions générales d'utilisation</a>  
                        </div>
                        <input class="button-4" name="submit" id="submit" type="submit" value="Créer votre compte">

                        <p>Vous avez déjà un compte ? <a class="log-account" href="login.php">Se connecter</a></p>
                    </div>
                </form>

                <?php
                // Extraction du formulaire d'inscription avce la méthode $_POST
                if(isset($_POST['submit'])){
                    
                    extract($_POST);
            
                    //Cryptage du mot de passe en hashpass
                    if(!empty($passwords) && !empty($cpassword) && !empty($email)) {
                        if($passwords == $cpassword) {
                            $options = [
                                'cost' => 12,
                            ];
                    
                            $hashpass = password_hash($passwords, PASSWORD_BCRYPT, $options);
                    
                            //BDD
                            include 'database.php';
                            global $db;
                    
                            //Prépartion de la requête 
                            $c = $db->prepare("SELECT MailCli FROM client WHERE MailCli= '$email'");
                            $c->execute(['MailCli' => $email]);
                            $result = $c->rowCount();
                    
                            if($result == 0) {
                                $q = $db->prepare("INSERT INTO client(NomCli, PrenomCli, MailCli, MdpCli, AdrCli, CPCli, VilleCli, TelCli) VALUES('$nom','$prenom','$email','$hashpass','$adresse','$cp','$ville','$tel')");
                                $q->execute([
                                'MailCli' => $email,
                                'MdpCli' => $hashpass
                                ]);
                                echo '<div class="result">';
                                echo '<h4 class="">Compte Créé.</h4>';
                                echo '</div>';
                            } else {
                                echo '<div class="result">';
                                echo '<h4 class="">Email déjà utilisé.</h4>';
                                echo '</div>';
                            }
                        }
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