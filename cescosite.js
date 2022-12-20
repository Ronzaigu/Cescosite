function coments(articlePK){

    var article = document.getElementById("large_coms" + articlePK);
    if(getComputedStyle(article).display == "none"){
        article.style.display = "block"
    }else{
        article.style.display = "none"
    }




}

function signal(id, title) {
    let sure = prompt("Cette article ne respect pas les règle de CescoSite ? (oui/non)", "non");
    if (sure == "oui") {
    
        location.href = "./signal.php?id=" + id
    }
    
}
/*
function like(PK){
    //window.location.href=window.location.href='like.php?num='+PK
    
    $("#like"+PK).load('like.php?num='+PK).fadeIn("slow");
}

function dislike(PK){
    //window.location.href=window.location.href='dislike.php?num='+PK
    $("#dislike"+PK).load('dislike.php?num='+PK).fadeIn("slow");
}
function neutrelike(PK){
    //window.location.href=window.location.href='neutrelike.php?num='+PK
    $("#neutrelike"+PK).load('neutrelike.php?num='+PK).fadeIn("slow");

}
*********************************/

function reaction(type, PK){

    user_pk = document.getElementById("user_pk").value


    if(user_pk == ''){
        window.location.href = "Connexion.php"
       

    }else{
      //  console.log(type)
    //  window.location.href = 'like.php?num='+PK + "&type="+encodeURIComponent(type)

        $.post("like.php",{
            num : PK,
            type : type
        })
        
        
        $.get('getPosts.php', function(result) {
            $('#pageApi').val(result);
        }).done(loadLike)
    }
   
}


function isMobileDevice() { 
    if( navigator.userAgent.match(/iPhone/i)
    || navigator.userAgent.match(/webOS/i)
    || navigator.userAgent.match(/Android/i)
    || navigator.userAgent.match(/iPad/i)
    || navigator.userAgent.match(/iPod/i)
    || navigator.userAgent.match(/BlackBerry/i)
    || navigator.userAgent.match(/Windows Phone/i)
    ){
       return true;
     }
    else {
       return false;
     }
    }

    

function countLike(Type, likes){
    //"+", data[i].reaction
    let result = 0
 //   console.log(likes.length)
    for (let i = 0; i < Object.keys(likes).length; i++) {
        if(likes["reaction#" + i].type == Type ){
            result ++
            //console.log(likes["reaction#" + i].type )
        }
        
    }
    return result;
}

function isUserLike(Type, userPK, likes){
    //"+", data[i].reaction
    
 //   console.log(likes.length)
    for (let i = 0; i < Object.keys(likes).length; i++) {
        if(likes["reaction#" + i].type == Type ){
            if(likes["reaction#" + i].USER_FK == userPK ){
                return true
            }
        }
        
    }
    return false
}


function loadLike()
{

    data =  JSON.parse(decodeEntity( document.getElementById('pageApi').value ) )
    let nbLike = 0
    let nbNeutre = 0
    let nbDislike = 0
    let scrLike = "upvote_vide.png"
    let scrNeutre = "neutrevote_vide.png"
    let scrDislike = "downvote_vide.png"
    for (let num = 0; num < data.length; num++) {
        scrLike = "upvote_vide.png"
        scrNeutre = "neutrevote_vide.png"
        scrDislike = "downvote_vide.png"
 
        let likeHtml = ""
         nbLike = 0
         nbNeutre = 0
         nbDislike = 0
       

        if(typeof data[num].reaction != "undefined"){

            
            nbLike = countLike( "+", data[num].reaction)
            nbNeutre = countLike( "=", data[num].reaction)
            nbDislike = countLike( "-", data[num].reaction)
            user_pk = document.getElementById("user_pk").value
            if (isUserLike("+", user_pk, data[num].reaction)) {
                scrLike = "upvote_plein.png"
            }
            if (isUserLike("=", user_pk, data[num].reaction)) {
                scrNeutre = "neutrevote_plein.png"
            }
            if (isUserLike("-", user_pk, data[num].reaction)) {
                scrDislike = "downvote_plein.png"
            }
        
        }
       // console.log(scrLike)
        likeHtml += "<button class='like' onclick = 'reaction(\"+\", "+data[num].ARTICLES_PK+")' ><img width =50 src='"+scrLike+"'></button><p>"+nbLike+"</p>"
        likeHtml += "<button class='neutrelike' onclick = 'reaction(\"=\", "+data[num].ARTICLES_PK+")' ><img width =50 src='"+scrNeutre+"'></button><p>"+nbNeutre+"</p>"
        likeHtml += "<button class='dislike' onclick = 'reaction(\"-\", "+data[num].ARTICLES_PK+")' ><img width =50 src='"+scrDislike+"'></button><p>"+nbDislike+"</p>"
        
        

        comEmp = document.getElementById('avi' + data[num].ARTICLES_PK)

        comEmp.innerHTML = likeHtml

    }
  
}



