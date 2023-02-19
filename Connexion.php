<html>
    <head>
        <title>Cescosite - Login</title>
        <link rel="stylesheet" href="./css/login.css">
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=0.5">
    </head>

    <body>

    <script>

    if(window.location.pathname != "/cescosite/"){

            window.location.href = ".?page=connection"


        }
    </script>


    <h1 class="titre">Connexion</h1>

    <div class = "all">

    

    <div class="login">

    	<?php
            function alert($msg){
              echo "<script>alert('$msg')</script>";
          }
    if (isset($_POST['username']))
    {


      $username = $conn -> real_escape_string($_POST['username']);
      $passwd =  hash("sha256", $_POST['passwd'])  ; 
      alert($username);
      $sql = "SELECT passwd, username, ju_Users_PK, is_validate FROM ju_Users WHERE username = '$username' AND passwd = '$passwd'";
      //echo $sql ;


      if (!mysqli_query($conn, $sql)) {
        echo mysqli_error($conn);
  
      }
      
      


      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      




      if ($result->num_rows > 0) {
        if(row['is_validate'] == 1) {
          session_start();
          $_SESSION["user"] = $username;
          $_SESSION["userPK"] = $row["ju_Users_PK"];
          header('Location: .?page=home');
        }
        else {
          alert("Veuillez vérifiez votre mail.");
        }
        ?>

        <?php
      } else {
        alert( "Le mot de passe et le nom d'utulisateur doivent être juste... .");
      }

      $conn->close();
    }
    ?> 
            
    <form action="?page=connection" method="POST">
    
        <input class="text" type="text" name="username" placeholder = "Nom d'utilisateur" class="pass"/>
        <input class="text" type="password" name="passwd" placeholder = "Mot de passe" class = pass/>
        <p>CONNEXION</p> 
        <input type="submit" class="connect_button">
            
      

        
    </form>
    <a class="ins" href="?page=inscription"><p class="link">Pas de compte ?</p></a><!--Redirects to Inscritpion.php-->
    </div>
    
    </div>



</body>
</html>