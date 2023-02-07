<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/chat.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="./js/chat.js"></script>
    <title>CescoSite - Chat</title>
</head>
<body>



<div class="border">

<?php

$CHAT_LIMIT = 20;

function containsBadWord($string)
{ 
    $badWord = array("connard", "pute", "fuck", "sex", "sexy", "connard", "fucke","foutre", "geul", "geule","tamer", "cul", "merde", "couille", "bite", "hitler", "staline", "nazi", "con");
    

    for ($i=0; $i<count($badWord); $i++) {
        if(strpos($string, $badWord[$i]) !== FALSE){
            return TRUE;
        }
    }
}


session_start();
include_once("db.php");





if(isset($_POST["text"]))
{
    
    
    $text = $conn -> real_escape_string(htmlspecialchars($_POST["text"]));
    $user = $_SESSION['userPK'];
    

    if($text !== "")
    {
        if(containsBadWord(strtolower($_POST["text"])) == FALSE){
            
            $sql = "INSERT INTO ju_chat (content, USER_FK) VALUES ('$text', '$user')";
        




            if (mysqli_query($conn, $sql)) {

                $sqlL = "SELECT * FROM ju_chat";
                $nbChat = $conn->query($sqlL)->num_rows;

                if ($nbChat > $CHAT_LIMIT) {
                    $sqlD = "DELETE FROM ju_chat LIMIT 1";
                    mysqli_query($conn, $sqlD);
                }
                
                $sqlM = "SELECT mail FROM ju_Users WHERE mail_new_chat = 'on'";
                $resultM = $conn->query($sqlM);
                
                while($row = $resultM->fetch_assoc()) {
                    mail($row["mail"], $_SESSION['user']." a envoyé un message dans le chat !", "Voila le message de ".$_SESSION['user']." : ".$text." \n\n  Allez sur https://rmbi.ch/cescosite/chat.php pour lui répondre !");
                }
                header('Location: ?page=chat');
    
            }else{
                echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
            }

        }

    }


}
?>




<form class="zonetxt" method="post" onsubmit="return sendChatData();">

    <textarea class="zone" name="text" id="chatContent" cols="30" rows="10"></textarea>
    <br/>     
    <button class="button"  id="submit" ><p class="subtitle">Envoyer</p></button> 

</form>




<br>
<br>



<div class = "mess" id = "mess">
<p>Veuillez patienter....</p>
</div>
</div>




<script src="./chat.js"></script>

<footer>
    <input id ='chatData' type="text">
</footer>
 

</body>


</html>

