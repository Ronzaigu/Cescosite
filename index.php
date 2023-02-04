<head>
        <title>CescoSite</title>
        <link rel="manifest" href="manifest.json">




        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Cescosite : Site de publication d'article pour Cescole.">
        <link rel="stylesheet" href="./index.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Import prismjs stylesheet -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.13.0/themes/prism.css">
        <link rel="stylesheet"
                href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/plugins/line-highlight/prism-line-highlight.min.css">

        <link rel="stylesheet" href="trumbowyg/dist/ui/trumbowyg.min.css">

        <!-- Import highlight plugin specific stylesheet -->
        <link rel="stylesheet" href="trumbowyg/dist/plugins/highlight/ui/trumbowyg.highlight.min.css">

        <!--bootstrap library:-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
                crossorigin="anonymous"><!--bootstrap library:-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
                crossorigin="anonymous"></script>
</head>
<body>
<header>
                
                <h1 class="titleh1">CESCOSITE</h1>

        

        </header>





        <nav class="butontop">

        <a href="?page=home" class="home"><img class="ui" src="./img/home.png"></a>
                <?php
                session_start();
                if (isset($_SESSION["user"])) {
                        echo '<a href="./deconect.php" class="chat"><img class="ui" src="buttdec1.png"></a>';
                } else {
                        echo '<a href="?page=connection" class="chat"><img class="ui" src="./img/conbutt.png"></a>';
                        echo '<a href="?page=inscription" class="chat"><img class="ui" src="./img/insbutt.png"></a>';
                }
                ?>
                <a href="?page=editor" class="chat"><img class="ui" src="./img/postbutt.png"></a>
                <a href="?page=chat" class="chat"><img class="ui" src="./img/chat.png"></a>
                <a href="?page=settings" class="settings"><img class="ui" src="./img/parabut.png"></a>


                <!-- <a href="./magasin.html" class="chat"><img class="ui" src="magasin.png"></a>
           <a href="./portefeuille.php" class="chat"><img class="ui" src="portefeuille.png"></a>-->
                <a href="?page=about" class="chat"><img class="ui" src="./img/apropos.png"></a>

                <a href="?page=contact" class="chat"><img class="ui" src="./img/contact.png"></a><br>
                <!--   <a href="./donnate.html" class="donnate"><img class="ui" src="donate.png"></a><br>-->

                <div class="op">
                        <?php
                        include_once("db.php");
                   

                        ?>











                </div>



        </nav>




<br>


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