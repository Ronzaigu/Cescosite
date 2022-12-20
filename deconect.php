<?php

session_start();
unset($_SESSION["user"]);
unset($_SESSION["userPK"]);

echo "Vous êtes déconécter !";
header('Location: cescosite.php');

?>