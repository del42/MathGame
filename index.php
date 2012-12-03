<?php
require_once 'header.php';
require_once 'db/team.php';
require_once 'db/user.php';
require_once 'db/leader.php';
include_once 'db/puzzle.php';

$NUM_ROWS = Puzzle::getRows();
$NUM_COLUMNS = Puzzle::getColumns();
$CELL_WIDTH = 30;
$CELL_HEIGHT = 30;

$user = User::current();
if( $user->verified() ){
    header("Location: gamePage.php");
}

?>
<!DOCTYPE html>
<html>
    <head>
<!-- Google Website Optimizer Control Script -->
<script>
function utmx_section(){}function utmx(){}
(function(){var k='2216661799',d=document,l=d.location,c=d.cookie;function f(n){
if(c){var i=c.indexOf(n+'=');if(i>-1){var j=c.indexOf(';',i);return escape(c.substring(i+n.
length+1,j<0?c.length:j))}}}var x=f('__utmx'),xx=f('__utmxx'),h=l.hash;
d.write('<sc'+'ript src="'+
'http'+(l.protocol=='https:'?'s://ssl':'://www')+'.google-analytics.com'
+'/siteopt.js?v=1&utmxkey='+k+'&utmx='+(x?x:'')+'&utmxx='+(xx?xx:'')+'&utmxtime='
+new Date().valueOf()+(h?'&utmxhash='+escape(h.substr(1)):'')+
'" type="text/javascript" charset="utf-8"></sc'+'ript>')})();
</script><script>utmx("url",'A/B');</script>
<!-- End of Google Website Optimizer Control Script -->
<!-- Google Website Optimizer Tracking Script -->
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['gwo._setAccount', 'UA-32991668-1']);
  _gaq.push(['gwo._trackPageview', '/2216661799/test']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<!-- End of Google Website Optimizer Tracking Script -->
        <title>MathMagic</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="js/header.js"></script>
        <script type="text/javascript" src="js/index.js"></script>
        <link rel="stylesheet" href="css/index.css" type="text/css" media="all" />
        <link rel="stylesheet" type="text/css" href="css/master.css" />
        <script type="text/javascript">
            var showAnimation = true;
            var selectedId = "#home";
            var numOfColumns = <?= $NUM_COLUMNS ?>;
            var numOfRows=<?= $NUM_ROWS ?>;
        </script>

    </head>
    <body>
        <div id="container">
            <?php showHeader($user); ?>
            <div id="content">
                <div id="leftBar">
                    <table class="puzzleTable">
                        <?php
                        for ($i = 0; $i < $NUM_ROWS; $i++) {
                            echo '<tr>';
                            for ($j = 0; $j < $NUM_COLUMNS; $j++) {
                                echo "<td id='cell{$i}{$j}' style='width: {$CELL_WIDTH}px; height: {$CELL_HEIGHT}px'></td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                    </table>
                </div>
                <div id="rightBar" style="text-align: left; direction: none;">
                    <div class="description" id="description">
                        <p class="demo">
                            MaThMaGic is a web-based multiplayer gaming application that provides a
                            collaborative and competitive platform for high school students to improve their math skills.
                            Students of each high school should play the game concurrently and collaboratively to compete
                            against the students from other high schools.
                        </p>
                        <button id="buttonDemo" class="demo">See Demo</button>
                    </div>
                    <div class="showDemo" id="showDemo">
                        <label id="process" class="process">Step</label><br/>
                        <label id="hint" class="hint"></label><br/>
                        <textarea id="question" class="answer" rows="3" readonly="readonly" style="color: black; top: 100px">Vq dg qt pqv vq dg</textarea><br/>
                        <textarea id="answer" class="answer" rows="3" readonly="readonly"></textarea>
                        <textarea id="answer1" class="answer" rows="3"  readonly="readonly" ></textarea>
                        <textarea id="answer2" class="answer" rows="3"  readonly="readonly" ></textarea>
                        <textarea id="answer3" class="answer" rows="3"  readonly="readonly" ></textarea>
                        <button id="next" class="next" onclick="showNext()" style="position: relative; top: 205px;">Next</button>
                    </div>
                </div>
            </div>
            <?php include_once 'footer.php'; ?>
        </div>
    </body>
</html>