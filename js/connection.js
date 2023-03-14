function show_connection()
{
    document.getElementById("conn_popup").style.display = "block";
    document.getElementById("overlay").style.display = "block";
  
}

function hideConnection()
{
    document.getElementById("conn_popup").style.display = "none";
    document.getElementById("overlay").style.display = "none";
}

document.getElementById("overlay").addEventListener("click", hideConnection);