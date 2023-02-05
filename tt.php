
<?php



include_once("db.php");
session_start();
if(isset($_SESSION['user'])){


    $text = "";
    $title = "";

    $text = $_POST["data"];
    $title = $conn -> real_escape_string(htmlspecialchars($_POST["title"]));
    $user = $_SESSION['userPK'];


    if($text == NULL || $title == NULL){
        echo "veuillez ajouter un titre et un text !";
    }


    $sql = "INSERT INTO ju_articles (title, content, USER_FK) VALUES ('$title', '$text', '$user')";
    if (mysqli_query($conn, $sql)) {

    

    
        header('Location: cescosite.php');

    }else{
        echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
    }




}else{
    echo "Si près du but...Mais si loin a la fois...";
}
$conn->close();
?>