<?php
include_once 'db/user.php';
include_once 'db/gameEngine.php';

$validUserPassword = true;
if (isset($_POST['userType'])) {
    $userType = $_POST['userType'];
    $name = $_POST['email'];
    $password = $_POST['password'];
    if ($userType == 'leader') {
        $user = Leader::verifyLeader($name, $password);
    } else {
        $user = Team::verifyTeam($name, $password);
    }

    if (!$user->verified()) {
        $validUserPassword = false;
    } else if ($user->getUserType() == User::TEAM) {
        $leaderId = $user->getLeadsLID();
        if (!GameEngine::checkGameStart($leaderId)) {
            header("Location: gamepage.php");
        } else {
            header("Location: gameStartNotification.php");
        }
    } else {
        header("Location: gamepage.php");
    }
}
$user = User::current();
include_once 'header.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/master.css" />
        <script type="text/javascript" src="js/header.js"></script>
        <link rel="stylesheet" type="text/css" href="css/login.css" />
        <script type="text/javascript">
            var selectedId = "#signin";
        </script>
        <title>Login</title>
    </head>
    <body>
        <div id="container">
            <?php showHeader($user); ?>

            <div id="content">
                <div id="leftBar">
                    <div id ="info">
                        <p id="title">Sign In</p>
                        <p>1. Enter your user name and password.</p>
                        <p>2. Specify whether you are a leader or a team. </p>
                        <p>3. Sign in </p>
                    </div>
                </div>

                <div id="rightBar">
                    <div id="login">
                        <form action="login.php" method ="POST">
                            <table id="ftable">
                                <tr>
                                    <td></td>
                                    <?php if (!$validUserPassword) { ?>
                                        <td><Label class="errorMessage" id="errorMessage" style="color:red">Invalid username/password</label></td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="form">
                                        <input type="radio" name="userType" value="leader" checked/> Leader                   
                                        <input type="radio" name="userType" value="team"/> Team
                                    </td>
                                </tr>
                                <tr> 
                                    <td class="form">Username:</td> 
                                    <td class="form"><input type="text" name="email"/></td>
                                </tr>
                                <tr> 
                                    <td class="form">Password:</td> 
                                    <td class="form"><input type="password" name="password"/></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="form"><input type="submit" value="Sign In"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="form"><a href="register.php">Do not have an account?</a>
                                    </td>
                                </tr>

                            </table>
                        </form>
                    </div>   
                </div>

            </div>
            <?php include_once 'footer.php'; ?>
        </div>
    </body>
</html>
