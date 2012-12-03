<?php

include_once 'database.php';

class GameEngine {

    private $leaderId;
    private $cellId;
    private $pictureId;
    private $puzzleId;
    private $puzzleCount;
    private $puzzleSolvedBy;
    private $solved;
    private $pictureSolved;
    private $pictureSolvedBy;

    public function __construct($leaderID, $cellId, $puzzleId, $puzzleCount, $puzzleSolvedBy, 
            $solved, $pictureSolved, $pictureSolvedBy, $pictureId = 0) {
        $this->leaderId = $leaderID;
        $this->pictureId = $pictureId;
        $this->cellId = $cellId;
        $this->puzzleId = $puzzleId;
        $this->puzzleCount = $puzzleCount;
        $this->puzzleSolvedBy = $puzzleSolvedBy;
        $this->solved = $solved;
        $this->pictureSolved = $pictureSolved;
        $this->pictureSolvedBy = $pictureSolvedBy;
    }

    public static function getInstance($leaderId) {
        return GameDB::getInstance()->getGameEngine($leaderId);
    }

    public static function removeGameEngine($leaderId) {
        return GameDB::getInstance()->removeGameEngine($leaderId);
    }

    public static function insertGameEngine($leaderId, $puzzleId, $cellId) {
        return GameDB::getInstance()->insertGameEngine($leaderId, $puzzleId, $cellId);
    }

    public static function updateGameEngine($leaderId, $puzzleId, $cellId){
        return GameDB::getInstance()->updateGameEngine($leaderId, $cellId, $puzzleId);
    }
    
    public static function isPuzzleSolved($leaderId){
        return GameDB::getInstance()->isPuzzleSolved($leaderId);
    }
    
    public static function markPuzzleSolved($leaderId, $team){
        return GameDB::getInstance()->markPuzzleSolved($leaderId, $team);
    }
    
    public static function markPictureSolved($leaderId, $team){
        return GameDB::getInstance()->markPictureSolved($leaderId, $team);
    }
    
    public static function resetGame($leaderId, $puzzleId, $cellId){
        return GameDB::getInstance()->resetGame($leaderId, $puzzleId, $cellId);
    }
    
    /**
     * Check whether or not the table is already exist in database, if it does, remove it.
     * @param type $leaderId 
     */
    public static function checkGameEngineExist($leaderId){
        return GameDB::getInstance()->checkGameEngineExist($leaderId);
    }
    
    /**
     * Check whether or not game is already started, won't allow team to login.
     * @param type $leaderId 
     */
    public static function checkGameStart($leaderId){
        return GameDb::getInstance()->checkGameStart($leaderId);
    }
    public function getLeaderId() {
        return $this->leaderId;
    }

    public function getCellId() {
        return $this->cellId;
    }

    public function getPuzzleId() {
        return $this->puzzleId;
    }

    public function getPictureId() {
        return $this->pictureId;
    }

    public function getPuzzleCount() {
        return $this->puzzleCount;
    }

    public function getPuzzleSolvedBy() {
        return $this->puzzleSolvedBy;
    }
    
    public function getSolved(){
        return $this->solved;
    }
    
    public function getPictureSolved(){
        return $this->pictureSolved;
    }
    
    public function getPictureSolvedBy(){
        return $this->pictureSolvedBy;
    }
}

?>
