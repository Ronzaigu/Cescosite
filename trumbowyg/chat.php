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

<script src="./js/chat.js"></script>

<div class="border">

<?php
error_reporting("E_ALL | E_STRICT | E_NOTICE | E_DEPRECATED | E_USER_");
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


if(isset($_POST['text'])){
    header("location: .?page=connection");
    if(isset($_SESSION['user'])){
        
        
        $text = $conn -> real_escape_string(htmlspecialchars($_POST["text"]));
        $user = $_SESSION['userPK'];
        

        if($text !== "")
        {
            if(containsBadWord(strtolower($_POST["text"])) == FALSE){
                
                $sql = "INSERT INTO aj_chat (content, USER_FK) VALUES ('$text', '$user')";
            




                if (mysqli_query($conn, $sql)) {

                    $sqlL = "SELECT * FROM aj_chat";
                    $nbChat = $conn->query($sqlL)->num_rows;

                    if ($nbChat > $CHAT_LIMIT) {
                        $sqlD = "DELETE FROM aj_chat LIMIT 1";
                        mysqli_query($conn, $sqlD);
                    }
                    
                    header('Location: ?page=chat');
        
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







<br>
<br>


<article class="chat">
<div class = "mess" id = "mess">
<p>Veuillez patienter....</p>
</div>

<div class="input_bottom">
<div class="chat_bottom">
<input type="text" name="send" class="send_chat_input">
<div>
<button onclick="sendChatData()" class="send_chat_button">Send</button>

</div></div></article>






<footer>
    <input id ='chatData' type="text">
</footer>
 

</body>


</html>

