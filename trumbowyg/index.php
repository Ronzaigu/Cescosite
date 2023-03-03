<!DOCTYPE html>
<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
include_once("db.php");
session_start()

?>
<html>
<head>

    <script>
              if(window.location.pathname != "/cescosite/"){
                window.location.href = ".?page=home"

            }
        if (window.location.protocol != "https:") {
        window.location.protocol="https:";
    }
    
    </script>
	
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./css/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cescosite - Home</title>
	
</head>

<body>

<header>
  <div class="container"><h1 class="uptitle">CESCOSITE</h1></div>
  		
  		<div class="new_post">
    		<button onclick="window.location.href='?page=editor';" class="navigator"><p class="text_in_button">+ Nouveau Post</p></button>
	    </div>

	 	 <div class="profile">
	    	<button class="profile_photo_body"></button>
	 	 </div>
	    
	  	<div class="nav">
	    
	     
	    </div>


	       <div class="many_button">
	    
	      <button onclick="window.location.href='?page=home';" class="navigator"><p class="text_in_button">Home</p></button>
          

          <?php
                session_start();
                if (isset($_SESSION["user"])) {
                        echo "<button onclick=\"window.location.href='./deconect.php';\" class='navigator'><p class='text_in_button'>Deconnexion</p></button>";
                } else {
                        echo "<button onclick=\"window.location.href='?page=connection';\" class='navigator'><p class='text_in_button'>Connexion</p></button>";
                        echo "<button onclick=\"window.location.href='?page=inscription';\" class='navigator'><p class='text_in_button'>Inscription</p></button>";
                }
                ?>
                
	      <button onclick="window.location.href='?page=contact';" class="navigator"><p class="text_in_button">Contact</p></button>
	      <button onclick="window.location.href='?page=about';" class="navigator"><p class="text_in_button">A-propos</p></button>
		
		</div>

  		
</header>

<br><br>

    <?php

    
    $page = $_GET["page"];
    if ($page == "connection") {
        include("./Connexion.php");
    }
    elseif ($page == "inscription") {
        include("./Inscription.php");
    }
 
    elseif ($page == "chat") {
        include("./chat.php");
    }
    elseif ($page == "settings") {
        include("./settings.php");
    }
    elseif ($page == "donate") {
        include("./donnate.html");

    }elseif ($page == "about") {
        include("./Apropos.html");

    }elseif ($page == "contact") {
        include("./contact.php");
    }elseif ($page == "editor") {
        include("./editeur.php");
    }elseif ($page == "home") {
        include("./cescosite.php");
    }else{
        include("./cescosite.php");
    }


    ?>




</body>
</html>