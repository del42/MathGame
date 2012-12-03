<?php
include_once 'leader.php';
include_once 'school.php';
include_once 'team.php';
include_once 'picture.php';
include_once 'puzzle.php';
include_once 'game.php';
include_once 'gameEngine.php';
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
    public function registerLeader($fName, $lName, $title, $email, $passwd, $sName, $city = null, $state = NULL) {
        $passwd = md5(trim($passwd));
        $fName = $this->real_escape_string($fName);
        $lName = $this->real_escape_string($lName);
        $title = $this->real_escape_string($title);
        $email = $this->real_escape_string($email);
        $sName = $this->real_escape_string($sName);
        $querySchool = "Insert into School (sname, city, state)" .
                "Values('{$sName}','{$city}','{$state}');";
        $this->query($querySchool);
        $FSID = $this->insert_id;
        $queryLeader = "Insert into Leader (firstName, lastName, title, email, password, has_leader_SID)" .
                "Values('{$fName}','{$lName}','{$title}','{$email}','{$passwd}',{$FSID });";
        return $this->query($queryLeader);
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
        $passwd = md5(trim($passwd));
        $email = $this->real_escape_string($email);
        $queryLeader = "Select password, LID, has_leader_SID, firstName, lastName, title, email From Leader Where email ='" . $email . "';";
        $result = $this->query($queryLeader);
        if ($result->num_rows == 0) {
            return new Leader(false);
        }
        $row = mysqli_fetch_assoc($result);
        if ($row['password'] == $passwd) {
            return new Leader(true, $row['LID'], $row['email'], $row['password'], $row['firstName'], $row['lastName'], $row['title'], $row['has_leader_SID']);
        } else {
            return new Leader(false); // wrong password
        }
    }
    /**
     * This function retrieves all the information of the leader.
     * @param type $lID 
     * @return Leader 
     */
    public function getLeader($lID) {
        $queryLeader = "Select firstName, lastName, title, has_leader_SID, email, password From Leader Where LID ={$lID};";
        $result = $this->query($queryLeader);
        if ($result->num_rows > 0) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $leader = new Leader();
            // TODO: need to be checked
            $leader->setLeader(true, $row['LID'], $row['email'], $row['password'], $row['firstName'], $row['lastName'], $row['title'], $row['has_leader_SID']);
            return $leader;
        } else {
            return new Leader(false);
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
        $fName = $this->real_escape_string($fName);
        $lName = $this->real_escape_string($lName);
        $title = $this->real_escape_string($title);
        $email = $this->real_escape_string($email);
        $passwd = md5(trim($passwd));
        $queryLeader = "Update Leader Set firstNAme ='{$fName}', lastName ='{$lName}', title='{$title}', email= '{$email}', password ={$passwd}' Where LID ={$lID};";
        return $this->query($queryLeader);
    }
    public function deleteLeader($lID) {
        $queryLeader = "Delete From Leader Where LID={$lID};";
        return $this->query($queryLeader);
    }
    //-----------------School Queries-----------------//
    public function getSchool($sID) {
        $querySchool = "Select sName, city, State, SID From School Where SID ={$sID};";
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
        $sName = $this->real_escape_string($sName);
        $city = $this->real_escape_string($city);
        $state = $this->real_escape_string($state);
        $querySchool = "Update School Set sName='{$sName}', city='{$city}', State='{$state}' Where SID={$sID};";
        return $this->query($querySchool);
    }
    public function deleteSchool($sID) {
        $querySchool = "Delete From School Where SID={$sID};";
        return $this->query($querySchool);
    }
    //-----------------Team Queries-----------------//
    public function registerTeam($tName, $passwd, $desc, $fLID) {
        $tName = $this->real_escape_string($tName);
        $desc = $this->real_escape_string($desc);
        $passwd = md5(trim($passwd));
        $queryTeam = "Insert into Team (tName, password, description, Leads_LID)" .
                "Values ('{$tName}','{$passwd}','{$desc}',{$fLID});";
        return $this->query($queryTeam);
    }
    public function verifyTeam($name, $passwd) {
        $passwd = md5(trim($passwd));
        $name = $this->real_escape_string($name);
        $queryTeam = "Select * From Team Where tName ='{$name}';";
        $result = $this->query($queryTeam);
        if ($result->num_rows == 0) {
            return new Team(false);
        }
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($row['password'] == $passwd) {
            return new Team(true, $row['TID'], $row['tName'], $row['password'], $row['description'], $row['leads_LID']);
        } else {
            return new Team(false); // wrong password
        }
    }
    public function getTeam($lID) {
        $queryTeam = "Select tName, password, description, TID  From Team Where leads_LID=" . $lID . ";";
        $result = $this->query($queryTeam);
        $resultArray = array();
        for ($index = 0; $index < $result->num_rows; $index++) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $team = new Team(true,$row['TID'], $row['tName'], $row['password'], $row['description'], $row['leads_LID']);
            $resultArray[$index] = $team;
        }

        return $resultArray;
    }
    public function updateTeam($tID, $tName, $password, $description) {
        $tName = $this->real_escape_string($tName);
        $description = $this->real_escape_string($description);
        $password = md5(trim($password));
        $queryTeam = "Update Team Set tName = '{$tName}', password = '{$password}', description ='{$description}' Where TID={$tID};";
        return $this->query($queryTeam);
    }
    public function deleteTeam($tID) {
        $queryTeam = "Delete From Team Where TID ={$tID};";
        return $this->query($queryTeam);
    }
    public function getPicture($randomID) {
        $queryPic = "Select * From Picture Where picID ={$randomID};";
        $result = $this->query($queryPic);
        if ($result->num_rows > 0) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $picture = new Picture();
            $picture->setPicture($row['picID'], $row['path'], $row['name'], $row['solution']);
            return $picture;
        } else {
            return NULL;
        }
    }
    public function getPuzzle($randomID) {
        $queryPuzz = "Select PID, quote, author, solution From Puzzle Where PID ={$randomID};";
        $result = $this->query($queryPuzz);
        if ($result->num_rows > 0) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            return new Puzzle($row['PID'], $row['quote'], $row['author']);
        } else {
            return NULL;
        }
    }
    public function getRandomPuzzle() {
        $result = $this->query("Select * From Puzzle order by rand() limit 1");
        $row = $result->fetch_array(MYSQLI_ASSOC);
        return new Puzzle($row['PID'], $row['quote'], $row['author']);
    }
    public function getRandomPuzzleId() {
        $result = $this->query("Select PID From Puzzle order by rand() limit 1");
        $row = $result->fetch_array(MYSQLI_ASSOC);
        return $row['PID'];
    }
    public function newGame() {
        $queryGame = "Insert into Game(score) Values (0);";
        $this->query($queryGame);
        return $this->insert_id;
    }
    public function getGame($gID) {
        $queryGame = "Select * From Game Where GID = '{$gID}';";
        $result = $this->query($queryGame);
        if ($result->num_rows > 0) {
            $row = $this->fetch_array(MYSQLI_ASSOC);
            $game = new game();
            $game->setGame($row['GID'], $row['score']);
            return $game;
        } else {
            return NULL;
        }
    }
    public function startGame($gID, $picID, $pID, $sID) {
        $q1 = "Insert into Has-Picture (GID, picID)" .
                "Values ('" . $gID . "','" . $picID . "';";
        $q2 = "Insert into Has-Puzzle (GID, pID)" .
                "Values ('" . $gID . "','" . $pID . "';";
        $q3 = "Insert into Played_By (GID, SID)" .
                "Values ('" . $gID . "','" . $sID . "';";
        $this->query($q1);
        $this->query($q2);
        $this->query($q3);
    }
    
    //////////////////////////////////////////////////////////
    // Game Engine
    //////////////////////////////////////////////////////////
    
    public function getGameEngine($leaderId) {
        $query = "SELECT cell_id, puzzle_id, puzzle_count, puzzle_solved_by, solved, picture_solved, picture_solved_by from Game_Engine Where leader_id={$leaderId} LOCK IN SHARE MODE";
        $result = $this->query($query);
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            return new GameEngine($leaderId, $row['cell_id'],
                            $row['puzzle_id'], $row['puzzle_count'], $row['puzzle_solved_by'], $row['solved'], 
                            $row['picture_solved'], $row['picture_solved_by']);
        } else {
            return false;
        }
    }
    public function removeGameEngine($leaderId) {
        $query = "DELETE FROM Game_Engine WHERE leader_id={$leaderId}";
        return $this->query($query);
    }
    public function insertGameEngine($leaderId, $puzzleId, $cellId, $puzzleCount = 1) {
        $query = "insert into Game_Engine (leader_id, cell_id, puzzle_id, puzzle_count, puzzle_solved_by, picture_solved_by) VALUES " .
                "({$leaderId}, {$cellId}, {$puzzleId}, {$puzzleCount}, '', '')";
        $result = $this->query($query);
        if ($result) {
            //$leaderID, $cellId, $puzzleId, $puzzleCount, $puzzleSolvedBy, 
            // $solved, $pictureSolved, $pictureSolvedBy, $pictureId = 0
            return new GameEngine($leaderId, $cellId, $puzzleId, $puzzleCount, "", 0, 0, "");
        } else {
            return false;
        }
    }
    public function updateGameEngine($leaderId, $cellId, $puzzleId) {
        $query = "UPDATE Game_Engine SET cell_id={$cellId}, puzzle_id={$puzzleId}, puzzle_count=puzzle_count+1, solved=0 WHERE leader_id={$leaderId}";
        return $this->query($query);
    }
    
    public function resetGame($leaderId, $cellId, $puzzleId){
       $query = "UPDATE Game_Engine SET cell_id={$cellId}, puzzle_id={$puzzleId}, puzzle_count=1, solved=0, puzzle_solved_by='', picture_solved=0 WHERE leader_id={$leaderId}";
       return $this->query($query);
    }
    
    public function markPuzzleSolved($leaderId, $team) {
        $query  = "START TRANSACTION"; 
        $query1 = "SELECT solved, puzzle_solved_by FROM Game_Engine WHERE leader_id={$leaderId} LIMIT 1 FOR UPDATE" ;
        $query2 = "UPDATE Game_Engine SET solved=1, puzzle_solved_by='{$team}' WHERE leader_id={$leaderId}"; 
        $query3 = "COMMIT";
        $this->query($query);
        $this->query($query1);
        $result = $this->query($query2);
        $this->query($query3);
        return $result;
    }
    
    public function markPictureSolved($leaderId, $team){
        $query  = "START TRANSACTION"; 
        $query1 = "SELECT picture_solved, picture_solved_by FROM Game_Engine WHERE leader_id={$leaderId} LIMIT 1 FOR UPDATE" ;
        $query2 = "UPDATE Game_Engine SET picture_solved=1, picture_solved_by='{$team}' WHERE leader_id={$leaderId}"; 
        $query3 = "COMMIT";
        $this->query($query);
        $this->query($query1);
        $result = $this->query($query2);
        $this->query($query3);
        return $result;
    }
    
    public function isPuzzleSolved($leaderId) {
        $query = "SELECT solved FROM Game_Engine WHERE leader_id={$leaderId}";
        $result = $this->query($query);
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row['solved'];
        } else {
            return 0;
        }
    }
    public function checkGameEngineExist($leaderId){
        $query = "SELECT cell_id FROM Game_Engine WHERE leader_id={$leaderId}";
        $result = $this->query($query);
        if( $result->num_rows > 0 ){
            return $this->removeGameEngine($leaderId);
        }
        return true;
    }
    
    public function checkGameStart($leaderId){
        $query="SELECT puzzle_count From Game_Engine WHERE leader_id={$leaderId}";
        $result=$this->query($query);
        if( $result->num_rows > 0 ){
            $row = mysqli_fetch_assoc($result);
            $currentQuestion = $row['puzzle_count'];
            return $currentQuestion > 1;
        } else {
            return false;
        }
    }
}
?>
