<?php
include_once("db.php");
    
session_start();
if (isset($_SESSION["user"])) {
    $sql = "SELECT content, USER_FK, dat, CHAT_PK  FROM ju_chat ORDER BY CHAT_PK DESC";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            
            $sqlC = "SELECT username FROM ju_Users WHERE ju_Users_PK = '$row[USER_FK]'";

            $creator = $conn->query($sqlC)->fetch_assoc()["username"];
            
            
            echo "<strong>".$creator."</strong>"."    "."<em>".$row["dat"]."</em>";
            echo"<br>";
            echo "<p>".$row["content"]."</p>"."<br>"."_________________________________________________"."<br>";
            

        }

    }else{
        echo"0 message";
    }




    }else{
        echo"Haha, bien essayé.....";
    }

?>
