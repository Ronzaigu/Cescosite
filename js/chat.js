




function sendChatData()
{
  user_pk = document.getElementById("user_pk").value


  if(user_pk == ''){
      window.location.href = "?page=connection"
     

  }else{
    let chatcontent = document.getElementById("chatContent").value;


    $.ajax({
      type: 'post',
      url: 'chat.php',
      data: {
    
          text:chatcontent
      },
      
    });


    document.getElementById("chatContent").value = ""
    $.get('getChat.php', function(result) {
      $('#chatData').val(result);
  }).done(loadChat)


    return false;
  }
}

function decodeEntity(inputStr) {
  var textarea = document.createElement("textarea");
  textarea.innerHTML = inputStr;
  return textarea.value;
}

function loadChat(data){
    
   
    data = JSON.parse(decodeEntity(data));
    let chatHtml = ""
    for (let i = 0; i < data.length; i++) {
   //   console.log(data[i])
      chatHtml += '<div class="hight_chat">';
          chatHtml += '<button class="chat_profile"></button>'
          chatHtml += '<div class="user_date_chat">'
          chatHtml += '<p class="chat_user">'+data[i].creator+'</p>'
              chatHtml += '<p class="chat_date">'+ data[i].dat +'</p>'


        chatHtml += "</div><br>"
      chatHtml += '</div>'

      chatHtml += '<p class="chat_text">'+data[i].content+'</p>'
      chatHtml += '<div class="line"></div> '
      chatHtml += '<div class="jépludidé"></div>'
   
      /*chat
      chatHtml += "<strong>" + data[i].creator + "</strong>" + "    " + "<em>" + data[i].dat + "</em>";
      chatHtml+= "<br>";
      chatHtml += "<p>" + data[i].content + "</p>" + "<br>" + "<b>_________________________________________________</b>" + "<br>";
      */
    }

    
    document.getElementById("chatjs").innerHTML = chatHtml
}

function getCloudChatData(){
  return $.get('getChat.php',true)
}


$.when(getCloudChatData()).done(function (result) {
  loadChat(result)
})


var auto_refresh = setInterval(
    
  function (){

    $.when(getCloudChatData()).done(function (result) {
     
      loadChat(result)
    })
    

   
  
  }, 3000);
