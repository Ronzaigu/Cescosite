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
        window.location.href = "?page=connection"
       

    }else{
      
    //  window.location.href = 'like.php?num='+PK + "&type="+encodeURIComponent(type)

        $.post("like.php",{
            num : PK,
            type : type
        })
        
        
        $.get('getPosts.php?PK=' + PK, function(result) {
            data =  JSON.parse(decodeEntity(result))
            $('#pageApi').val(JSON.stringify( data));
            loadLike(PK)
            console.log("ASDwqdqwe")
        })
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

    dataL =  JSON.parse( document.getElementById('pageApi').value) 

 
   
    

    let nbLike = 0
    let nbNeutre = 0
    let nbDislike = 0
    let scrLike = "upvote_vide.png"
    let scrNeutre = "neutrevote_vide.png"
    let scrDislike = "downvote_vide.png"

    let likeHtml = ""
 


        if(typeof dataL.reaction != "undefined"){

            
            nbLike = countLike( "+", dataL.reaction)
            nbNeutre = countLike( "=", dataL.reaction)
            nbDislike = countLike( "-", dataL.reaction)
            user_pk = document.getElementById("user_pk").value
            if (isUserLike("+", user_pk, dataL.reaction)) {
                scrLike = "upvote_plein.png"
            }
            if (isUserLike("=", user_pk, dataL.reaction)) {
                scrNeutre = "neutrevote_plein.png"
            }
            if (isUserLike("-", user_pk, dataL.reaction)) {
                scrDislike = "downvote_plein.png"
            }
        
        }
       // console.log(scrLike)
        likeHtml += "<button class='like' onclick = 'reaction(\"+\", "+dataL.ARTICLES_PK+")' ><img width =50 src='"+scrLike+"'></button><p>"+nbLike+"</p>"
        likeHtml += "<button class='neutrelike' onclick = 'reaction(\"=\", "+dataL.ARTICLES_PK+")' ><img width =50 src='"+scrNeutre+"'></button><p>"+nbNeutre+"</p>"
        likeHtml += "<button class='dislike' onclick = 'reaction(\"-\", "+dataL.ARTICLES_PK+")' ><img width =50 src='"+scrDislike+"'></button><p>"+nbDislike+"</p>"
        
        

        comEmp = document.getElementById('avi' + dataL.ARTICLES_PK)

        comEmp.innerHTML = likeHtml

    
  
}



function loadCom(pk)
{
    console.log("b")
    let dataC =  JSON.parse( document.getElementById('pageApi').value) 


        let comesHtml =""
        
     
  

        if(typeof dataC.comments !== 'undefined'){
            for (let ii = 0; ii < Object.keys(dataC.comments).length; ii++) {
                comesHtml += "<section>"
                comesHtml += "<b>_______________________</b><br>" 
                    comesHtml += dataC.comments["com"+ii].content
                    
                    comesHtml += "</section>"
                
            }
        }
        comesHtml += "<b>_______________________</b><br>" 

        comEmp = document.getElementById('com' +dataC.ARTICLES_PK)

        comEmp.innerHTML = comesHtml
    
}

function loadSite(){
    


  
        let dataS =  JSON.parse( document.getElementById('pageApi').value)
        
     
     

            artZone = document.getElementById("artZone")

            articlesHtml = ""


    pk= dataS.ARTICLES_PK
                

                articlesHtml += "<section id = art"+pk+" class= 'articles'>"
                
                articlesHtml += "<h1>" + dataS.title + "</h1><br>"
                articlesHtml += dataS.content
                
                articlesHtml += "<br><br><strong><i>Article créé par " + dataS.creator + ".    Date : " + dataS.dat + "</strong></i>"

                articlesHtml += "<br>"

                articlesHtml += "<button onclick = 'coments("+pk+")' >&dArr;Commentaires&dArr;</button>"
                articlesHtml += "<button onclick = 'signal("+pk+")' >Signaler</button>"

                comComtentText=""
                
                if(document.querySelector("#"+'large_coms'+pk)){
                    displayType = document.getElementById('large_coms'+pk).style.display

                  

                    
                    //console.log(comComtentText)

                }else{
                    displayType = "none"
                }
    
                articlesHtml += "<div style = 'display:"+displayType+"' id = 'large_coms"+pk+"'>"
                
                articlesHtml += "<form class='zonetxt' method='post' onsubmit='return sendComData("+pk+");'> <textarea class='comText' id='comText"+pk+"' name='textC'></textarea>  <input id = 'title"+pk+"' name='title'  style='visibility : hidden' value='"+dataS.title+"'> <br> <input class='boutton' type='image' src='send.png' id='submit' alt='submit'> </form>"
            
                articlesHtml += "<div  id = 'com"+pk+"'>"

                    //coments here

                articlesHtml += "</div>"

                articlesHtml += "</div>"


                

                //Like here

            
                articlesHtml += "<div class = 'avi' id = 'avi"+pk+"'>"

                

                articlesHtml += "</div>"


                articlesHtml += "</section>"

                artZone.innerHTML += articlesHtml
                
             
               
          
                

}  

   
function decodeEntity(inputStr) {
    var textarea = document.createElement("textarea");
    textarea.innerHTML = inputStr;
    return textarea.value;
}

function sendComData(a_pk)
{
    console.log("a")
    user_pk = document.getElementById("user_pk").value


    if(user_pk == ''){
        window.location.href = "?page=connection"
       

    }else{


    var comcontent = document.getElementById("comText" + a_pk).value;


    var titlee = document.getElementById("title" + a_pk).value;




        $.post("coment.php",{
            textC:comcontent,

            articlePK:a_pk,

            title:titlee

        })



     
        $.get('getPosts.php?PK=' + a_pk, function(result) {
            data =  JSON.parse(decodeEntity(result))
            $('#pageApi').val(JSON.stringify( data));
            loadCom(a_pk)
            document.getElementById("comText" + a_pk).value =""
        })


      
        
        
        return false
    }
}



    /*

$.get('getPosts.php', function(result) {
    $('#pageApi').val(result);
}).done(loadSite, loadLike, loadCom)

*/

$.get('getPosts.php',false , function(result) {

    
    data =  JSON.parse(decodeEntity(result))
    for (let i = 0; i < data.length; i++) {
   
   
        $('#pageApi').val(JSON.stringify( data[i]));
    
        loadSite()
        loadLike()
        loadCom()
    }

    
})

/*
data =  JSON.parse(decodeEntity( document.getElementById('pageApi').value ) )

for (let i = 0; i < data.length; i++) {
    loadSite(data[i].ARTICLES_PK)
    loadLike(data[i].ARTICLES_PK)
    loadCom(data[i].ARTICLES_PK)
    
}*/