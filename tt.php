
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

        $sqlM = "SELECT mail FROM ju_Users WHERE mail_new_post = 'on'";
        $resultM = $conn->query($sqlM);
        while($row = $resultM->fetch_assoc()) {
            mail($row["mail"], $_SESSION['user']." a publié un nouvelle article !", "Allez voir le nouvelle article que ".$_SESSION['user']." a publié sur : \n https://rmbi.ch/cescosite/cescosite.php !");
        }

        echo "ok";


    
        header('Location: cescosite.php');

    }else{
        echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
    }




}else{
    echo "Si près du but...Mais si loin a la fois...";
}
$conn->close();
?>