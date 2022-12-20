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
  $('#mess').load('chatAPI.php').fadeIn("slow")
  return false;
}


$('#mess').load('chatAPI.php').fadeIn("slow")
var auto_refresh = setInterval(
    
    function (){
        $('#mess').load('chatAPI.php').fadeIn("slow");}, 3000);

