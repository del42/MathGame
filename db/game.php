<?php

class Game {
    private $gID;
    private $score;
    
    
    public function newGame() {
        $db = GameDB::getInstance();
        return $db -> newGame();
    }
    
    public function setGame($gID, $score) {
        $this->gID = $gID;
        $this->score =$score;
    }
    
    public function setGID($gID) {
        $this->gID = $gID;
    }
    
    public function setScore($score) {
        $this->score = $score;
    }
    
    public function getGID() {
        return $this->gID;
    }
    
    public function getScore() {
        return $this->score;
    }
    
    public function getGame($gID) {
        $db = GameDB::getInstance();
        return $db -> getGame($gID);
    }
    
    public function startGame($gID, $picID, $pID, $sID){
        $db = GameDB::getInstance();
        $db -> startGame($gID, $picID, $pID, $sID);
    }
}
?>
