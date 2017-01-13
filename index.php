<?php
  // Join Form
  session_start ();
  function loginForm() {
      echo '
     <div id="loginform">
     <form action="index.php" method="post">
         <label for="name">Account:</label>
         <input type="text" name="name" id="name" autocomplete="off" />
         <input type="submit" name="enter" id="enter" value="Enter" />
     </form>
     </div>
     ';
  }

  if (isset ( $_POST ['enter'] )) {
      // Join Message
      if ($_POST ['name'] != "") {
          $_SESSION ['name'] = stripslashes ( htmlspecialchars ( $_POST ['name'] ) );
          $fp = fopen ( "php/log.html", 'a' );
          fwrite ( $fp, "<div class='msgln'><i><span style='color:gold'>" . $_SESSION ['name'] . "</span> <span style='color:#33bbff'>has joined QLpronet.</span></i><br></div>");
          fclose ( $fp );
      } else {
          echo '<span class="error">Enter Account Name</span>';
      }
  }

  if (isset ( $_GET ['logout'] )) {

      // Exit message
      $fp = fopen ( "php/log.html", 'a' );
      fwrite ( $fp, "<div class='msgln'><i><span style='color:gold'>" . $_SESSION ['name'] . "</span> <span style='color:#33bbff'> has left QLpronet.</span></i><br></div>" );
      fclose ( $fp );

      session_destroy ();
      header ( "Location: index.php" ); // Redirect the user
  }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>QLpronet</title>
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
          <a href="profiles/profile.html"><h3>PROFILE</h3><a>
        </div>

      </div>

    </div>

  </div>

  <!--container for chat and side tabs-->
  <div class="container">

    <?php
    if (! isset ( $_SESSION ['name'] )) {
        loginForm ();
    } else {
    ?>

    <!--chat-->
    <div class="chat">

      <div class ="channel">
        <a href ="Channels/clanPage.html">Channel</a>
      </div>

      <div class= "channelname">
        <h3>Clan MacroLyf <span style="color:gold">(</span>4<span style="color:gold">)</span></h3>
      </div>

      <!-- Wrapper for Chat-->
      <div class="chatwindow">

        <div class="channelwelcome">
          <h5 id="welcome" style="color:teal">Welcome to QLpronet! there are currently 20 people connected</h5>
        </div>

        <div id="chatbox">

            <?php
            if (file_exists ( "php/log.html" ) && filesize ( "php/log.html" ) > 0) {
                $handle = fopen ( "php/log.html", "r" );
                $contents = fread ( $handle, filesize ( "php/log.html" ) );
                fclose ( $handle );

                echo $contents;
            }
            ?>

          </div>

        <form name="message" action="">
            <input name="usermsg" type="text" id="usermsg" size="63" autocomplete="off" />
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
            <p class="name">MUN</p>
            <p class="clanname">CHAMP</p>
          </li>
          <li>
            <img src="images/avatars/wcg.jpg">
            <p class="level">47</p>
            <p class="name"><?php echo $_SESSION ['name']; ?></p>
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

<script src="js/profilescript.js"></script>
<script type="text/javascript"
    src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<script src="js/sessionscript.js"></script>
<?php
}
?>
</body>

</html>
