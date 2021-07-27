function show()
{
    document.getElementById('sidebar').classList.toggle('active');
    document.getElementById('openMenu').style.visibility = "hidden";
}

function hide()
{
    document.getElementById('sidebar').classList.remove('active');
    document.getElementById('openMenu').style.visibility = "visible";
}