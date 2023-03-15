<?php
include_once("db.php");
?>

<html>

<head>
    <meta charset="utf-8">
    <title>Cescosite - Nouveaux</title>


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/editeur.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="trumbowyg/dist/ui/trumbowyg.min.css">
    <link rel="stylesheet" href="trumbowyg/dist/plugins/colors/ui/trumbowyg.colors.min.css">
    <link rel="stylesheet" href="trumbowyg/dist/plugins/emoji/ui/trumbowyg.emoji.min.css">
    <link rel="stylesheet" href="trumbowyg/dist/plugins/giphy/ui/trumbowyg.giphy.min.css">

    <!-- Import prismjs stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.13.0/themes/prism.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/plugins/line-highlight/prism-line-highlight.min.css">

    <link rel="stylesheet" href="trumbowyg/dist/ui/trumbowyg.min.css">

    <!-- Import highlight plugin specific stylesheet -->

</head>

<body>
<br><br><br><br>
<script>
      if(window.location.pathname != "/cescosite/"){
            window.location.href = ".?page=editor"

        }

</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/prism.min.js"></script>
    <!-- Import prismjs line highlight plugin -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/plugins/line-highlight/prism-line-highlight.min.js"></script>

    <!-- Import Trumbowyg -->
    <script src="trumbowyg/dist/trumbowyg.min.js"></script>

    <!-- Import all plugins you want AFTER importing jQuery and Trumbowyg -->
    <script src="trumbowyg/dist/plugins/highlight/trumbowyg.highlight.min.js"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')</script>

    <script src="trumbowyg/dist/trumbowyg.min.js"></script>

    <script src="trumbowyg/dist/plugins/upload/trumbowyg.pasteimage.min.js"></script>
    <script src="trumbowyg/dist/plugins/base64/trumbowyg.base64.min.js"></script>

    <script type="text/javascript" src="js/dist/langs/fr.min.js"></script>

    <script src="//rawcdn.githack.com/RickStrahl/jquery-resizable/0.35/dist/jquery-resizable.min.js"></script>
    <script src="trumbowyg/dist/plugins/colors/trumbowyg.colors.min.js"></script>
    <script src="trumbowyg/dist/plugins/emoji/trumbowyg.emoji.min.js"></script>
    <script src="trumbowyg/dist/plugins/fontfamily/trumbowyg.fontfamily.min.js"></script>
    <script src="trumbowyg/dist/plugins/fontsize/trumbowyg.fontsize.min.js"></script>
    <script src="trumbowyg/dist/plugins/giphy/trumbowyg.giphy.min.js"></script>

    <script src="node_modules/prismjs/prism.js"></script>
    <script src="trumbowyg/dist/plugins/highlight/trumbowyg.highlight.min.js"></script>
    <script src="node_modules/prismjs/prism.js"></script>
    <script src="node_modules/prismjs/components/prism-csharp.js"></script>
    <script src="node_modules/prismjs/components/prism-go.js"></script>
    <script src="node_modules/prismjs/components/prism-py.js"></script>
    <script src="node_modules/prismjs/components/prism-markdown.js"></script>
    <script src="trumbowyg/dist/plugins/highlight/trumbowyg.highlight.min.js"></script>
    <script src="trumbowyg/dist/plugins/history/trumbowyg.history.min.js"></script>
    <script src="trumbowyg/dist/plugins/noembed/trumbowyg.noembed.min.js"></script>
    <script src="trumbowyg/dist/plugins/pasteimage/trumbowyg.pasteimage.min.js"></script>
    <script src="//rawcdn.githack.com/RickStrahl/jquery-resizable/0.35/dist/jquery-resizable.min.js"></script>
    <!-- Import Trumbowyg plugins... -->
    <script src="trumbowyg/dist/plugins/resizimg/trumbowyg.resizimg.min.js"></script>


    <?php



    include_once("db.php");
    session_start();
    if (isset($_SESSION['user'])) {
        if (isset($_POST['title'])) {

            $text = "";
            $title = "";

            $text = $_POST["data"];
            $title = $conn->real_escape_string(htmlspecialchars($_POST["title"]));
            $user = $_SESSION['userPK'];


            if ($text == NULL || $title == NULL) {
                echo "veuillez ajouter un titre et un text !";
            }

            $sql = "INSERT INTO aj_articles (title, content, USER_FK) VALUES ('$title', '$text', '$user')";
            if (mysqli_query($conn, $sql)) {

            







                header('Location: .?page=home');

            } else {
                echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
            }

        }


    } else {
        header('Location: .?page=connection');
    }
    $conn->close();


    ?>

    <script>
        function send() {

            var text = $('#editor').trumbowyg('html');


            document.getElementById('data').value = text



        }

    </script>



            <form action="editeur.php" method="post">
                <input class="inte" type="text" placeholder="Titre" id="titre" name="title">
                <input type="hidden" name="data" id="data" name="data">
                <div id='editor'>

                </div>
                <input class="bouton" type="image" src="postbutt.png" onclick="send()">


            </form>

            <script>

                $('#editor')
                    .trumbowyg({
                        lang: 'fr',
                        btnsDef: {
                            // Create a new dropdown
                            image: {
                                dropdown: ['insertImage', 'base64'],
                                ico: 'insertImage'
                            }
                        },

                        imageWidthModalEdit: true,

                        plugins: {
                            resizimg: {
                                minSize: 64,
                                step: 16,
                            },
                            giphy: {
                                apiKey: 'uECTk05V8DMIBicyOqc1gddsNooXiGGT'
                            }
                        },

                        // Redefine the button pane
                        btns: [

                            ['historyUndo', 'historyRedo'],
                            ['formatting'],
                            ['undo', 'redo'],
                            ['strong', 'em', 'del'],
                            ['superscript', 'subscript'],
                            ['link'],
                            ['image'], // Our fresh created dropdown
                            ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                            ['foreColor', 'backColor'],
                            ['fontfamily'],
                            ['fontsize'],
                            ['fontfamily'],
                            ['fontsize'],
                            ['unorderedList', 'orderedList'],
                            ['horizontalRule'],
                            ['removeformat'],
                            ['fullscreen'],
                            ['highlight'],

                            ['giphy']

                        ]
                    });



            </script>




</body>

</html>