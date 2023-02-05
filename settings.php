<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./settings.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
   	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   	<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
   	<link rel="preconnect" href="https://fonts.googleapis.com">
   	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   	<link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet"> 
	<title>Parametres</title>
	<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
	<a href="./cescosite.php"> 
 
    </a>

	<script>
        
        if(window.location.pathname != "/cescosite/"){
            window.location.href = ".?page=settings"
            
        }
    </script>

</head>
<?php

	function containsBadWord($string)
	{ 
		$badWord = array("admin","asterjdm", "moderateur", "modérateur", "modo", "connard", "pute", "fuck", "sex", "sexy", "connard", "fuck","foutre", "ftg", "geul", "geule", "cul", "merde", "couille", "bite", "hitler", "staline", "nazi", "debile", "débile", "con", "débil", "debil","jdm", "aster", "asteroidus");
		

		for ($i=0; $i<count($badWord); $i++) {
			if(strpos($string, $badWord[$i]) !== FALSE){
				return TRUE;
			}
		}

		
	}
	
	include_once("db.php");
	session_start();
	if(isset($_SESSION['user']) == FALSE){
		header('Location: ?page=connection');
	}
	$userPK = $_SESSION['userPK'];
	
	
	if (isset($_POST["newPseudo"])) {

	
		$newPseudo = $conn -> real_escape_string($_POST["newPseudo"]);

		if(containsBadWord($newPseudo)){
			echo "ERREUR : Votre pseudo contient des mots interdits !";

		}else{
			$sql = "UPDATE ju_Users SET username = '$newPseudo' WHERE ju_Users_PK = '$userPK'";
			if (mysqli_query($conn, $sql)) {
				echo "Votre pseudo a été mis a jour.";
			}else{
				echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
			}
		}
		
	}


	if (isset($_POST['oldPass']) && isset($_POST['newPass'])) {
		$OldPasswd = $conn -> real_escape_string($_POST['oldPass']) ; 
		$NewPasswd = $conn -> real_escape_string($_POST['newPass']) ; 
		

		$sql = "SELECT username FROM ju_Users WHERE ju_Users_PK = '$userPK' AND passwd = MD5(MD5('$OldPasswd'))";

		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		if ($result->num_rows > 0) {
			//old passwd OK:
			$sql = "UPDATE ju_Users SET passwd = MD5(MD5('$NewPasswd')) WHERE ju_Users_PK = '$userPK'";

			if (mysqli_query($conn, $sql)) {
				echo "Votre mot de passe a été mis a jour.";
			}else{
				echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
			}

		}else{
			echo "Ancien mot de passe incorrect";
		}
	  


	}

	if (isset($_POST['form_sender'])) {
		$newPost = $_POST['new-post'];
		$newChat = $_POST['new-chat'];
		$newComent = $_POST['new-coment'];
		$newLike = $_POST['new-like'];
		$newActu = $_POST['new-actu'];

		$sql = "UPDATE ju_Users SET mail_new_post = '$newPost', mail_new_chat = '$newChat', mail_new_coment = '$newComent', mail_new_like = '$newLike', mail_new_actu = '$newActu' WHERE ju_Users_PK = '$userPK'";
	
		if (mysqli_query($conn, $sql)) {
			echo "Vos modification on été enregistrées.";
		}else{
			echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
		}
	}

?>


<body>
	<div class='div1'>
	<h1>OPTIONS</h1>
	<p class="soustitre">Changer de pseudo</p>

	<form action="settings.php" method="post">

			<input class="nom" type="text" name="newPseudo" placeholder="Nouveau pseudo">
			<br>
			<input class="but" type="image" src="./img/eng.png" id="submit" alt="submit"> 

	</form>
	
	<p class="soustitre">Changer de mot de passe</p>
	
	<form action="settings.php" method="post">


		<input class="mdp" type="password" name="oldPass" placeholder="Ancien mot de passe" minlength="0">
		<br><input class="mdp" type="password" name="newPass" placeholder="Nouveau mot de passe" minlength="8">
		<br>
		<input class="but" type="image" src="./img/eng.png" id="submit" alt="submit"> 


	</form>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $(".btn1").click(function(){
    $(".wsh").show();
    $(".btn1").hide(1);
    $(".btn2").show(1);
  });
  $(".btn2").click(function(){
    $(".wsh").hide(1);
     $(".btn2").hide(1);
     $(".btn1").show(1);
  });
});
</script>
</head>
<body>


<a class="btn1" ><img class="img1 "src="./img/afficher.png"></a>
<a class="btn2" hidden><img class="img1 "src="./img/cacher.png"></a>
	<div class="wsh" hidden>
	
		<form action="settings.php" method="post">

				Recevoir un mail pour les nouveaux posts ?    <input type="checkbox" name="new-post">
				<br>
				<br>
				Recevoir un mail pour les nouveaux message dans le chat ?    <input type="checkbox" name="new-chat">
				<br>
				<br>
				Recevoir un mail pour les nouveaux comentaire à vos post ?    <input type="checkbox" name="new-coment">
				<br>
				<br>
				Recevoir un mail pour les nouveaux votes à vos post ?    <input type="checkbox" name="new-like">
				<br>
				<br>
				Recevoir un mail pour les actualitées du site ?    <input type="checkbox" name="new-actu">
				<br>
				<input type="text" style = 'display: none;' value = 'The_form_was_sending' name="form_sender">
				<input class="but" type="image" src="./img/eng.png" id="submit" alt="submit"> 


		</form>

</div>

</body>
</html>