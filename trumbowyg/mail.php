<?php



    $mess = $_POST["message"];



    session_start();
    $user = $_SESSION["user"];




    $destinataire = 'asterjdm@protonmail.com';
    mail($destinataire, 'Message de '.$user , $_SERVER['REMOTE_ADDR'].$mess);

    echo "Votre message a bien été envoyé !";


    header('Location: .?page=home');





?>