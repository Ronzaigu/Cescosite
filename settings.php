<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Parametres</title>

	


	<script>

	if (window.location.protocol != "https:") {
		window.location.protocol="https:";
	}
	</script>


</head>

	<?php
            function alert($msg){
				echo "<script>alert('$msg')</script>";
			}
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
		//	header('Location: ?page=connection');
		}
		$userPK = $_SESSION['userPK'];
		
		
		if (isset($_POST["newPseudo"])) {

		
			$newPseudo = $conn -> real_escape_string($_POST["newPseudo"]);

			if(containsBadWord($newPseudo)){
				alert( "ERREUR : Votre pseudo contient des mots interdits !");

			}else{
				$sql = "UPDATE aj_Users SET username = '$newPseudo' WHERE users_PK = '$userPK'";
				if (mysqli_query($conn, $sql)) {
					alert("Votre pseudo a été mis a jour.");
				}else{
					alert( "Erreur : " . $sql . "<br>" . mysqli_error($conn));
				}
			}
			
		}

		if($_POST['newPass'] != ""){
			if (isset($_POST['oldPass']) && isset($_POST['newPass'])) {
				$OldPasswd = $conn -> real_escape_string($_POST['oldPass']) ; 
				$NewPasswd = $conn -> real_escape_string($_POST['newPass']) ; 
				

				$sql = "SELECT username FROM aj_Users WHERE users_PK = '$userPK' AND passwd = MD5(MD5('$OldPasswd'))";

				$result = $conn->query($sql);
				$row = $result->fetch_assoc();
				
				if ($result->num_rows > 0) {
					//old passwd OK:
					$sql = "UPDATE aj_Users SET passwd = MD5(MD5('$NewPasswd')) WHERE users_PK = '$userPK'";

					if (mysqli_query($conn, $sql)) {
						alert("Votre mot de passe a été mis a jour.");
					}else{
						alert("Erreur : " . $sql . "<br>" . mysqli_error($conn));
					}

				}else{
					alert( "Ancien mot de passe incorrect");
				}
		  
		}

		}

		echo "<script>window.location.href='index.php' </script>";
	?>


<body>
<!--
	<div class='all'>
	
	<h1 class="options">OPTIONS</h1>
	
	
	<p class="soustitre">Changer de pseudo</p>

	<form action="settings.php" method="post">

			<input class="name" type="text" name="newPseudo" placeholder="ㅤㅤNouveau pseudo">
			<br>
			<input class="but" type="submit" id="submit" value="Enregistrer">


	</form>
	<br>
	 Change password 
	<p class="soustitre">Changer de mot de passe</p>
	
	<form action="settings.php" method="post">

		<input class="pass" type="password" name="oldPass" placeholder="ㅤㅤAncien mot de passe" minlength="0">
		<br><input class="pass" type="password" name="newPass" placeholder="ㅤㅤNouveau mot de passe" minlength="8">
		<br>
		<input class="but" type="submit" id="submit" value="Enregistrer">

	</form>
	
	</div>
	-->





</head>
<body>



	

</div>

</body>
</html>