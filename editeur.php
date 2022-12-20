<?php
include_once("db.php");
?>

<html>
<head>
        <meta charset="utf-8">
        <title>Cescosite - Nouveaux</title>
        <!-- Make sure the path to CKEditor is correct. -->
        <script src="ckeditor/ckeditor.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="editeur.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
</head>
<body>


        <?php
    session_start();
    if(isset($_SESSION["user"]) == FALSE) {
        header('Location: Connexion.php');
    }

    ?>
        <h1 class="titre1">PUBLIER UN NOUVEL ARTICLE<h1>
        <form action="tt.php" method="post">
        <input class="inte" type="text" placeholder="Titre" id = "titre" name="title">
        <input type="hidden" name="data" id = "data" name = "data">
        <textarea class="wsh" name="editor1" id="editor1" rows="50" cols="80">
        Écrivez votre post ici !
     
        </textarea>
        <input class="bouton" type="image" src="postbutt.png" onclick="send()"> 
        <script>
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        CKEDITOR.replace( 'editor1' );
        </script>
        <script>
            function send(){

                var text = CKEDITOR.instances.editor1.getData()
                    
                        
                document.getElementById('data').setAttribute('value', text);
                    //alert(text)

                
            }
        </script>
        </form>
</body>
</html>