var liked = false;
var desliked = false;

function ToggleDeslike(postid)
{
    var btn_deslike = document.getElementById("icon-deslike" + postid);
    if(!desliked)
    {
        btn_deslike.className = "bi-x-circle-fill";
        desliked = true;
    }
    else
    {
        btn_deslike.classList = "bi-x-circle";
        desliked = false;
    }
    React(postid, 0);
}

function ToggleLike(postid)
{
    var btn1 = document.getElementById("icon-like" + postid);
    if(!liked)
    {
        btn1.className = "bi-heart-fill";
        
        liked = true;
    }
    else
    {
        btn1.className = "bi-heart";
        liked = false;
    }
    React(postid, 1);
}

const btn_close = document.getElementById("btn_close")
const textarea = document.getElementById("posting")

btn_close.addEventListener('click', function(e){
    if (textarea.value !== '') {
        alert('tem certeza??')
    }
});