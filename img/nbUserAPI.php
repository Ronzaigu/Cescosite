<?php
include_once("db.php");
  $sqlU = "SELECT * FROM ju_Users";
  $users = $conn->query($sqlU);
  $nbUsers = $users->num_rows;


  $sqlA = "SELECT * FROM ju_articles";
  $article = $conn->query($sqlA);
  $nbArt = $article->num_rows;

  $sqlC = "SELECT * FROM ju_chat";
  $chat = $conn->query($sqlC);
  $nbChat = $chat->num_rows;


  echo "<h3 style='color:black;'>"."Il y a ".$nbUsers." personnes inscrites et ".$nbArt." posts !"."</h3>";

?>