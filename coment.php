



<?php

function containsBadWord($string)
{ 
    $badWord = array("connard", "pute", "fuck", "sex", "sexy", "connard", "fucke","foutre", "geul", "geule", "cul", "merde", "couille", "bite", "hitler", "staline", "nazi", "con");
    

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
    $title = $_POST['title'];
    $creator = $_SESSION["user"];

    if (containsBadWord($content) == False) {
        $sql = "INSERT INTO ju_coments (content, USER_FK, ARTICLE_FK) VALUES ('$content', '$user', '$articlePK')";

        if (mysqli_query($conn, $sql)) {


            $sqlM = "SELECT mail FROM ju_Users WHERE mail_new_coment = 'on' AND username = '$creator'";
            $mail = $conn->query($sqlM)->fetch_assoc()["mail"];

            mail($mail, $user . " a commenté votre post !", "Le user : " . $_SESSION['user'] . " a commenté votre post : " . $title . " ! \n Avec ce commentaire : " . $content);


            header('Location: cescosite.php#' . "art" . $articlePK);

        } else {
            echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
        }


    }else{
        echo ("SOYEZ RESPECTUEUX !");
    }

}else{
    header('Location: Connexion.php');
}






?>