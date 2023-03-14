<?php

error_reporting(E_ALL);

include_once("db.php");
session_start();
?>

<html>
    <head>
        <title>Cescosite - Inscription</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>
   
    <body>

        
        <?php
        
            function alert($msg){
                  echo '<script type="text/javascript">';
                    echo 'alert("' . addslashes($msg) . '");';
                    echo '</script>';
            }
            function containsBadWord($string)
            { 
                
                $badWord = array("admin","asterjdm", "moderator","moderateur", "modérateur", "modo", "connard", "pute", "fuck", "sex", "sexy", "connard", "fuck","foutre", "ftg", "geul", "geule", "cul", "merde", "couille", "bite", "hitler", "staline", "nazi", "debile", "débile", "con", "débil", "debil","jdm", "aster", "admin", "asteroidus");
                

                for ($i=0; $i<count($badWord); $i++) {
                    if(strpos($string, $badWord[$i]) !== FALSE){
                        return TRUE;
                    }
                }

                
            }



            if (isset($_POST['username']))
            {
                
            
                
                


      
                  $username = $conn -> real_escape_string(htmlspecialchars($_POST['username']));
                  $passwd = hash("sha256", $_POST['passwd'] ) ; 
                  $mail =  $_POST["mail"];
                  


                

                  if(str_replace(' ', '', $_POST["mail"] == "") || str_replace(' ', '', $_POST['passwd'] == "") || !filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)){
                    alert( "Veuillez saisir un nom d'utilisateur, un mot de passe ainsi que un email valide.");
                  }else{
                        if(containsBadWord(strtolower($username))){
                            alert( "Votre nom d'utulisateur contient des mot interdis.");
                        }else{
                            $mail_hash = hash('sha256', $mail);
                            $sql = "SELECT username FROM aj_Users WHERE username = '$username'";
                            $sqlM = "SELECT mail FROM aj_Users WHERE mail = '$mail_hash' and is_validate = 1";
                            //echo $sql ; 
                            $result = $conn->query($sql);
                            $resultM = $conn->query($sqlM);
                    
                            if ($result->num_rows > 0 ) {
                                alert( "Ce nom d'utilisateur est déja utilisé, veuillez en choisir un autre...");
                                
                            }elseif($resultM->num_rows > 0){

                                alert("Ce mail est déja utilisé.");
                            }else{
                     
                            //send verification email :
                
                                $subject = "Code de vérification";
                                $code = rand(100000000, 9999999999) ;
                                $message = "<p>Salut ".$username.", <br><br> Voici votre liens de vérification : <p><a href='https://rmbi.ch/cescosite/mailverify.php?code=$code&user=$username'>rmbi.ch/cescosite/mailverify.php</a>";
                               
                                    $headers = "MIME-Version: 1.0" . "\r\n";
                            $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
                   
                                      
                              
                              
                                if (mail($mail, $subject, $message, $headers)) {
                                    $mail_hash = hash('sha256', $mail);
                                    $code_hash = hash('sha256', $code);
                                    $sql = "INSERT INTO aj_Users (username, passwd, mail, is_validate, verif_code) VALUES ('$username', '$passwd', '$mail_hash', 'no', '$code_hash')";
                                
                            
                                    if (mysqli_query($conn, $sql)) {
                                     
                                        alert("Veuillez vérifier votre mail.");
                                        
                                        
                                    
                        

                                    
                                        
                                    }else{
                                        echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
                                    }
                        
                                   
                                    

                                } else {
                                  alert("error : L'envoi du code de vérification a échoué. Erreur : ".error_get_last());
                                }



                      
                                    
                            }
    
                        }
                  }
                 echo "<script>window.location.href='index.php' </script>";
             
            } 
                
                
            
            

        ?>          
            


<!--
        <form action="?page=inscription" method="POST" enctype="multipart/form-data">
            
            <input class="text" type="text" name="username" placeholder = "Nom d'utilisateur" class="pass"/>
            <input class="text" type="password" name="passwd" placeholder = "Mot de passe" class = pass minlength="8"/>
            <input class="text" type="email" name="mail" placeholder = "Votre adresse mail" multiple minlength="1" >
          
            <div class="h-captcha" data-sitekey="bb8bb61a-c05b-4a17-af23-25991a1329c3"></div>

            <button class="singup_button"><p class="link">Inscription</p></button>

            <a class="ins" href="?page=connection"><p class="subtitle">Deja un compte ?</p></a>
        
        </form>
        -->


       


</body>
</html>


     