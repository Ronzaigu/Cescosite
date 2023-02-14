<!DOCTYPE html>
<html id='all'>

<head>
        <title>CescoSite</title>



        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Cescosite : Site de publication d'article pour Cescole.">
        <link rel="stylesheet" href="./css/cescosite.css" />
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

<br><br><br>
<script>
        
if(window.location.pathname != "/cescosite/"){
        window.location.href = ".?page=home"
}

</script>
      
    
              


<h1 class="post_big_title">POST</h1>



<br>

        <select id="range">
                <option value="more_likes">Le plus liké</option>
                <option value="more_times">Le plus récent</option>
                <option value="random">Aléatoire</option>
     
        </select> 



        <br>
        <div id ='artZone' class="post">



        </div>
        
        <footer>

                <p class="fake_copyright">ⓒ 2022 - AsterJdM production</p>



                <script src="./js/cescosite.js"></script>


                <input style="visibility: hidden;" type="text" id='user_pk' value=<?php echo $_SESSION['userPK']; ?>>
        </footer>
</body>

</html>

