<?php

include_once 'database.php';

class Puzzle {

    const NUM_COLUMNS = 7;
    const NUM_ROWS = 7;

    private $pID;
    private $quote;
    private $author;

    public function __construct($pID, $quote, $author) {
        $this->pID = $pID;
        $this->quote = $quote;
        $this->author = $author;
    }

    public static function getPuzzle($randomID) {
        return GameDB::getInstance()->getPuzzle($randomID);
    }

    public static function getRandomPuzzle() {
        return GameDB::getInstance()->getRandomPuzzle();
    }

    public static function getRandomPuzzleId() {
        return GameDB::getInstance()->getRandomPuzzleId();
    }

    public static function getRows(){
        return self::NUM_ROWS;
    }
    
    public static function getColumns(){
        return self::NUM_COLUMNS;
    }
    
    public function setPuzzle($pID, $quote, $author) {
        $this->pID = $pID;
        $this->quote = $quote;
        $this->author = $author;
    }

    public function setPID($pID) {
        $this->pID = $pID;
    }

    public function setQuote($quote) {
        $this->quote = $quote;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function getPID() {
        return $this->pID;
    }

    public function getQuote() {
        return $this->quote;
    }

    public function getAuthor() {
        return $this->author;
    }

}

?>
