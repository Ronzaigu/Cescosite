<head>


<?php
    session_start();
    if(isset($_SESSION["user"]) == FALSE) {
        header('Location: index.php?page=connection');
        
    }else
    {
        include_once("db.php");

        $num = $_POST["num"];

    $type = $_POST["type"];

        $userPK = $_SESSION["userPK"];
        
        

    
        $sql = "SELECT USER_Fk FROM aj_reaction WHERE USER_Fk = $userPK AND ARTICLE_FK = $num AND type = '$type'";
        
 
        $result = $conn->query($sql);


       
        if ($result->num_rows >= 1) {
            $sql = "DELETE FROM aj_reaction WHERE USER_Fk = $userPK AND ARTICLE_FK = $num AND type = '$type'";
            if (mysqli_query($conn, $sql)) {
               header('Location: .?page=home');
          


            }else{
                echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
            }

        }else {

            $sql = "INSERT INTO aj_reaction (ARTICLE_FK, USER_FK, type) VALUES ($num,$userPK, '$type')";
            if (mysqli_query($conn, $sql)) {


     
                $sqlUSERFK = "SELECT USER_FK, title FROM aj_articles WHERE ARTICLES_PK = $num";
                $userFK = $conn->query($sqlUSERFK)->fetch_assoc()["USER_FK"];
                $title = $conn->query($sqlUSERFK)->fetch_assoc()["title"];
                
                header('Location: .?page=home');
            echo $type;

              


            }else{
                echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
            }

        }

       
    
    
 
    
    }
    
?>