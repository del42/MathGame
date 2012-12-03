<?php

include_once 'db/database.php';
include_once 'db/user.php';

class Leader extends User {

    private $lID;
    private $email;
    private $password;
    private $firstName;
    private $lastName;
    private $title;
    private $hasLeaderSID;
    private $isVerified;

    public static function verifyLeader($email, $passwd) {
        $user = GameDB::getInstance()->verifyLeader($email, $passwd);
        User::remember($user);
        return $user;
    }

    public static function getLeader($lID) {
        $db = GameDB::getInstance();
        return $db->getLeader($lID);
    }

    public function __construct($isVerified, $lID = -1, $email = null, $passwd = null, $fName = null, $lName = null, $title = null, $SID = -1) {
        $this->isVerified = $isVerified;
        $this->lID = $lID;
        $this->email = $email;
        $this->password = $passwd;
        $this->firstName = $fName;
        $this->lastName = $lName;
        $this->title = $title;
        $this->hasLeaderSID = $SID;
    }

    public function setLeader($lID, $email, $passwd, $fName, $lName, $title, $SID) {
        $this->lID = $lID;
        $this->email = $email;
        $this->password = $passwd;
        $this->firstName = $fName;
        $this->lastName = $lName;
        $this->title = $title;
        $this->hasLeaderSID = $SID;
    }

    public function setlID($lID) {
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

    public function setSID($SID) {
        $this->hasLeaderSID = $SID;
    }

    public function getlID() {
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

    public function getSID() {
        return $this->hasLeaderSID;
    }

    public static function registerLeader($fName, $lName, $title, $email, $passwd, $sName, $city = null, $state = null) {
        $db = GameDB::getInstance();
        $result = $db->registerLeader($fName, $lName, $title, $email, $passwd, $sName, $city, $state);
        if ($result) {
            self::verifyLeader($email, $passwd);
        }
        return $result;
    }

    public function updateLeader($lID, $fName, $lName, $title, $email, $passwd) {
        $db = GameDB::getInstance();
        $db->updateLeader($lID, $fName, $lName, $title, $email, $passwd);
    }

    public function deleteLeader($lID) {
        $db = GameDB::getInstance();
        $db->deleteLeader($lID);
    }

    public function getUserId() {
        return $this->lID;
    }

    public function getUserName() {
        return "Leader {$this->firstName} {$this->lastName}";
    }

    public function getUserType() {
        return User::LEADER;
    }

    public function verified() {
        return $this->isVerified;
    }

}

?>
