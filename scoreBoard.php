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
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/master.css" />
        <link href="css/style.css"	rel="stylesheet" type="text/css" media="screen" />
        <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="js/tabs.js"></script>
        <!-- <script type="text/javascript" src="js/script.js"></script>-->
    </head>
    <body>
        <div id="container">
            <?php showHeader($user);  ?>        
            <div id="content">
                <div id="middleBar">
                    <br/><font size="4" face="cursive" color="blue" >Score Board</font>
                    <br/><br/><br/><br/>
                    <div class="htmltabs">
                        <ul class="tabs">
                            <li class="tab1">
                                <a class="tab1 tab">
                                    School	
                                </a>
                            </li>
                            <li class="tab2">
                                <a class="tab2 tab">
                                    Team 
                                </a>
                            </li>
                        </ul>
                        <div class="tab1 tabsContent">
                            <div>Personal content goes here!</div>
                        </div>
                        <div class="tab2 tabsContent">
                            <div>Team content goes here!</div>
                        </div>
                    </div>
                </div>
            </div>
        
        <?php include_once 'footer.php'; ?>
            </div>
</body>
</html>
