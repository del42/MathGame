<?php

include_once 'leader.php';
include_once 'school.php';
include_once 'team.php';
include_once 'picture.php';
include_once 'puzzle.php';

class GameDB extends mysqli {

    private static $instance = null;
    private $dbHost = "thecity.sfsu.edu";
    private $dbName = "mathmagic";
    private $username = "mathmagic";
    private $password = "mathmagic";

    /**
     * This function instantiates an instance of the GameDB if it does not already exist.
     * If it exists, it will return the existing instance.
     * @return an instance of GaemDB
     */
    public static function getInstance() {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * This function overrides the __construct() function and connects to the 
     * database as an instance of this class is instantiated.
     * 
     */
    public function __construct() {
        parent::__construct($this->dbHost, $this->username, $this->password, $this->dbName);

        if (mysqli_connect_errno()) {
            exit('Connect Error (' . mysqli_connect_errno() . ')' . mysqli_connect_error());
        }
        parent::set_charset('utf-8');
    }

    public function close() {
        parent::close();
    }

    //-----------------Leader Queries-----------------//

    /**
     * This function stores the information for registeration in the database.
     * It first stores school-related information in School table. Then, it 
     * stores the leader-related in Leader table and use the auto generated id of
     * the School to set the foreign key in the Leader table.
     * @param type $fName First name of the leader
     * @param type $lName Last name of the leader
     * @param type $title Title of the leader at school
     * @param type $email Email of the leader
     * @param type $passwd Password of the leader
     * @param type $sName Name of school    
     * @param type $city name of the city where the school is located
     * @param type $state name of the state where the school is located
     */
    public function registerLeader($fName, $lName, $title, $email, $passwd, $sName, $city, $state ) {
        $querySchool = "Insert into School (sname, city, state)" .
                "Values('" . $sName . "','" . $city . "','" . $state . "');";
        $this->query($querySchool);
        $FSID = $this->insert_id;
        $queryLeader = "Insert into Leader (firstName, lastName, title, email, password, has_leader_SID)" .
                "Values('" . $fName . "','" . $lName . "','" . $title . "','" . $email . "','" . $passwd . "'," . $FSID . ");";        
        $this->query($queryLeader);
        
    }

    /**
     * This function uses the email and password provided by the user to verify 
     * the leader. First. it checks to Leader table to find the username, if it
     * finds the username, it compares the password. If they match, it returns
     * an object  containing all leader-related information. It returns null, if
     * the username does not exist or if the  passwords do not match.
     * @param type $email Email provided by the user when logging in
     * @param type $passwd Password provided by the user when logging in
     * @return Leader an object of the Leader class containg all the information 
     *         of the verified leader. 
     */
    public function verifyLeader($email, $passwd) {
        $queryLeader = "Select password, LID, has_leader_SID, firstName, lastName, title From Leader Where email ='" . $email . "';";
        $result = $this->query($queryLeader);
        if ($result->num_rows > 0) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if ($row['password'] == $passwd) {
                $leader = new Leader();
                $leader->setLeader($row['LID'], $row['email'], $row['password'], $row['firstName'], $row['lastName'], $row['title'], $row['has_leader_SID']);
                return $leader;
            } else {
                return NULL; // wrong password
            }
        } else {
            return NULL; // invalid email
        }
    }

