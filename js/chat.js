




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
    chatHtml = ""
    
    for (let i = 0; i < data.length; i++) {
      /*
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
