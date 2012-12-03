<?php

include_once 'db/user.php';
include_once 'db/gameEngine.php';
include_once 'db/puzzle.php';

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Connection: keep-alive');

$user = User::current();

if ($user->getUserType() == User::LEADER) {
    $leaderId = $user->getlID();
    updateLeader($leaderId);
} else {
    $leaderId = $user->getLeadsLID();
    updateTeam($leaderId);
}

function updateLeader($leaderId) {
    while (true) {
        $gameEngine = GameEngine::getInstance($leaderId);
        if ($gameEngine) {
            updateGameEngine($leaderId, $gameEngine);
        } else {
            $puzzleId = Puzzle::getRandomPuzzleId();
            $cellId = getIdArrayFromSession();
            GameEngine::insertGameEngine($leaderId, $puzzleId, $cellId);
            sendMessageToLeader("", $puzzleId, 1, $cellId, 0, 0, "art");
        }

        usleep(300000);
    }
}

function updateTeam($leaderId) {
    while (true) {
        $gameEngine = GameEngine::getInstance($leaderId);
        if ($gameEngine) {
            $pictureSolved = $gameEngine->getPictureSolved();
            if ($pictureSolved) {
                $pictureSolvedBy = $gameEngine->getPictureSolvedBy();
                sendMessageToTeam(1, 1, 1, 11, $pictureSolved, $pictureSolvedBy);
                return;
            }

            $puzzleCount = $gameEngine->getPuzzleCount();
            if (!isset($_SESSION['currentPuzzle']) || $_SESSION['currentPuzzle'] != $puzzleCount) {
                $_SESSION['currentPuzzle'] = $puzzleCount;
                $cellId = $gameEngine->getCellId();
                $puzzleId = $gameEngine->getPuzzleId();
                $puzzleCount = $gameEngine->getPuzzleCount();
                $pictureSolved = $gameEngine->getPictureSolved();
                $pictureSolvedBy = $gameEngine->getPictureSolvedBy();
                sendMessageToTeam(1, $puzzleCount, $puzzleId, $cellId, $pictureSolved, $pictureSolvedBy);
            }
        } else {
            sendMessageToTeam(0, 1, 1, 11, 0, "");
        }
        usleep(300000);
    }
}

function sendMessageToLeader($puzzleSolvedBy, $puzzleId, $currentQuestion, $cellId, $solved, $pictureSolved, $pictureSolvedBy) {
    echo "event: updateLeader\n";
    echo 'data: {"solved":' . $solved . ', "team":"' . $puzzleSolvedBy . '", "puzzleId":' . $puzzleId . ', "currentQuestion":' . $currentQuestion . ', "cellId":' . $cellId . ', "pictureSolved":' . $pictureSolved . ', "pictureSolvedBy":"' . $pictureSolvedBy . '"}';
    echo "\n\n";
    ob_flush();
    flush();
}

function sendMessageToTeam($leaderSignIn, $currentQuestion, $puzzleId, $cellId, $pictureSolved, $pictureSolvedBy) {
    echo "event: updateTeam\n";
    echo 'data: {"leader":' . $leaderSignIn . ', "currentQuestion":' . $currentQuestion . ', "puzzleId":'
    . $puzzleId . ', "cellId":' . $cellId . ', "pictureSolved":' . $pictureSolved . ', "pictureSolvedBy":"' . $pictureSolvedBy . '"}';
    echo "\n\n";
    ob_flush();
    flush();
}

/**
 * If the puzzle is solved, update leader with message of the team that solved the puzzle,
 * new puzzleId, and new cellId, and new question number
 * @param type $leaderId
 * @param type $gameEngine 
 */
function updateGameEngine($leaderId, $gameEngine) {
    $pictureSolved = $gameEngine->getPictureSolved();
    if ($pictureSolved) {
        $team = $gameEngine->getPuzzleSolvedBy();
        $cellId = getIdArrayFromSession();
        $currentQuestion = $gameEngine->getPuzzleCount() + 1;
        $puzzleId = Puzzle::getRandomPuzzleId();
        $pictureSolvedBy = $gameEngine->getPictureSolvedBy();
        sendMessageToLeader($team, $puzzleId, $currentQuestion, $cellId, 0, $pictureSolved, $pictureSolvedBy);
        // Wait until teams receive message;
        usleep(300000);
        GameEngine::resetGame($leaderId, $puzzleId, $cellId);
        return;
    }

    $solved = $gameEngine->getSolved();
    if ($solved) {
        $team = $gameEngine->getPuzzleSolvedBy();
        $cellId = getIdArrayFromSession();
        $currentQuestion = $gameEngine->getPuzzleCount() + 1;
        $puzzleId = Puzzle::getRandomPuzzleId();
        sendMessageToLeader($team, $puzzleId, $currentQuestion, $cellId, $solved, $pictureSolved, "");
        GameEngine::updateGameEngine($leaderId, $puzzleId, $cellId);
    }
}

function getIdArrayFromSession() {
    if (!isset($_SESSION['ids'])) {
        $_SESSION['ids'] = createCellIdArray();
    }
    return getRandomCellId($_SESSION['ids']);
}

function createCellIdArray() {
    $rows = Puzzle::getRows();
    $columns = Puzzle::getColumns();
    $array = array();
    for ($i = 0; $i < $rows; $i++) {
        for ($j = 0; $j < $columns; $j++) {
            array_push($array, $i * 10 + $j);
        }
    }
    return $array;
}

function getRandomCellId($array) {
    shuffle($array);
    return array_pop($array);
}

?>