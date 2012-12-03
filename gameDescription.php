<?php
require_once 'db/user.php';
require_once 'header.php';

$user = User::current();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="js/header.js"></script>
        <link rel="stylesheet" type="text/css" href="css/master.css" />
        <script type="text/javascript">
            var selectedId = "#gameDesc";
        </script>
        <style type ="text/css">
            #info {padding:1em; text-align: justify;}
            #step {padding-left: 1em; }
            h4 {margin-top: 0px; padding-top: 1em;}
        </style>
        <title>Game Description</title>

    </head>
    <body>
        <div id="container">
            <?php showHeader($user); ?>
            <div id="content">
                <div id="middleBar">
                    <h4>Game Rules:</h4>
                    <div id ="info">
                    The game consists of a picture hidden by a grid-like structure, which is unveiled 
                        through solving math puzzles. 
                    
                        When the game starts, an encoded sequence of letters is displayed for the students to solve.
                  
                    <p> The decoding process requires four steps: <br/> 
                    <p id="step"> 1. The encoded sequence is transformed into a sequence of numbers by changing each letter into its place in the alphabet (i.e. a=1, b=2, etc.). <br/><br/>  
                        2. The sequence of numbers must be modified by a uniform linear manipulation, e.g. y=3x+4 will change x=1 into y=7, x=2 into y=10, etc. <br/> <br/>
                        3. The new sequence of numbers is transferred back into letters using the position of each in the alphabet (i.e. 1=a, 2=b, ... 26=z, 27=a, 28=b, etc).<br/> <br/>
                        4. Once the sequence is recognizable in English, its author must be determined.</p>
                    </p>
                    <p>
                       Once the string is decoded, a random cell is unveiled and players will get another puzzle.
                </div>
                </div>
            </div>
            <?php include_once 'footer.php'; ?>
        </div>
    </body>
</html>
