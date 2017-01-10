// jQuery Document
$(document).ready(function(){
});

//jQuery Document
$(document).ready(function(){
//If user wants to end session
$("#exit").click(function(){
    var exit = confirm("Are you sure you want to quit QLpronet?");
    if(exit==true){window.location = 'index.php?logout=true';}
});
//AutoScroll chatbox to bottom on load"
$('#chatbox').scrollTop($('#chatbox')[0].scrollHeight);
});

//If user submits the form
$("#submitmsg").click(function(){
    var clientmsg = $("#usermsg").val();
    $.post("post.php", {text: clientmsg});
    $("#usermsg").attr("value", "");
    loadLog;
return false;
});

function loadLog(){
var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
$.ajax({
    url: "log.html",
    cache: false,
    success: function(html){
        $("#chatbox").html(html); //Insert chat log into the #chatbox div

        //Auto-scroll
        var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
        if(newscrollHeight > oldscrollHeight){
            $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
        }
    },
});
}

setInterval (loadLog, 2500);
