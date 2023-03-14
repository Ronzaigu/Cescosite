<!DOCTYPE html>
<html id='all'>

<head>
        <title>CescoSite</title>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Cescosite : Site de publication d'article pour Cescole.">
        <link rel="stylesheet" href="./css/cescosite.css" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Import prismjs stylesheet -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.13.0/themes/prism.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/plugins/line-highlight/prism-line-highlight.min.css">
        <link rel="stylesheet" href="trumbowyg/dist/ui/trumbowyg.min.css">
        
        <!-- Import highlight plugin specific stylesheet -->
        <link rel="stylesheet" href="trumbowyg/dist/plugins/highlight/ui/trumbowyg.highlight.min.css">        
</head>

<body>


<br><br><br>
<script>
        
        if(window.location.pathname != "/cescosite/"){
                window.location.href = ".?page=home"
        }

</script>
<div class="chat_post_commentary">
        
        <!-- <h1 class="post_big_title">CHAT/h1> -->

        <article class="chat" id="chat_space">
        
                <div class = "chatjs" id = "chatjs">
                        <p class="wait_message">Veuillez patienter....</p>
                </div>

                <div id="chat_input" class="input_bottom">
                        <div class="chat_bottom">
                        <input type="text" name="send" id='chatContent' class="send_chat_input" placeholder="Envoyez un message">
                <div>
                <button onclick="sendChatData()" class="send_chat_button"><p class="send_text">></p></button>

                </div></div>

        </article>       


        <!-- <h1 class="post_big_title">POST</h1> -->

            



        <br>

                <select id="range" hidden>
                        <option value="more_likes">Le plus liké</option>
                        <option value="more_times">Le plus récent</option>
                        <option value="random">Aléatoire</option>
             
                </select> 



                <br>
                <div id ='artZone' class="post">



                </div>
                <article class="coms" id='coms'>
                <div class = "chatjs" id = "comsjs">
                        <p class="wait_message">Veuillez patienter....</p>
                </div>
                <div class="input_bottom">
                <div class="chat_bottom">
                <input type="text" name="send" id='comsContent' name='textC' class="send_chat_input" placeholder="Envoyez un commentaire">
                <div>
                <button id='sendComButton' class="send_chat_button"><p class="send_text">></p></button>
                </div></div>



        </article>   


                <script src="./js/chat.js"></script>
        </div>
</div>
<br>
<br>
       


        <footer>

                <p class="fake_copyright">ⓒ 2022 - AsterJdM production</p>



                <script src="./js/cescosite.js"></script>


                <input style="visibility: hidden;" type="text" id='user_pk' value=<?php 
                      
                                echo $_SESSION['userPK'];
                       
                         
                
                ?>>
        </footer>
</body>
<!-- -->
</html>

