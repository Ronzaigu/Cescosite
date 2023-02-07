<?php

error_reporting(E_ALL);

include_once("db.php");

?>

<html>
    <head>
        <title>Cescosite - Inscription</title>
        <link rel="stylesheet" href="./css/singup.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://js.hcaptcha.com/1/api.js" async defer></script>
    </head>
   
    <body>
    <script>
    
        if (window.location.protocol != "https:") {
            window.location.protocol="https:";
        }
    </script>


    <h1 class="titre">Inscription</h1>

        <div class="login">

        
        <?php
        

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
                
            

                
                $data = array(
                    'secret' => "0xb2094Fda50De87Fa9e42063D2521083296b09b97",
                    'response' => $_POST['h-captcha-response']
                );
                $verify = curl_init();
                curl_setopt($verify, CURLOPT_URL, "https://hcaptcha.com/siteverify");
                curl_setopt($verify, CURLOPT_POST, true);
                curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($verify);
                // var_dump($response);
                $responseData = json_decode($response);

                if($responseData->success) {


      
                  $username = $conn -> real_escape_string(htmlspecialchars($_POST['username']));
                  $passwd = $_POST['passwd'] ; 
                  $mail = $_POST["mail"];


                $new_post = $_POST["new-post"];
                $new_chat = $_POST["new-chat"];
                $new_coment = $_POST["new-coment"];
                $new_like = $_POST["new-like"];
                $new_actu = $_POST["new-actu"];






                

                  if(str_replace(' ', '', $username == "") || str_replace(' ', '', $passwd == "")){
                    echo "Votre Nom d'utilisateur ou votre mot de pass ne peux pas être vide";
                  }else{
                        if(containsBadWord(strtolower($username))){
                            echo "Votre nom d'utulisateur contient des mot interdis";
                        }else{
                    
                            $sql = "SELECT username FROM ju_Users WHERE username = '".$username."'";
                            //echo $sql ; 
                            $result = $conn->query($sql);
                            
                            if ($result->num_rows > 0 ) {
                                echo "Ce nom d'utilisateur est déja utulisé, veuillez en choisir un autre...";
                                
                            }else{
                     
                            
                                    $sql = "INSERT INTO ju_Users (username, passwd, mail, mail_new_post, mail_new_chat, mail_new_coment, mail_new_like, mail_new_actu) VALUES ('$username', MD5(MD5('$passwd')), '$mail', '$new_post', '$new_chat', '$new_coment', '$new_like', '$new_actu')";
                                
                            
                                    if (mysqli_query($conn, $sql)) {
                                        $sqlU = "SELECT ju_Users_PK FROM ju_Users WHERE username = '".$username."'";
                                        $result = $conn->query($sqlU);
                                        $row = $result->fetch_assoc();

                                        $userPK = $row["ju_Users_PK"];

                        
                                        $_SESSION["user"] = $username;
                                        $_SESSION["userPK"] = $userPK;
                                        
                                        
                                    

                                        header('Location:');
                                    
                                        
                                    }else{
                                        echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
                                    }
                                    
                                }
    
                        }
    
                }
                
                
                
                }else{
                echo "Veuillez résoudre le captcha";
                }
    
    
                } 
                
                
    
            
            

        ?>          
            
   


        <form action="Inscription.php" method="POST" enctype="multipart/form-data">
            
            <input class="text" type="text" name="username" placeholder = "Nom d'utilisateur" class="pass"/>
            <input class="text" type="password" name="passwd" placeholder = "Mot de passe" class = pass minlength="8"/>
            <input class="text" type="email" name="mail" placeholder = "Votre adresse mail" multiple minlength="1" >
          
            <div class="h-captcha" data-sitekey="bb8bb61a-c05b-4a17-af23-25991a1329c3"></div>

            <button class="singup_button"><p class="link">Inscription</p></button>

            <a class="ins" href="?page=connection"><p class="subtitle">Deja un compte ?</p></a>
        
        </form>
        
        </div>


       


</body>
</html>