function loadCom()
{
    data =  JSON.parse(decodeEntity( document.getElementById('pageApi').value ) )
    for (let num = 0; num < data.length; num++) {

        let comesHtml =""
        
  

        if(typeof data[num].comments !== 'undefined'){
            for (let ii = 0; ii < Object.keys(data[num].comments).length; ii++) {
                comesHtml += "<section>"
                comesHtml += "<b>_______________________</b><br>" 
                    comesHtml += data[num].comments["com"+ii].content
                    
                    comesHtml += "</section>"
                
            }
        }
        comesHtml += "<b>_______________________</b><br>" 

        comEmp = document.getElementById('com' + data[num].ARTICLES_PK)

        comEmp.innerHTML = comesHtml
    }
}

function loadSite(){
    


    if(document.getElementById('pageApi').value != ""){
        data =  JSON.parse(decodeEntity( document.getElementById('pageApi').value ) )
            

     

            artZone = document.getElementById("artZone")

            articlesHtml = ""

            for (let i = 0; i < data.length; i++) {

                

                articlesHtml += "<section id = art"+i+" class= 'articles'>"
                
                articlesHtml += "<h1>" + data[i].title + "</h1><br>"
                articlesHtml += data[i].content
                
                articlesHtml += "<br><br><strong><i>Article créé par " + data[i].creator + ".    Date : " + data[i].dat + "</strong></i>"

                articlesHtml += "<br>"

                articlesHtml += "<button onclick = 'coments("+data[i].ARTICLES_PK+")' >Commentaires</button>"

                comComtentText=""
                
                if(document.querySelector("#"+'large_coms'+data[i].ARTICLES_PK)){
                    displayType = document.getElementById('large_coms'+data[i].ARTICLES_PK).style.display

                  

                    
                    //console.log(comComtentText)

                }else{
                    displayType = "none"
                }
    
                articlesHtml += "<div style = 'display:"+displayType+"' id = 'large_coms"+data[i].ARTICLES_PK+"'>"
                
                articlesHtml += "<form class='zonetxt' method='post' onsubmit='return sendComData("+data[i].ARTICLES_PK+");'> <textarea class='comText' id='comText"+data[i].ARTICLES_PK+"' name='textC'></textarea>  <input id = 'title"+data[i].ARTICLES_PK+"' name='title'  style='visibility : hidden' value='"+data[i].title+"'> <br> <input class='boutton' type='image' src='send.png' id='submit' alt='submit'> </form>"
            
                articlesHtml += "<div  id = 'com"+data[i].ARTICLES_PK+"'>"

                    //coments here

                articlesHtml += "</div>"

                articlesHtml += "</div>"


                

                //Like here

            
                articlesHtml += "<div class = 'avi' id = 'avi"+data[i].ARTICLES_PK+"'>"

                

                articlesHtml += "</div>"


                articlesHtml += "</section>"

                artZone.innerHTML += articlesHtml
                articlesHtml = ""
             
               
          
                
            }

            



            
    }else{
        
        
    }
}  

   
function decodeEntity(inputStr) {
    var textarea = document.createElement("textarea");
    textarea.innerHTML = inputStr;
    return textarea.value;
}

function sendComData(a_pk)
{
    user_pk = document.getElementById("user_pk").value


    if(user_pk == ''){
        window.location.href = "Connexion.php"
       

    }else{


    var comcontent = document.getElementById("comText" + a_pk).value;


    var titlee = document.getElementById("title" + a_pk).value;




        $.post("coment.php",{
            textC:comcontent,

            articlePK:a_pk,

            title:titlee

        })



        $.get('getPosts.php', function(result) {
            $('#pageApi').val(result);
        }).done(loadCom)

        document.getElementById("comText" + a_pk).value =""
        
        return false
    }
}



    

$.get('getPosts.php', function(result) {
    $('#pageApi').val(result);
}).done(loadSite, loadLike, loadCom)






var auto_refresh = setInterval(
    
    function (){

        $.get('getPosts.php', function(result) {
            $('#pageApi').val(result);
        }).done(loadLike(), loadCom())
    
    }, 3000);
