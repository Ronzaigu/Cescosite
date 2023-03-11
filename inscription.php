<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./css/inscription.css">
	<title>Inscription</title>
</head>
<body>

	<div class="inscription">
		
		<h1 class="inscription_h1">INSCRIPTION</h1>
		<div class="inputs">
			<p class="username_text" style="margin-top: 75">Nom d'utilisateur</p>
			<div class="line"></div>
			<input type="text" name="Nom d'utilisateur" placeholder="Nom d'utilisateur" class="username_input">
			<p class="password_text">Mot de passe</p>
			<div class="line"></div>
			<input type="password" name="Mot de passe" placeholder="Mot de passe" class="password_input">
			<p class="email_text">Email</p>
			<div class="line"></div>
			<input type="text" name="email" placeholder="Email" class="email_input">
		</div>
		<div class="buttons">
		<button class="inscription_button">Inscription</button>
		</div>
		<!-- Place for captcha -->
		<a class="already_account" href="?page=connection"><p>Deja un compte ?</p></a>

	</div>

</body>
</html>