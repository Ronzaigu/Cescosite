<head>


<?php
    session_start();
    if(isset($_SESSION["user"]) == FALSE) {
        header('Location: Connexion.php');
        
    }else
    {
        include_once("db.php");

        $num = $_POST["num"];

    $type = $_POST["type"];

        $userPK = $_SESSION["userPK"];
        
        

    
        $sql = "SELECT USER_Fk FROM ju_reaction WHERE USER_Fk = $userPK AND ARTICLE_FK = $num AND type = '$type'";
        
 
        $result = $conn->query($sql);


       
        if ($result->num_rows >= 1) {
            $sql = "DELETE FROM ju_reaction WHERE USER_Fk = $userPK AND ARTICLE_FK = $num AND type = '$type'";
            if (mysqli_query($conn, $sql)) {
               header('Location: cescosite.php');
          


            }else{
                echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
            }

        }else {

            $sql = "INSERT INTO ju_reaction (ARTICLE_FK, USER_FK, type) VALUES ($num,$userPK, '$type')";
            if (mysqli_query($conn, $sql)) {


     
                $sqlUSERFK = "SELECT USER_FK, title FROM ju_articles WHERE ARTICLES_PK = $num";
                $userFK = $conn->query($sqlUSERFK)->fetch_assoc()["USER_FK"];
                $title = $conn->query($sqlUSERFK)->fetch_assoc()["title"];
                
                $sqlM = "SELECT mail FROM ju_Users WHERE mail_new_like = 'on' AND ju_Users_PK = '$userFK'";
                $mail = $conn->query($sqlM)->fetch_assoc()["mail"];
                mail($mail, $_SESSION['user']." a liké votre post", "Le user ".$_SESSION['user']." a soutenus votre post : ".$title."\n\n https://rmbi.ch/cescosite/cescosite.php#art".$num);
                header('Location: cescosite.php');
            echo $type;

              


            }else{
                echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
            }

        }

       
    
    
 
    
    }
    
?>