<?php

error_reporting(E_ALL);

include_once("db.php");
session_start();
?>

<html>
    <head>
        <title>Cescosite - Inscription</title>
        <link rel="stylesheet" href="./css/inscription.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>
   
    <body>
    <script>
    
    if(window.location.pathname != "/cescosite/"){
            window.location.href = ".?page=inscription"

        }
    </script>


        
        <?php
        
            function alert($msg){
                  echo '<script type="text/javascript">';
                    echo 'alert("' . addslashes($msg) . '");';
                    echo '</script>';
            }
            function containsBadWord($string)
            { 
                
                $badWord = array("admin","asterjdm", "moderateur", "modérateur", "modo", "connard", "pute", "fuck", "sex", "sexy", "connard", "fuck","foutre", "ftg", "geul", "geule", "cul", "merde", "couille", "bite", "hitler", "staline", "nazi", "debile", "débile", "con", "débil", "debil","jdm", "aster", "asteroidus");
                

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
                    alert( "Veuillez saisir un nom d'utilisateur et un mot ainsi que un email valide.");
                  }else{
                        if(containsBadWord(strtolower($username))){
                            alert( "Votre nom d'utulisateur contient des mot interdis.");
                        }else{
                    
                            $sql = "SELECT username FROM aj_Users WHERE username = '$username'";
                            $sqlM = "SELECT mail FROM aj_Users WHERE mail = hash('sha256', $mail)";
                            //echo $sql ; 
                            $result = $conn->query($sql);
                            $resultM = $conn->query($sqlM);
                            
                            if ($result->num_rows > 0 ) {
                                alert( "Ce nom d'utilisateur est déja utulisé, veuillez en choisir un autre...");
                                
                            }elseif($resultM->num_rows > 0){

                                alert("Ce mail est déja utulisé.");
                            }else{
                     
                            //send verification email :
                
                                $subject = "Code de vérification";
                                $code = rand(100000000, 9999999999) ;
                                $message = "<p>Salut ".$username.", <br><br> Voici votre liens de vérification : <p><a href='https://rmbi.ch/cescosite/mailverify.php?code=$code&user=$username'></a>";
                               
                                
                                      
                              
                              
                                if (mail($mail, $subject, $message)) {
                                    $mail_hash = hash('sha256', $mail);
                                    $code_hash = hash('sha256', $code);
                                    $sql = "INSERT INTO aj_Users (username, passwd, mail, is_validate, verif_code) VALUES ('$username', '$passwd', '$mail_hash', 'no', '$code_hash')";
                                
                            
                                    if (mysqli_query($conn, $sql)) {
                                     
                                        alert("Veuillez vérifier votre mail.");
                                        
                                        
                                    
                        
                                        die();
                                    
                                        
                                    }else{
                                        echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
                                    }
                        
                                   
                                    

                                } else {
                                  alert("error : L'envoi du code de vérification a échoué.");
                                }



                      
                                    
                            }
    
                        }
                  }
             
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
        <form action="?page=inscription" method="POST">
    <div class="inscription">
		
		<h1 class="inscription_h1">INSCRIPTION</h1>
		<div class="inputs">
			<p class="username_text" style="margin-top: 75">Nom d'utilisateur</p>
			<div class="line"></div>
			<input type="text" name="username" placeholder="Nom d'utilisateur" class="username_input">
			<p class="password_text">Mot de passe</p>
			<div class="line"></div>
			<input type="password" name="passwd" placeholder="Mot de passe" class="password_input">
			<p class="email_text">Email</p>
			<div class="line"></div>
			<input type="text" name="mail" placeholder="Email" class="email_input">

		</div>
		<div class="buttons">
		<button class="inscription_button">Inscription</button>
		</div>
		<!-- Place for captcha -->
		<a class="already_account" href="?page=connection"><p>Deja un compte ?</p></a>

	</div>
    </form>

        
        


       


</body>
</html>


     