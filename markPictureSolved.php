<?php

include_once 'db/gameEngine.php';
include_once 'db/user.php';

$user=User::current();

$team=$user->getUserName();
$leaderId =  $user->getLeadsLID();

echo GameEngine::markPictureSolved($leaderId, $team);

//include_once 'db/gameEngine.php';
//
////GameEngine::insertGameEngine(10, 11, 11);
////echo GameEngine::markPuzzleSolved(10, "art");
////echo GameEngine::markPictureSolved(10, "math");
////GameEngine::updateGameEngine(10, 12, 12);
////$gameEngine = GameEngine::getInstance(10);
////echo $gameEngine->getPictureSolved();
////echo "<br>";
////echo $gameEngine->getPictureSolvedBy();
////echo "<br>";
////echo $gameEngine->getSolved();
//GameEngine::resetGame(10, 4, 4);

?>
