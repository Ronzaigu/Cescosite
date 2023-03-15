



<?php

function containsBadWord($string)
{ 
    $badWord = array("connard", "pute", "fuck", "sex", "sexy", "connard","foutre", "geul", "cul", "merde", "couille", "bite",  "con");
    

    for ($i=0; $i<count($badWord); $i++) {
        if(strpos($string, $badWord[$i]) !== FALSE){
            return TRUE;
        }
    }
}




include_once("db.php");
session_start();

if(isset($_SESSION["user"])){
    $content = $conn -> real_escape_string(htmlspecialchars($_POST["textC"]));
    $articlePK = $_POST["articlePK"];
    $user = $_SESSION["userPK"];


    if (containsBadWord($content) == False) {
        $sql = "INSERT INTO aj_coments (content, USER_FK, ARTICLE_FK) VALUES ('$content', '$user', '$articlePK')";

        if (mysqli_query($conn, $sql)) {



         //   header('Location: #' . "art" . $articlePK);

        } else {
            echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
        }


    }else{
        echo ("SOYEZ RESPECTUEUX !");
    }

}else{
    header('Location: .?page=connection');
}






?>