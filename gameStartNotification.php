<?php
include_once 'header.php';
include_once 'db/user.php';

$user = User::current();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/master.css" />
        <script type="text/javascript" src="js/header.js"></script>
        <title>game start</title>
    </head>
    <body>
        <div id="container">
            <?php showHeader($user) ?>
            <div id="content">
                <div id="middleBar">
                    <p>Game already started. Sign in is not allowed at this point, please inform your leader.</p>
                </div>
            </div>
            <?php include_once 'footer.php'; ?>
        </div>

    </body>
</html>
