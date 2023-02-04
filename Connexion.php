<?php

include_once("db.php");

?>

<html>
    <head>
        <title>Cescosite - Login</title>
        <link rel="stylesheet" href="login.css">
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=0.5">
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet"> 
        <!--bootstrap library:-->


     
     

    </head>
    

        
        </nav>
    <body>

    <script>

        if (window.location.protocol != "https:") {
            window.location.protocol="https:";
        }
    </script>

    <h1 class="titre">Connexion</h1>

    <div class = "all">

    

        <div class="login">

	<?php

if (isset($_POST['username']))
{


  $username = $conn -> real_escape_string($_POST['username']);
  $passwd = $conn -> real_escape_string($_POST['passwd']) ; 

  $sql = "SELECT passwd, username, ju_Users_PK FROM ju_Users WHERE username = '".$username."' AND passwd = MD5(MD5('".$passwd."'))";
  //echo $sql ; 
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  
  if ($result->num_rows > 0) {
    echo "Connected";
    session_start();
    $_SESSION["user"] = $username;
    $_SESSION["userPK"] = $row["ju_Users_PK"];
    header('Location: .?page=home');
    ?>

    <?php
  } else {
    echo "Le mot de passe et le nom d'utulisateur doivent être juste... .";
  }

  $conn->close();
}
?> 
            
        <form action="Connexion.php" method="POST">
            <input class="text" type="text" name="username" placeholder = "Nom d'utilisateur" class="pass"/>
            <input class="text" type="password" name="passwd" placeholder = "Mot de passe" class = pass/>
  
         <input class="buttcon" type="image" src="./Buttcon1.png">   
        
            
    
            <a class="ins" href="?page=inscription"><p>Pas de compte ?</p></a><!--Redirects to Inscritpion.php-->
        
        </form>
        </div>




        

        </div>



</body>
</html>