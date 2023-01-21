
   
function decodeEntity(inputStr) {
    var textarea = document.createElement("textarea");
    textarea.innerHTML = inputStr;
    return textarea.value;
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

function getCloudData(){
    return $.get('getPosts.php',true)
}

function reaction(type, PK){

    $.get('getPosts.php',true)


    user_pk = document.getElementById("user_pk").value


    if(user_pk == ''){
        window.location.href = "Connexion.php"
       

    }else{
      
    //  window.location.href = 'like.php?num='+PK + "&type="+encodeURIComponent(type)

        $.post("like.php",{
            num : PK,
            type : type
        })
        /*
        
        $.get('getPosts.php',true , function(result) {

    
            data =  JSON.parse(decodeEntity(result))

            updateLikes(data[Object.keys(data).find(key => data[key].ARTICLES_PK == PK)])
            
        
            
        })
        
        */

        $.when(getCloudData()).done(function (result) {
            data =  JSON.parse(decodeEntity(result))

            updateLikes(data[Object.keys(data).find(key => data[key].ARTICLES_PK == PK)])
         });
        
    }
}


function updateLikes(article){

    console.log(article)
    pk = article.ARTICLES_PK


      
        let nbLike = 0
        let nbNeutre = 0
        let nbDislike = 0
        let scrLike = "upvote_vide.png"
        let scrNeutre = "neutrevote_vide.png"
        let scrDislike = "downvote_vide.png"



            if(typeof article.reaction != "undefined"){

                
                nbLike = countLike( "+", article.reaction)
                nbNeutre = countLike( "=", article.reaction)
                nbDislike = countLike( "-", article.reaction)
                user_pk = document.getElementById("user_pk").value
                if (isUserLike("+", user_pk, article.reaction)) {
                    scrLike = "upvote_plein.png"
                }
                if (isUserLike("=", user_pk, article.reaction)) {
                    scrNeutre = "neutrevote_plein.png"
                }
                if (isUserLike("-", user_pk, article.reaction)) {
                    scrDislike = "downvote_plein.png"
                }
            
            }
            console.log("imgLike" + pk)
            document.getElementById("imgLike" + pk).src = scrLike
            document.getElementById("imgDislike" + pk).src = scrDislike
            document.getElementById("imgNeutrelike" + pk).src = scrNeutre

            console.log("LikeP" + pk)
            document.getElementById("LikeP" + pk).innerHTML = nbLike
            document.getElementById("NeutreP" + pk).innerHTML = nbNeutre
            document.getElementById("DislikeP" + pk).innerHTML = nbDislike


    
        

    
}

function coments(articlePK){

    var article = document.getElementById("large_coms" + articlePK);
    if(getComputedStyle(article).display == "none"){
        article.style.display = "block"
    }else{
        article.style.display = "none"
    }




}

function sendComData(a_pk)
{


    console.log("a")
    user_pk = document.getElementById("user_pk").value


    if(user_pk == ''){
        window.location.href = "Connexion.php"
       

    }else{


    var comcontent = document.getElementById("comText" + a_pk).value;


    var titlee = document.getElementById("title" + a_pk).value;




   


    $.ajax({
        type: 'post',
        url: 'coment.php',
        data: {
            textC:comcontent,
            articlePK:a_pk,
            title:titlee
        },
        success: function(response) {
            getCloudData().then(function (result) {
                let i = Object.keys(data).find(key => data[key].ARTICLES_PK == a_pk)
                data =  JSON.parse(decodeEntity(result))
                loadCom(data[i].comments, data[i].ARTICLES_PK)
            });
        }
    });
    
        
     
    }
}


function signal(id, title) {
    let sure = prompt("Cette article ne respect pas les règle de CescoSite ? (oui/non)", "non");
    if (sure == "oui") {
    
        location.href = "./signal.php?id=" + id
    }
    
}

function loadCom(coments, pk)
{
   



        let comesHtml =""
        
        console.log(coments)
  

        if(typeof coments != 'undefined'){
            for (let ii = 0; ii < Object.keys(coments).length; ii++) {
                comesHtml += "<section>"
                comesHtml += "<b>_______________________</b><br>" 
                    comesHtml += coments["com"+ii].content
                    
                    comesHtml += "</section>"
                
            }
        }
        comesHtml += "<b>_______________________</b><br>" 

        comEmp = document.getElementById('com' +pk)

        comEmp.innerHTML = comesHtml
    
}


function loadPost(index, data){
    console.log(index)

    article = data[index]
    pk = article.ARTICLES_PK



    let articlesHtml = ""

    articlesHtml += "<section id = art"+pk+" class= 'articles'>"
                
    articlesHtml += "<h1>" + article.title + "</h1><br>"
    articlesHtml += article.content
    
    articlesHtml += "<br><br><strong><i>Article créé par " + article.creator + ".    Date : " + article.dat + "</strong></i>"

    articlesHtml += "<br>"

    articlesHtml += "<button onclick = 'coments("+pk+")' >&dArr;Commentaires&dArr;</button>"
    articlesHtml += "<button onclick = 'signal("+pk+")' >Signaler</button>"



    articlesHtml += "<div style = 'display:none' id = 'large_coms"+pk+"'>"
    
    articlesHtml += "<form class='zonetxt' id='comment-form' method='post' id='comForm'> <textarea class='comText' id='comText"+pk+"' name='textC'></textarea>  <input id = 'title"+pk+"' name='title'  style='visibility : hidden' value='"+article.title+"'> <br> <input class='boutton' type='submit' src='send.png' id='submit' alt='submit'> </form>"

    articlesHtml += "<div  id = 'com"+pk+"'>"

        //coments here

    articlesHtml += "</div>"

    articlesHtml += "</div>"


    

        

    articlesHtml += "<div class = 'avi' id = 'avi"+pk+"'>"

        let nbLike = 0
        let nbNeutre = 0
        let nbDislike = 0
        let scrLike = "upvote_vide.png"
        let scrNeutre = "neutrevote_vide.png"
        let scrDislike = "downvote_vide.png"



            if(typeof article.reaction != "undefined"){

                
                nbLike = countLike( "+", article.reaction)
                nbNeutre = countLike( "=", article.reaction)
                nbDislike = countLike( "-", article.reaction)
                user_pk = document.getElementById("user_pk").value
                if (isUserLike("+", user_pk, article.reaction)) {
                    scrLike = "upvote_plein.png"
                }
                if (isUserLike("=", user_pk, article.reaction)) {
                    scrNeutre = "neutrevote_plein.png"
                }
                if (isUserLike("-", user_pk, article.reaction)) {
                    scrDislike = "downvote_plein.png"
                }
            
            }
        // console.log(scrLike)
            articlesHtml += "<button class='like' onclick = 'reaction(\"+\", "+pk+")' ><img id='imgLike" + pk + "' width =50 src='"+scrLike+"'></button><p id=LikeP"+pk+" >"+nbLike+"</p>"
            articlesHtml += "<button class='neutrelike' onclick = 'reaction(\"=\", "+pk+")' ><img id='imgNeutrelike" + pk + "'width =50 src='"+scrNeutre+"'></button><p id=NeutreP"+pk+" >"+nbNeutre+"</p>"
            articlesHtml += "<button class='dislike' onclick = 'reaction(\"-\", "+pk+")' ><img id='imgDislike" + pk + "' width =50 src='"+scrDislike+"'></button><p id=DislikeP"+pk+" >"+nbDislike+"</p>"
            


    articlesHtml += "</div>"


    articlesHtml += "</section>"

    artZone.innerHTML += articlesHtml
    



}



$.when(getCloudData()).done(function (result) {
    data =  JSON.parse(decodeEntity(result))
    for (let i = 0; i < data.length; i++) {
   
   
        loadPost(i, data)
        loadCom(data[i].comments, data[i].ARTICLES_PK)
    
        
    }
 });


 $("#comForm").submit(function(event){
    var a_pk = 168
    var comcontent = document.getElementById("comText" + a_pk).value;


    var titlee = document.getElementById("title" + a_pk).value;

    event.preventDefault(); // Empêche la soumission normale du formulaire
    $.ajax({
        type: 'post',
        url: 'coment.php',
        data: {
            textC:comcontent,
            articlePK:a_pk,
            title:titlee
        },
        success: function(response) {
          /*  getCloudData().then(function (result) {
                let i = Object.keys(data).find(key => data[key].ARTICLES_PK == a_pk)
                data =  JSON.parse(decodeEntity(result))
                loadCom(data[i].comments, data[i].ARTICLES_PK)
            });*/
        }
    });
});
