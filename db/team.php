<?php

include_once 'database.php';
include_once 'user.php';

class Team extends User {

    private $tID;
    private $tName;
    private $password;
    private $description;
    private $leadsLID;
    private $isVerified = false;

    public static function verifyTeam($name, $passwd) {
        $user = GameDB::getInstance()->verifyTeam($name, $passwd);
        self::remember($user);
        return $user;
    }

    public static function getTeam($lID) {
        $db = GameDB::getInstance();
        return $db->getTeam($lID);
    }

    public function __construct($verified, $tID = -1, $tName = '', $passwd = '', $description = '', $leadsLID = -1) {
        $this->isVerified = $verified;
        $this->tID = $tID;
        $this->tName = $tName;
        $this->password = $passwd;
        $this->description = $description;
        $this->leadsLID = $leadsLID;
    }

    public function setTeam($tID, $tName, $passwd, $description, $leadsLID) {
        $this->tID = $tID;
        $this->tName = $tName;
        $this->password = $passwd;
        $this->description = $description;
        $this->leadsLID = $leadsLID;
    }

    public function setTID($tID) {
        $this->tID = $tID;
    }

    public function setTName($tName) {
        $this->tName = $tName;
    }

    public function setPasswd($passwd) {
        $this->password = $passwd;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setLeadsLID($leadsLID) {
        $this->leadsLID = $leadsLID;
    }

    public function getTID() {
        return $this->tID;
    }

    public function getTName() {
        return $this->tName;
    }

    public function getPasswd() {
        return $this->password;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getLeadsLID() {
        return $this->leadsLID;
    }

    public function registerTeam($tName, $passwd, $fLID, $desc="") {
        $db = GameDB::getInstance();
        return $db->registerTeam($tName, $passwd, $desc, $fLID);
    }

    public function updateTeam($tID, $tName, $password, $description) {
        $db = GameDB::getInstance();
        return $db->updateTeam($tID, $tName, $password, $description);
    }

    public function deleteTeam($tID) {
        $db = GameDB::getInstance();
        $db->deleteTeam($tID);
    }

    public function getUserId() {
        return $this->tID;
    }

    public function getUserName() {
        return "Team {$this->tName}";
    }

    public function getUserType() {
        return User::TEAM;
    }

    public function verified() {
        return $this->isVerified;
    }

}

?>
