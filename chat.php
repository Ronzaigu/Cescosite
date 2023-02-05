


<html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./chat.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="./chat.js"></script>
    <title>CescoSite - Chat</title>
</head>
<body>


<script>
        
        if(window.location.pathname != "/cescosite/"){
            window.location.href = ".?page=chat"
            
        }
    </script>



  


 


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
        if ($_SESSION['userPK']) {
            if (containsBadWord(strtolower($_POST["text"])) == FALSE) {

                $sql = "INSERT INTO ju_chat (content, USER_FK) VALUES ('$text', '$user')";





                if (mysqli_query($conn, $sql)) {

                    $sqlL = "SELECT * FROM ju_chat";
                    $nbChat = $conn->query($sqlL)->num_rows;

                    if ($nbChat > $CHAT_LIMIT) {
                        $sqlD = "DELETE FROM ju_chat LIMIT 1";
                        mysqli_query($conn, $sqlD);
                    }

             
                    header('Location: ?page=chat');

                } else {
                    echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
                }

            }
        }else{
            echo "dqdw";
            header('Location: ?page=connection');
            
        }
    }


}
?>




<form class="zonetxt" method="post" onsubmit="return sendChatData();">
    <textarea class="zonne"name="text" id="chatContent" cols="30" rows="10"></textarea>
    <br/>     
    <input class="boutton" type="image" src="./img/send.png" id="submit" alt="submit"> 
</form>




<br>
<br>



<div class = "mess" id = "mess">
<p>Veuillez patienter....</p>
</div>
</div>




<script src="./chat.js"></script>

<footer>
    <input id ='chatData' style="visiblity:none" type="text">
</footer>

</body>


</html>