    /**
     * This function retrieves all the information of the leader.
     * @param type $lID 
     * @return Leader 
     */
    public function getLeader($lID) {
        $queryLeader = "Select firstName, lastName, title, has_leader_School, email, password From Leader Where LID =" . $lID . ";";
        $result = $this->query($queryLeader);
        if ($result->num_rows > 0) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $leader = new Leader();
            $leader->setLeader($row['LID'], $row['email'], $row['password'], $row['firstName'], $row['lastName'], $row['title'], $row['has_leader_SID']);
            return $leader;
        } else {
            return NULL;
        }
    }

    /**
     * This function updates the edited information of the leader in the database.
     * @param type $lID LID of the leader whose information should be updated
     * @param type $fName
     * @param type $lName
     * @param type $title
     * @param type $email
     * @param type $passwd 
     */
    public function updateLeader($lID, $fName, $lName, $title, $email, $passwd) {
        $queryLeader = "Update Leader Set firstNAme ='" . $fName . "', lastName ='" . $lName . "', title='"
                . $title . "', email= '" . $email . "', password =" . $passwd . "' Where LID =" . $lID . ";";
        $this->query($queryLeader);
    }

    public function deleteLeader($lID) {
        $queryLeader = "Delete From Leader Where LID=" . $lID . ";";
        $this->query($queryLeader);
    }

    //-----------------School Queries-----------------//
    public function getSchool($sID) {
        $querySchool = "Select sName, city, State From School Where SID =" . $sID . ";";
        $result = $this->query($querySchool);
        if ($result->num_rows > 0) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $school = new School();
            $school->setSchool($row['SID'], $row['sName'], $row['city'], $row['State']);
            return $school;
        } else {
            return -1;
        }
    }

    public function updateSchool($sID, $sName, $city, $state) {
        $querySchool = "Update School Set sName='" . $sName . "', city='" . $city . "', State='" . $state . "' Where SID=" . $sID . ";";
        $this->query($querySchool);
    }

    public function deleteSchool($sID) {
        $querySchool = "Delete From School Where SID=" . $sID . ";";
        $this->query($querySchool);
    }

    //-----------------Team Queries-----------------//
    public function registerTeam($tName, $passwd, $desc, $fLID) {
        $queryTeam = "Insert into Team (tName, password, description, Leads_LID)" .
                "Values ('" . $tName . "','" . $passwd . "','" . $desc . "'," . $fLID . ");";
        $this->query($queryTeam);
    }

    public function verifyTeam($name, $passwd) {
        $queryTeam = "Select password From Team Where tName ='" . $name . "';";
        $result = $this->query($queryTeam);
        if ($result->num_rows > 0) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if ($row['password'] == $passwd) {
                $team = new Team();
                $team->setTeam($row['TID'], $row['tName'], $row['password'], $row['description'], $row['leads_LID']);
                return $team;
            } else {
                return FALSE; // wrong password
            }
        } else {
            return -1; // invalid name
        }
    }

    public function getTeam($lID) {
        $queryTeam = "Select tName, password, description, TID  From Team Where leads_LID=" . $lID . ";";
        $result = $this->query($queryTeam);
        $resultArray = array();
        for ($index = 0; $index < $result ->num_rows; $index++) {
            $row = $result->fetch_array(MYSQLI_ASSOC) ;                
            $team = new Team();
            $team ->setTeam($row['TID'], $row['tName'], $row['password'], $row['description'], $row['leads_LID']);
            $resultArray[$index] = $team;
        }
        
        return $resultArray;
    }

    public function updateTeam($tID, $tName, $password, $description) {
        $queryTeam = "Update Team Set tName = '" . $tName . "', password = '" . $password . "', description ='" . $description . "' Where TID=" . $tID . ";";
        $this->query($queryTeam);
        
    }

    public function deleteTeam($tID) {
        $queryTeam = "Delete From Team Where TID =" . $tID . ";";
        $this->query($queryTeam);
    }

    public function getPicture($randomID) {
        $queryPic = "Select path, solution From Picture Where picID =" . $randomID . ";";
        $result = $this->query($queryPic);
        if ($result->num_rows > 0) {
             $row = $result->fetch_array(MYSQLI_ASSOC);
             $picture = new Picture();
             $picture ->setPicture($row['picID'], $row['path'], $row['name'], $row['solution']);
             return $picture;
        } else {
            return NULL;
        }
    }

    public function getPuzzle($randomID) {
        $queryPuzz = "Select quote, author, solution From Puzzle Where PID =" . $randomID . ";";
        $result = $this->query($queryPuzz);
        if ($result->num_rows > 0) {
             $row = $result->fetch_array(MYSQLI_ASSOC);
             $puzzle = new Puzzle();
             $puzzle ->setPuzzle($row['PID'], $row['quote'], $row['author']);
             return $puzzle;
        } else {
            return NULL;
        }
    }

}

?>
