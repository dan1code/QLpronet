<?php
session_start();
if(isset($_SESSION['name'])){
    $text = $_POST['text'];

    $fp = fopen("log.html", 'a');
    fwrite($fp, "<div class='msgln'><b><span style='color:gold'>".$_SESSION['name']."</span></b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
    fclose($fp);
}
?>
