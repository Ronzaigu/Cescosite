<?php
include_once("db.php");



$sql = "SELECT content, USER_FK, dat, CHAT_PK  FROM ju_chat ORDER BY CHAT_PK DESC";

$result = $conn->query($sql);


$chatData = [];
while ($row = $result->fetch_assoc()) {

    $chatData[] = $row;




}


for ($i = 0; $i < count($chatData); $i++) {

    $sqlC = "SELECT username FROM ju_Users WHERE ju_Users_PK = " . $chatData[$i][USER_FK];

    $creator = $conn->query($sqlC)->fetch_assoc()["username"];
    $chatData[$i]["creator"] = $creator;
}




echo htmlspecialchars(json_encode($chatData));


?>