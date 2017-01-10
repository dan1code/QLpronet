<?php
session_start ();
function loginForm() {
    echo '
   <div id="loginform">
   <form action="index.php" method="post">
       <p>Please enter your name to continue:</p>
       <label for="name">Name:</label>
       <input type="text" name="name" id="name" />
       <input type="submit" name="enter" id="enter" value="Enter" />
   </form>
   </div>
   ';
}

if (isset ( $_POST ['enter'] )) {
    if ($_POST ['name'] != "") {
        $_SESSION ['name'] = stripslashes ( htmlspecialchars ( $_POST ['name'] ) );
        $fp = fopen ( "log.html", 'a' );
        fwrite ( $fp, "<div class='msgln'><i>User " . $_SESSION ['name'] . " has joined the chat session.</i><br></div>" );
        fclose ( $fp );
    } else {
        echo '<span class="error">Please type in a name</span>';
    }
}

if (isset ( $_GET ['logout'] )) {

    // Simple exit message
    $fp = fopen ( "log.html", 'a' );
    fwrite ( $fp, "<div class='msgln'><i>User " . $_SESSION ['name'] . " has left the chat session.</i><br></div>" );
    fclose ( $fp );

    session_destroy ();
    header ( "Location: index.php" ); // Redirect the user
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>QLPnet</title>
  <link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>
  <!--header-->
  <div class="header">
    <img src="images/banner.jpg">
  </div>

  <!--nav-->
  <div class="nav">
    <!--buttons-->
    <div class="containerbtn">

      <!--1stbtns-->
      <div class="playbtn">

        <div id="playgame">
          <h3>Play Game</h3>
        </div>

        <div id="quick">
          <img src="images/quickplay.jpg">
        </div>

      </div>

      <!--2ndbtns-->
      <div class="custombtn">

        <div id="at">
          <img src="images/at.jpg">
        </div>

        <div id="custom">
          <h3>CUSTOM</h3>
        </div>

      </div>

      <!--3rdbtns-->
      <div class="tournamentbtn">

        <div id="tournament">
          <img src="images/trophy.jpg">
        </div>

        <div id="ladder">
          <img src="images/ladder.jpg">
        </div>

        <div id="profile">
          <h3>PROFILE</h3>
        </div>

      </div>

    </div>

  </div>

  <!--container-->
  <div class="container">

    <!--chat-->
    <div class="chat">

      <div class ="channel">
        <a href ="Channels/clanPage.html">Channel</a>
      </div>

      <div class= "channelname">
        <h3>Clan MacroLyf <span style="color:gold">(</span>4<span style="color:gold">)</span></h3>
      </div>

      <div class="chatwindow"> <!--acts as wrapper-->

        <?php
        if (! isset ( $_SESSION ['name'] )) {
            loginForm ();
        } else {
        ?>

        <div id="chatbox">
            <p class="welcome">
                Welcome, <b><?php echo $_SESSION['name']; ?></b>
            </p>

            <?php
            if (file_exists ( "log.html" ) && filesize ( "log.html" ) > 0) {
                $handle = fopen ( "log.html", "r" );
                $contents = fread ( $handle, filesize ( "log.html" ) );
                fclose ( $handle );

                echo $contents;
            }
            ?>

          </div>

        <form name="message" action="">
            <input name="usermsg" type="text" id="usermsg" size="63" />
            <input name="submitmsg" type="submit" id="submitmsg" value="Send" />
        </form>

      </div>
    </div>

    <!--profile-->
    <div class="profile">

        <ul class="tab">
          <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'Channel')" id="defaultOpen">Channel</a></li>
          <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'Friends')" id="lipadding">Friends</a></li>
          <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'Clan')">Clan</a></li>
        </ul>

      <!--Channel Tab-->
      <div id="Channel" class="tabcontent">
        <ul>
          <li class="Leader">
            <img src="images/avatars/beast.jpg">
            <p class="level">42</p>
            <p class="name">Grubby</p>
            <p class="clanname">MACRO</p>
          </li>
          <li>
            <img src="images/avatars/pleb.jpg">
            <p class="level">42</p>
            <p class="name">Damob</p>
            <p class="clanname">MACRO</p>
          </li>
          <li>
            <img src="images/avatars/pleb2.jpg">
            <p class="level">3</p>
            <p class="name">MONIQUE</p>
            <p class="clanname">CHAMP</p>
          </li>
          <li>
            <img src="images/avatars/wcg.jpg">
            <p class="level">47</p>
            <p class="name">Nodz0r</p>
            <p class="clanname">AUS</p>
          </li>
        </ul>
      </div>

      <!--Friends Tab-->
      <div id="Friends" class="tabcontent">
        <ul>
          <li class="Leader">
            <img src="images/avatars/beast.jpg">
            <p class="name">SomeFag</p>
            <p class="status">Online</p>
          </li>
          <li>
            <img src="images/avatars/pleb.jpg">
            <p class="name">Scrubba</p>
            <p class="status1">Offline</p>
          </li>
          <li>
            <img src="images/avatars/pleb2.jpg">
            <p class="name">Doug</p>
            <p class="status">Online</p>
          </li>
          <li>
            <img src="images/avatars/wcg.jpg">
            <p class="name">Nodz0r</p>
            <p class="status">Online</p>
          </li>
        </ul>
      </div>

      <!--Clan Tab-->
      <div id="Clan" class="tabcontent">
        <div class="clancontainer">
          <h1>Make a Clan</h1>
          <a href="clanPage.html">Create Clan</a>
        </div>
      </div>

    </div>

    <!--exit-->
    <div class="exit">
      <a id ="exit"href ="#">Exit QLpronet</a>
    </div>

  </div>

<script src="profilescript.js"></script>
<script type="text/javascript"
    src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<script type="text/javascript">
// jQuery Document
$(document).ready(function(){
});

//jQuery Document
$(document).ready(function(){
//If user wants to end session
$("#exit").click(function(){
    var exit = confirm("Are you sure you want to end the session?");
    if(exit==true){window.location = 'index.php?logout=true';}
});
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
</script>
<?php
}
?>
<script type="text/javascript"
    src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<script type="text/javascript">
</script>
</body>

</html>
