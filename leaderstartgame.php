<?php
include_once 'header.php';

if (isset($_GET['user'])) {
    $user = $_GET['user'];
} else {
    $user = "1";
}
?>
<html>
    <head>
    <title>MaThMaGic</title>
    <style type="text/css" media="all">@import "css/master.css";</style>
    </head>
    <body>
    <div id="container">
        <?php showHeader($user);?>
        <div id="content">
            <div id="leftBar">
                <img src="images/mg.png" width="200" height="300" />
            </div>
            <div id="rightBar">
                <div id="helpDescription">
                    <textarea rows="12" cols="28" id="help"> </textarea>
                </div>
                <div id="startGame" class="startGame">
                    <input name="startGame" value="Start Game" type="submit"/>
                </div>
            </div>
        </div>
        <?php include_once 'footer.php'; ?>
    </div>
    </body>
</html>