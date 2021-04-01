<!-- Déconnexion d'un compte membre-->
<?php  
        session_start();   
        if(isset($_SESSION['MailCli']) and $_SESSION['MdpCli'])
        {
                session_destroy();
                $_SESSION['MailCli']=$MailCli;
                $_SESSION['MdpCli']=$MdpCli;
        }  
        header('Location:Index.php');
         exit();                   
?>