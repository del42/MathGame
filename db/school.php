<?php
include_once 'database.php';
class School {
    private $sID;
    private $sName;
    private $city;
    private $state;
    
    public function setSchool ($sID,$sName, $city, $state) {
        $this->sID = $sID;
        $this->sName = $sName;
        $this->city = $city;
        $this->state = $state;
    }
    
    public function setSID ($sID) {
         $this->sID = $sID;
    }
    
    
    public function setSName($sName) {
        $this->sName = $sName;
    }
    
    public function setCity($city) {
        $this->city = $city;
    }
    
    public function setState($state) {
        $this->state = $state;
    }

    
    public function getSID () {
         return $this->sID;
    }   
    
    public function getSName() {
        return $this->sName;
    }
    
    public function getCity() {
        return $this->city;
    }
    
    public function getState() {
        return $this->state;
    }
    
    public static function getSchool($sID) {
        $db = GameDB::getInstance();
        return $db -> getSchool($sID);
    }
    
    public function updateSchool($sID, $sName, $city, $state) {
        $db = GameDB::getInstance();
        return $db -> updateSchool($sID, $sName, $city, $state) ;
    }
    
    public function deleteSchool($sID) {
        $db = GameDB::getInstance();
        return $db -> deleteSchool($sID);
    }

}
?>
