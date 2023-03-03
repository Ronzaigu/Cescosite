<?php

error_reporting(E_ALL);
include_once("db.php");


    $sql = "SELECT content, title, ARTICLES_PK,USER_FK, dat FROM aj_articles ORDER BY ARTICLES_PK DESC";
    $articles = $conn->query($sql);

    $chatData = [];


    while ($row = $articles->fetch_assoc()) {
        $chatData[] = $row;
    }



    for ($i = 0; $i < count($chatData); $i++) {

        $sqlC = "SELECT username FROM aj_Users WHERE aj_Users_PK = " . $chatData[$i][USER_FK];

        $creator = $conn->query($sqlC)->fetch_assoc()["username"];
        $chatData[$i][creator] = $creator;
    }

    $sql = "SELECT COMENT_PK, ARTICLE_FK, content, dat, USER_FK FROM aj_coments ORDER BY COMENT_PK DESC";
    $coments = $conn->query($sql);

    $ComData = [];


    while ($row = $coments->fetch_assoc()) {
        $ComData[] = $row;
    }






    $nb = 0;
    for ($ii = 0; $ii < count($chatData); $ii++) {
        $nb = 0;
        $chatData[$ii][comments];
        for ($i = 0; $i < count($ComData); $i++) {
            if ($ComData[$i][ARTICLE_FK] == $chatData[$ii][ARTICLES_PK]) {
                $chatData[$ii][comments]["com" . $nb] = $ComData[$i];
                $nb += 1;

            }
        }
    }




    $sql = "SELECT ARTICLE_FK,  USER_FK, type FROM aj_reaction ";
    $likes = $conn->query($sql);

    $LikeData = [];


    while ($row = $likes->fetch_assoc()) {

        $LikeData[] = $row;
    }

    $nb = 0;
    for ($ii = 0; $ii < count($chatData); $ii++) {
        $nb = 0;
        for ($i = 0; $i < count($LikeData); $i++) {
            if ($LikeData[$i][ARTICLE_FK] == $chatData[$ii][ARTICLES_PK]) {
                $chatData[$ii][reaction]["reaction#" . $nb] = $LikeData[$i];
                $nb += 1;

            }
        }
    }


    echo htmlspecialchars(json_encode($chatData));


    ?>



