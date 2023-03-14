

    


    	<?php
      include_once("db.php");
            function alert($msg){
              echo "<script>alert('$msg')</script>";
          }
    if (isset($_POST['username']))
    {



      $username = $conn -> real_escape_string($_POST['username']);

      $passwd =  hash("sha256", $_POST['passwd'])  ; 
      
      $sql = "SELECT passwd, username, users_PK, is_validate FROM aj_Users WHERE username = '$username' AND passwd = '$passwd'";
      //echo $sql ;

     
      if (!mysqli_query($conn, $sql)) {
        echo mysqli_error($conn);
  
      }
      
      


      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      



      
      if ($result->num_rows > 0) {
        if($row['is_validate'] == 1) {
          session_start();
          $_SESSION["user"] = $username;
          $_SESSION["userPK"] = $row["users_PK"];
          
          header('Location: .?page=home');
        }
        else {
          alert("Veuillez vérifiez votre mail.");
        }
       

      } else {
        alert( "Le mot de passe et le nom d'utulisateur doivent être juste... .");
      }

      $conn->close();
    }
    ?> 
            <!--
    <form action="?page=connection" method="POST">
    
        <input class="text" type="text" name="username" placeholder = "Nom d'utilisateur" class="pass"/>
        <input class="text" type="password" name="passwd" placeholder = "Mot de passe" class = pass/>
        <p>CONNEXION</p> 
        <input type="submit" class="connect_button">
            
      

        
    </form>
    <a class="ins" href="?page=inscription"><p class="link">Pas de compte ?</p></a>
  -->
  




