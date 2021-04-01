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
                            echo'<li class="log"><a href="Panier.php?id='.$_SESSION['NumCli'].'">Mon Panier</a></li>';             
                            echo'<li class="log"><a href="logout.php">Déconnexion</a></li>';
                        }else{
                            echo'<li class="log"><a href="login.php">Connexion</a></li>';
                            echo'<li class="log"><a href="signup.php">Inscription</a></li>';
                        }
                        ?>
                    </ul>
                </nav>
        </header>
        <?php
        include_once("fonctions-panier.php");

        $erreur = false;

        $action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;
        if($action !== null)
        {
        if(!in_array($action,array('ajout', 'suppression', 'refresh')))
        $erreur=true;

        //récupération des variables en POST ou GET
        $l = (isset($_POST['l'])? $_POST['l']:  (isset($_GET['l'])? $_GET['l']:null )) ;
        $p = (isset($_POST['p'])? $_POST['p']:  (isset($_GET['p'])? $_GET['p']:null )) ;
        $q = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;

        //Suppression des espaces verticaux
        $l = preg_replace('#\v#', '',$l);
        //On vérifie que $p est un float
        $p = floatval($p);

        //On traite $q qui peut être un entier simple ou un tableau d'entiers
            
        if (is_array($q)){
            $QteArticle = array();
            $i=0;
            foreach ($q as $contenu){
                $QteArticle[$i++] = intval($contenu);
            }
        }
        else
        $q = intval($q);
            
        }

        if (!$erreur){
        switch($action){
            Case "ajout":
                ajouterArticle($l,$q,$p);
                break;

            Case "suppression":
                supprimerArticle($l);
                break;

            Case "refresh" :
                for ($i = 0 ; $i < count($QteArticle) ; $i++)
                {
                    modifierQTeArticle($_SESSION['panier']['libelleProduit'][$i],round($QteArticle[$i]));
                }
                break;

            Default:
                break;
        }
        }

        echo '<?xml version="1.0" encoding="utf-8"?>';?>
        
        <form method="post" action="Panier.php?id=<?php echo $_SESSION['NumCli']?>">
        <table class="panier" style="width: 800px; margin:auto;">
            <tr>
                <h3 class="titrepanier" colspan="4">Votre panier</h3>
            </tr>
            <br>
            <br>
            <?php
            if (creationPanier())
            {
                compterArticles();
            if (compterArticles() <= 0){
                echo "<h3 class='vide'>Votre panier est vide !</h3>";
            }
            else
            {
                ?>
                <tr class="nav">
                    <td>Libellé</td>
                    <td>Quantité</td>
                    <td>Prix Unitaire</td>
                    <td>Action</td>
                </tr>
                <?php
                for ($i=0 ;$i < compterArticles() ; $i++)
                {
                    echo "<tr class='Panier'>";
                    echo "<td>".htmlspecialchars($_SESSION['panier']['libelleProduit'][$i])."</ td>";
                    echo "<td><input type=\"text\" size=\"4\" name=\"q[]\" value=\"".htmlspecialchars($_SESSION['panier']['qteProduit'][$i])."\"/></td>";
                    echo "<td>".htmlspecialchars($_SESSION['panier']['prixProduit'][$i])."€</td>";
                    echo "<td><a href=\"".htmlspecialchars("panier.php?action=suppression&l=".rawurlencode($_SESSION['panier']['libelleProduit'][$i]))."\">Supprimer</a></td>";
                    echo "</tr>";
                }

                echo "<tr><td colspan=\"2\"> </td>";
                echo "<td colspan=\"2\">";
                echo '<h4>Total : '.MontantGlobal().'€</h4>';
                echo "</td></tr>";

                echo "<tr><td colspan=\"4\">";
                echo '<input class="button-4" type="submit" value="Rafraichir"/>';
                echo "<input type=\"hidden\" name=\"action\" value=\"refresh\"/>";
                ?>
                <a class="button-4" href="produit.php">Continuer mes achats</a>
                <input class="button-commande" type="submit" id="Commander" name="Commander" value="Commander"/>
                <!-- <a class="button-4" href="test.php">Facture</a> -->
                <?php
                echo "</td></tr>";
            }
            }
            ?>
        </table>
        </form>
            <?php
                date_default_timezone_set('Europe/Paris');
                $date = date('Y-m-d');
                $a = $_SESSION['NumCli'];

                if(isset($_POST['Commander']))
                {
                    extract($_POST);
                    //BDD
                    include 'database.php';
                    global $db;
                    $q = $db->prepare("INSERT INTO commande(NumCli, DateCom) VALUES('$a', '$date')"); //Ajoute une commande en fonction du client
                    $q->execute([
                        'NumCli' => $a,
                        'DateCom' => $date
                    ]);
                    
                    
                    $Com = $db->query('SELECT MAX(NumCom) AS Com FROM commande'); // Récupère la dernière commande
                    while($donnees = $Com->fetch())
                    {
                        $NumCom = $donnees['Com'];
                        for ($f=0; $f < compterArticles(); $f++) //Boucle permettant de compter le nombre d'articles
                        {
                            $numprod = $db->query('SELECT NumProd, QteProd, NomProd FROM produit WHERE NomProd = "'.libProd()[$f].'"');//Récupère le NumProd en fonction du libelléProd
                            while($donnees = $numprod->fetch())
                            {
                                if($donnees['QteProd'] >= qteProd()[$f] && $donnees['QteProd'] >= 0)
                                {
                                    $numprod2 = $donnees['NumProd'];
                                    $q = $db->prepare("INSERT INTO composer(NumCom,NumProd,QteCom) VALUES('$NumCom','$numprod2','".qteProd()[$f]."')");//Ajoute les données d'une commande dans la table Composer
                                    $q->execute([
                                        'NumCom' => $NumCom,
                                        'NumProd' => $numprod2,
                                        'QteCom' => qteProd()[$f]
                                    ]); 
                                    $Approvisionnement = $db->prepare('UPDATE produit SET QteProd = QteProd - "'.qteProd()[$f].'" WHERE NumProd = "'.$numprod2.'"');
                                    $Approvisionnement->execute([]);

                                    header('Location:commande.php?id='.$NumCom.'');
                                }
                                else
                                {
                                echo "Vous ne pouvez pas commander plus de ".$donnees['QteProd']." ".$donnees['NomProd']." ! <br>";
                                }
                            }
                        }
                    }
                }                  
            ?>
        </div>
        <footer>
           <div class="wrapper">
               <h1>LowHifi<span class="orange">.</span></h1>
               <div class="copyright">Copyright &copy 2020. Tous les droits sont réservés.</div>
           </div> 
        </footer>
    </body>
</html>