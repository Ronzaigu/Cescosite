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
    <link rel="stylesheet" type="text/css" href="./css/inscription.css">
    <link rel="stylesheet" type="text/css" href="./css/connection.css">
    <link rel="stylesheet" type="text/css" href="./css/settings.css">
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
	    	<button onclick="show_settings();" class="profile_photo_body"></button>
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
                        echo "<button onclick='show_connection();' class='navigator'><p class='text_in_button'>Connexion</p></button>";
                        echo "<button onclick='show_inscription();' class='navigator'><p class='text_in_button'>Inscription</p></button>";
                }
                ?>
                
	      <button onclick="window.location.href='?page=contact';" class="navigator"><p class="text_in_button">Contact</p></button>
	      <button onclick="window.location.href='?page=about';" class="navigator"><p class="text_in_button">A-propos</p></button>
		
		</div>

  		
</header>
<div id='settings_popup' class='settings_popup' style='display:none'>
    <div  class="settings">
		<form action="settings.php" method="post">
			<div class="top_settings">
				<div class="text_gear">
				<p class="settings_h1">Paramètres</p>
				<img class="gear" src="./img/gear.png" alt="gear icon">
				</div>
				<div class="line"></div>
			</div>

			<div class="change_photo">
				<button class="photo_preview"></button>
				<button class="change_photo_button"><p>Changer la photo de profil</p></button>
			</div>
<!--
			<div>
				
				<div class="color_choice">
					<div class="choice">
						<input type="color" name="color" id="">
					</div>
				</div>
			</div>
	-->
			<div class="change_username_password">
					<p class="settings_h1">Nom d'utilisateur</p>
					<div class="line"></div>
					<div class="center_input">
						<input class="enter" type="text" name="newPseudo" placeholder="Nouveau nom d'utilisateur">
					</div>
					<p class="settings_h1">Mot de passe</p>
					<div class="line"></div>
					<div class="center_input">
						<input class="enter" type="password" name="oldPass" placeholder="Ancien mot de passe">
						<input class="enter" type="password" name="newPass" placeholder="Nouveau mot de passe"  style="margin-bottom: 10px;">
					</div>
			</div>
			<div class="save">
				<button class="save_button" style="margin-bottom: 10px;"><p class="save_text">Sauvegarder</p></button>
			</div>
		</form>
	</div>

</div>


<div class='conn_popup' id='conn_popup' style="display:none">
    <div class="connection" >
            <form action="Connexion.php" method="POST">
            <h1 class="connection_h1">CONNEXION</h1>
            <div class="inputs">
            <p class="username_text" style="margin-top: 75">Nom d'utilisateur</p>
            <div class="line"></div>
            <input type="text" name="username" placeholder="Nom d'utilisateur" class="username_input">
            <p class="password_text">Mot de passe</p>
            <div class="line"></div>
            <input type="password" name="passwd" placeholder="Mot de passe" class="password_input">
        </div>
        <div class="buttons">
        <button  class="connection_button">Connexion</button>
        </div>
        <a class="no_account" href="?page=inscription"><p>Pas de compte ?</p></a>
        </form>

    </div>
</div>

<div class='inscription_popup' id='inscription_popup' style='display:none'>
        <form action="Inscription.php" method="POST">
        <div class="inscription">
                        
                        <h1 class="inscription_h1">INSCRIPTION</h1>
                        <div class="inputs">
                                <p class="username_text" style="margin-top: 75">Nom d'utilisateur</p>
                                <div class="line"></div>
                                <input type="text" name="username" placeholder="Nom d'utilisateur" class="username_input">
                                <p class="password_text">Mot de passe</p>
                                <div class="line"></div>
                                <input type="password" name="passwd" placeholder="Mot de passe" class="password_input">
                                <p class="email_text">Email</p>
                                <div class="line"></div>
                                <input type="text" name="mail" placeholder="Email" class="email_input">

                        </div>
                        <div class="buttons">
                        <button class="inscription_button">Inscription</button>
                        </div>
                  
                        <a class="already_account" onclick="hideInscription(); show_connection();"><p>Deja un compte ?</p></a>

                </div>
        </form>

</div>
<div id="overlay"></div>
<br><br>

    <?php

    
    $page = $_GET["page"];

 
 
    if ($page == "settings") {
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



<script src="js/inscription.js"></script>
<script src="js/connection.js"></script>
<script src="js/settings.js"></script>
</body>
</html>