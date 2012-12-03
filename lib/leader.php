<?php

class Leader {
    private $lID;
    private $email;
    private $password;
    private $firstName;
    private $lastName;
    private $title;
    private $hasLeaderSID;
    
    public function setLeader ($lID, $email, $passwd, $fName, $lName, $title, $SID) {
        $this->lID = $lID;
        $this->email = $email;
        $this->password = $passwd;
        $this->firstName = $fName;
        $this->lastName = $lName;
        $this->title = $title;
        $this->hasLeaderSID = $SID;
    }
    
    public function setlID ($lID) {
         $this->lID = $lID;
    }
    
    public function setEmail($email) {
         $this->email = $email;  
    }
    
    public function setPasswd($passwd) {
        $this->password = $passwd;
    }
    
    public function setFName($fName) {
        $this->firstName = $fName;
    }
    
    public function setLName($lName) {
        $this->lastName = $lName;
    }
    
    public function setTitle($title) {
        $this->title = $title;
    }

    public function setSID ($SID) {
        $this->hasLeaderSID = $SID;
    }
    
    public function getlID () {
         return $this->lID;
    }
    
    public function getEmail() {
         return $this->email;  
    }
    
    public function getPasswd() {
        return $this->password;
    }
    
    public function getFName() {
        return $this->firstName;
    }
    
    public function getLName() {
        return $this->lastName;
    }
    
    public function getTitle() {
        return $this->title;
    }

    public function getSID () {
        return $this->hasLeaderSID;
    }
    
    
}
?>
