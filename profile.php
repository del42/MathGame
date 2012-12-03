<?php
include_once 'header.php';
include_once 'db/leader.php';
include_once 'db/school.php';
include_once 'db/team.php';
include_once 'db/user.php';

$user = User::current();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/master.css" />
        <link rel="stylesheet" type="text/css" href="css/profile.css" />
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="js/header.js"></script>
        <script type="text/javascript" src="js/profile.js"></script>
        <script type="text/javascript">
            var selectedId = "#profile";
        </script>
        <title>Profile</title>
        <style type="text/css">
            #teamtable { padding-right: 2em;}
        </style>
    </head>
    <body>
        <div id="container">
            <?php showHeader($user); ?>

            <div id="content">

                <div id="middleBar">
                    <div id ="edit"><a href="editProfile.php">Edit Profile</a></div>
                    <div id="tabs">
                        <ul>
                            <li class="tabList"><a class="tab" href="#personal">Personal</a></li>
                            <li class="tabList"><a class="tab" href="#team">Team</a></li>                            
                        </ul>
                        
                        <div  id="personal">
                            <?php
                            $school = School::getSchool($user->getSID());
                            ?>
                            <p>First Name: <?php echo $user->getFName(); ?> </p>
                            <p>Last Name: <?php echo $user->getLName(); ?></p>
                            <p>Title: <?php echo $user->getTitle(); ?> </p>
                            <p>Email: <?php echo $user->getEmail(); ?>
                            <p>School: <?php echo $school->getSName(); ?></p>
                            <p>City: <?php echo $school->getCity(); ?></p>
                            <p>State: <?php echo $school->getState(); ?></p>                            
                        </div>
                        <div id="team">
                            <?php
                            $teams = array();
                            $teams = Team::getTeam($user->getlID());
                            for ($index = 0; $index < count($teams); $index++) {
                                $team = $teams[$index];
                                $tNum = $index +1;
                                echo "<table><tr>";
                                echo "<td id = 'teamtable'> Team ". $tNum. "</td>";
                                echo "<td> Team Name:" . $team->getTName() . "</td></tr>";
                                echo "<tr> <td></td> <td> Team Description:" . $team->getDescription() . "</td></tr> </table>";
                                
                                
                            }
                            ?>
                        </div>
                    </div>

                </div>
            </div>
            <?php include_once 'footer.php'; ?>
        </div>
    </body>
</html>
