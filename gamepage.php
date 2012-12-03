<?php
include_once 'header.php';
include_once 'db/user.php';
include_once 'db/puzzle.php';
include_once 'db/gameEngine.php';

$NUM_COLUMNS = Puzzle::getColumns();
$NUM_ROWS = Puzzle::getRows();
$CELL_WIDTH = 30;
$CELL_HEIGHT = 30;

$user = User::current();

if (!$user->verified()) {
    header("Location: index.php");
}

//delete old data from game engine if it existes
if ($user->getUserType() === User::LEADER) {
    $leaderId = $user->getlID();
    GameEngine::checkGameEngineExist($leaderId);
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>MathMagic</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/master.css" />
        <link rel="stylesheet" href="css/index.css" type="text/css" media="all" />
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="js/header.js"></script>
        <script type="text/javascript" src="js/timer.js"></script>
        <script type="text/javascript" src="js/index.js"></script>
        <script type="text/javascript" >
            var selectedId = "#home";
            var showAnimation = false;
            var isGameMode=true;
            var numOfColumns = <?= $NUM_COLUMNS ?>;
            var numOfRows=<?= $NUM_ROWS ?>;  
            var userType=<?= $user->getUserType(); ?>
        </script>
    </head>
    <body>
        <div id="container">
            <?php showHeader($user); ?>

            <div id="content">
                <div id="leftBar">
                    <table class="puzzleTable" style="margin-top: 50px;">
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
                    <div class="image" id="guessImage">
                        <label id="imageQuestion" class="imageQuestion">The name of this picture? <span style="color:red;"></span></label><br>
                        <input type="text" class="imageAnswer" id="imageAnswer" onchange="clearErrorMessage()">
                        <input type="submit" class="imageSubmit" id="imageSubmit" value="submit" onclick="verifyPictureName(); return false;">
                    </div>
                </div>
                <div id="rightBar" style="text-align: left; direction: none;">
                    <?php
                    if ($user->getUserType() == User::LEADER) {
                        ?>
                        <div class="leaderHome">
                            <label>Teams(Signin):</label>
                            <p id="signinTeam">Math</p>
                            <label>Current Question:</label>
                            <p id="currentQuestion">Questions</p>
                            <label>Team solved last problem:</label>
                            <p id="lastProblemTeam"></p>
                            <button id="startGame" class="startGame" onclick="startGame(); return false">Start Game</button>
                        </div>
                    <?php } else { ?>
                        <div class="showDemo" id="teamMessage" >
                            <p id="waitMessage">Wait for your leader to show up...</p>
                        </div>
                        <div class="showDemo" id="team" style="margin-top: 50px; display: none">
                            <form>
                                <label id="timer" class="process" style="font-size: 16px"></label><br/>
                                <label id="hint" class="hint" ></label>Find the famous quote and its author<br/>
                                <textarea id="question" class="answer" rows="3" readonly="readonly" style="top: 70px; color:black;"></textarea><br/>
                                <label class="quote" id="labelQuote">What is the quote? <span style="color:red;"></span></label><br>
                                <textarea id="answer" class="answer" rows="3" placeholder="quote?" style="top: 170px; color: black;"></textarea>
                                <label class="author" id="labelAuthor">Who is the author? <span style="color:red;"></span></label><br>
                                <input id="author" name="author" type="text" placeholder="author?">
                                <!--                                <button id="skip" class="next" style="margin-left: 10px" onclick="skipQuestion(); return false;">Skip</button>-->
                                <input id="answerSubmit" class="next" type="submit" value="submit" onclick="verifyAnswer(); return false">
                            </form>
                        </div>
                    <?php } ?>
                </div>

            </div>
            <?php include_once 'footer.php'; ?>
        </div>
    </body>
</html>
