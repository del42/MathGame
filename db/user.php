<?php
require_once 'leader.php';
include_once 'gameEngine.php';

abstract class User {

    const LEADER = 0;
    const TEAM = 1;

    abstract public function getUserName();

    abstract public function getUserId();

    abstract public function getUserType();

    abstract public function verified();
    
    /**
     * Get the user who is currently login.
     * @return User 
     */
    public static function current() {
        @session_start();
        if (!isset($_SESSION['user'])) {
            $_SESSION['user'] = new Leader(false);
        }
        return $_SESSION['user'];
    }

    /**
     * Remember the user who is currently login.
     * @param User $user 
     */
    protected static function remember($user) {
        @session_start();
        $_SESSION['user'] = $user;
    }

    public static function logout() {
        @session_start();
        $user=$_SESSION['user'];
        if( $user->getUserType() == User::LEADER){
            GameEngine::removeGameEngine($user->getLID());
        }
        unset($_SESSION['user']);
        session_destroy();
    }

}

?>
