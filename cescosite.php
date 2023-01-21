<!DOCTYPE html>
<html id='all'>
<head>
        <title>CescoSite</title>
        <meta name=
  "CescoSite"
        content="#aa7700">
        <link rel="manifest"
        href="manifest.json">



  
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Cescosite : Site de publication d'article pour Cescole.">
        <link rel="stylesheet" href="./cescosite.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Import prismjs stylesheet -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.13.0/themes/prism.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/plugins/line-highlight/prism-line-highlight.min.css">

<link rel="stylesheet" href="trumbowyg/dist/ui/trumbowyg.min.css">

<!-- Import highlight plugin specific stylesheet -->
<link rel="stylesheet" href="trumbowyg/dist/plugins/highlight/ui/trumbowyg.highlight.min.css">

        <!--bootstrap library:-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous"><!--bootstrap library:--><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</head>

<body>

<header>
<input id= 'pageApi' style='visibility:hidden'>
        <br>
        <h1 class="titleh1">CESCOSITE</h1>
       
        <p class = "beta">(BÊTA)</p>

    

</header>



<nav class="butontop">


            <?php
                session_start();
                if(isset($_SESSION["user"])){
                    echo '<a href="./deconect.php" class="chat"><img class="ui" src="buttdec1.png"></a>';
                }else{
                    echo '<a href="./Connexion.php" class="chat"><img class="ui" src="conbutt.png"></a>';
                    echo '<a href="./Inscription.php" class="chat"><img class="ui" src="insbutt.png"></a>';
                }
             ?>
            <a href="./editeur.php" class="chat"><img class="ui" src="postbutt.png"></a>
            <a href="./chat.php#titre1" class="chat"><img class="ui" src="chat.png"></a>
            <a href="./settings.php" class="settings"><img class="ui" src="parabut.png"></a>
            
            
            <!-- <a href="./magasin.html" class="chat"><img class="ui" src="magasin.png"></a>
           <a href="./portefeuille.php" class="chat"><img class="ui" src="portefeuille.png"></a>-->
            <a href="./Apropos.html" class="chat"><img class="ui" src="apropos.png"></a>
            
            <a href="./contact.php" class="chat"><img class="ui" src="contact.png"></a><br>
         <!--   <a href="./donnate.html" class="donnate"><img class="ui" src="donate.png"></a><br>-->

            <div class="op">
              <?php
include_once("db.php");


?>











<div id = 'nbUsers'>

<p>...</p>
</div>

</div>



</nav>




<section>
<h2 class="art">Posts : </h2>












<article id = "artZone">


  


</article>
</section>
<footer>

  <p>ⓒ 2022 - AsterJdM production</p>
  
            

<script src="./cescosite2.js"></script>


<input style="visibility: hidden;" type="text" id = 'user_pk' value=<?php  echo $_SESSION[userPK]; ?>>
  </footer>
</body>

</html>

<img width="" src="" alt="">
