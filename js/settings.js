function show_settings()
{
    document.getElementById("settings_popup").style.display = "block";
    document.getElementById("overlay").style.display = "block";
  
}

function hideSettings()
{
    document.getElementById("settings_popup").style.display = "none";
    document.getElementById("overlay").style.display = "none";
}

document.getElementById("overlay").addEventListener("click", hideSettings);