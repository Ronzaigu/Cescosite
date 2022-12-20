<?php

error_reporting(E_ALL);
include_once("db.php");



$sql = "SELECT content, title, ARTICLES_PK,USER_FK, dat FROM ju_articles ORDER BY ARTICLES_PK DESC";
$articles = $conn->query($sql);

$ArtData = [];


while ($row = $articles->fetch_assoc()) {
  $ArtData[] = $row;
}



for ($i=0; $i < count($ArtData); $i++) { 
  
    $sqlC = "SELECT username FROM ju_Users WHERE ju_Users_PK = ".$ArtData[$i][USER_FK];

    $creator = $conn->query($sqlC)->fetch_assoc()["username"];
    $ArtData[$i][creator] = $creator;
}

$sql = "SELECT COMENT_PK, ARTICLE_FK, content, dat, USER_FK FROM ju_coments ORDER BY COMENT_PK DESC";
$coments = $conn->query($sql);

$ComData = [];


while ($row = $coments->fetch_assoc()) {
  $ComData[] = $row;
}






$nb=0;
for ($ii=0; $ii < count($ArtData); $ii++) { 
    $nb=0;
    $ArtData[$ii][comments];
    for ($i=0; $i < count($ComData); $i++) { 
        if ($ComData[$i][ARTICLE_FK] == $ArtData[$ii][ARTICLES_PK]) {
            $ArtData[$ii][comments]["com".$nb] =  $ComData[$i];
            $nb+=1;
            
        }
    }
}




$sql = "SELECT ARTICLE_FK,  USER_FK, type FROM ju_reaction ";
$likes = $conn->query($sql);

$LikeData = [];


while ($row = $likes->fetch_assoc()) {

  $LikeData[] = $row;
}

$nb=0;
for ($ii=0; $ii < count($ArtData); $ii++) { 
    $nb=0;
    for ($i=0; $i < count($LikeData); $i++) { 
        if ($LikeData[$i][ARTICLE_FK] == $ArtData[$ii][ARTICLES_PK]) {
            $ArtData[$ii][reaction]["reaction#".$nb] =  $LikeData[$i];
            $nb+=1;
            
        }
    }
}


echo htmlspecialchars(json_encode($ArtData));

?>




