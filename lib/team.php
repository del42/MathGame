<?php

class Team {
    private $tID;
    private $tName;
    private $password;
    private $description;
    private $leadsLID;
    
    public function setTeam($tID, $tName, $passwd, $description, $leadsLID){
        $this->tID = $tID;
        $this->tName = $tName;
        $this->password = $passwd;
        $this->description = $description;
        $this->leadsLID = $leadsLID;
    }
    
    public function setTID($tID){
        $this->tID = $tID;
    }
    
    public function setTName($tName){
        $this->tName = $tName;
    }
    
    public function setPasswd($passwd){
        $this->password = $passwd;
    }
    
    public function setDescription($description){
        $this->description = $description;
    }
    
    public function setLeadsLID($leadsLID){
        $this->leadsLID = $leadsLID;
    }
    
    public function getTID(){
        return $this->tID;
    }
    
    public function getTName(){
        return $this->tName;
    }
    
    public function getPasswd(){
        return $this->password;
    }
    
    public function getDescription(){
        return $this->description;
    }
    
    public function getLeadsLID(){
        return $this->leadsLID;
    }
    
}
?>
