<?php
include_once 'db/gameEngine.php';
include_once 'db/user.php';

$user=User::current();

$team=$user->getUserName();
$leaderId =  $user->getLeadsLID();

echo GameEngine::markPuzzleSolved($leaderId, $team);

?>
