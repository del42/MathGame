<?php

include_once 'db/puzzle.php';
include_once 'db/gameLogic.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $puzzle = Puzzle::getPuzzle($id);
    $quote = $puzzle->getQuote();
    $numbers = GameLogic::convertQuote2Number($quote);
    $question = @GameLogic::convertNumber2String($numbers);
    $author = $puzzle->getAuthor();
    echo "{$quote}&{$question}&{$author}";
}
?>
