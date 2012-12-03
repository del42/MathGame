<?php

class Picture {
    private $picID;
    private $path;
    private $name;
    private $solution;
    
    public function setPicture($picID, $path, $name, $solution) {
        $this->picID = $picID;
        $this->path = $path;
        $this->name = $name;
        $this->solution = $solution;
    }
    
    public function setPicID($picID) {
        $this->picID = $picID;
    }
    
    public function setPath($path) {
        $this->path = $path;
    }
    
    public function setName($name) {
        $this->name = $name;
    }
    
    public function setSolution ($solution) {
        $this->solution = $solution;
    }
    
    public function getPicID(){
        return $this->picID;
    }
    
    public function getPath(){
        return $this->path;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function getSolution(){
        return $this->solution;
    }
}
?>
