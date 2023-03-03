




function sendChatData()
{
  
  var chatcontent = document.getElementById("chatContent").value;

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

function decodeEntity(inputStr) {
  var textarea = document.createElement("textarea");
  textarea.innerHTML = inputStr;
  return textarea.value;
}

function loadChat(){
    data = JSON.parse(decodeEntity(document.getElementById("chatData").value))
   
    var chatHtml = ''
    
    for (let i = 0; i < data.length; i++) {
      chatHtml += '<div class="hight_chat">';
          chatHtml += '<button class="chat_profile"></button>'
          chatHtml += '<div class="user_date_chat">'
              chatHtml += '<p class="chat_user">'+data[i].creator+'</p>'
              chatHtml = '<p class="chat_date">01.01.2001</p>'


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


    document.getElementById("mess").innerHTML = chatHtml
}


$.get('getChat.php', function(result) {
  $('#chatData').val(result);
}).done(loadChat)

var auto_refresh = setInterval(
    
  function (){

    $.get('getChat.php', function(result) {
      $('#chatData').val(result);
    }).done(loadChat)
    
  
  }, 3000);
