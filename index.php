<!DOCTYPE html>
<html>


<head>
        <title>CescoSite</title>
        <link rel="manifest" href="manifest.json">
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Cescosite : Site de publication d'article pour Cescole.">
        <link rel="stylesheet" href="./css/index.css" />
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        
        <!-- Import prismjs stylesheet -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.13.0/themes/prism.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/plugins/line-highlight/prism-line-highlight.min.css">
        <link rel="stylesheet" href="trumbowyg/dist/ui/trumbowyg.min.css">

        <!-- Import highlight plugin specific stylesheet -->
        <link rel="stylesheet" href="trumbowyg/dist/plugins/highlight/ui/trumbowyg.highlight.min.css">

        <!--bootstrap library:-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"crossorigin="anonymous">

        <!--bootstrap library:-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"crossorigin="anonymous"></script>

</head>

<body>

<header>

    <h1 class="title">CESCOSITE</h1>

</header>


<script>
          if(window.location.pathname != "/cescosite/"){
            window.location.href = ".?page=home"

        }
    if (window.location.protocol != "https:") {
    window.location.protocol="https:";
}
</script>

        <nav class="butontop">
                
                <button onclick=window.location.href='?page=home'; class="navigator"><p class="subtitle">Home</p></button>
        
                <?php
                session_start();
                if (isset($_SESSION["user"])) {
                        echo '<button onclick=window.location.href="./deconect.php"; class="special"><p class="subtitle">Déconnexion</p></button>';
                } else {
                        echo '<button onclick=window.location.href="?page=connection""; class="special"><p class="subtitle">Connexion</p></button>';
                        echo '<button onclick=window.location.href="?page=inscription"; class="navigator"><p class="subtitle">Inscription</p></button>';
                }
                ?>
                <button onclick=window.location.href='?page=editor'; class="navigator"><p class="subtitle">Poster</p></button>
                <button onclick=window.location.href='?page=chat'; class="navigator"><p class="subtitle">Chat</p></button>
                <button onclick=window.location.href='?page=settings'; class="navigator"><p class="subtitle">paramètres</p></button>
                <button onclick=window.location.href='?page=about'; class="navigator"><p class="subtitle">A-propos</p></button>
                <button onclick=window.location.href='?page=contact'; class="navigator"><p class="subtitle">Contact</p></button>
                
                
                <!--
                <button onclick=window.location.href='./magasin.html'; class="navigator">Shop</button>
                <button onclick=window.location.href='./portefeuille.php'; class="Portefeuille">Editor</button>
                <button onclick=window.location.href./donnate.html'; class="navigator">Don</button>
                -->

                <div class="op">
                        
                    <?php
                    include_once("db.php");
                    ?>

                </div>
               

        </nav>





.<br>


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