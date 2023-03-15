
<html>

<?php
error_reporting("E_ALL | E_STRICT | E_NOTICE | E_DEPRECATED | E_USER_");
$CHAT_LIMIT = 10;

function containsBadWord($string)
{ 
    $badWord = array("connar", "pute", "fuck", "sex", "sexy", "connard", "fucke","foutre", "geul", "geule","tamer", "cul", "merde", "couille", "bite");
    

    for ($i=0; $i<count($badWord); $i++) {
        if(strpos($string, $badWord[$i]) !== FALSE){
            return TRUE;
        }
    }
}


session_start();
include_once("db.php");


if(isset($_POST['text'])){

    if(isset($_SESSION['user'])){
        
        
        $text = $conn -> real_escape_string(htmlspecialchars($_POST["text"]));
        $user = $_SESSION['userPK'];
        

        if($text !== "")
        {
            if(containsBadWord(strtolower($_POST["text"])) == FALSE){
                
                $sql = "INSERT INTO aj_chat (content, USER_FK) VALUES ('$text', '$user')";
            




                if (mysqli_query($conn, $sql)) {


                 
        
                }else{
                    echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
                }

            }

        }


    }else{
     
        header("location: .?page=connection");

    }
}
?>







</html>
