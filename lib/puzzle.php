<?php

class Puzzle{
    private $pID;
    private $quote;
    private $author;
    
    public function setPuzzle($pID, $quote, $author){
        $this->pID = $pID;
        $this->quote = $quote;
        $this->author = $author;
    }
    
    public function setPID($pID){
        $this->pID = $pID;
    }
    
    public function setQuote($quote){
        $this->quote = $quote;
    }
    
    public function setAuthor($author){
        $this->author = $author;
    }
    
    public function getPID(){
        return $this->pID;
    }
    
    public function getQuote(){
        return $this->quote;
    }
    
    public function getAuthor(){
        return $this-> author;
    }
}
?>
