<?php

include_once 'db/leader.php';
include_once 'db/user.php';
include_once 'header.php';


if (isset($_POST['firstname'])) {
    $fName = $_POST['firstname'];
    $email = $_POST['email'];
    $lName = $_POST['lastname'];
    $passwd = $_POST['pwd'];
    $title = $_POST['title'];
    $school = $_POST['school'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $registered = Leader::registerLeader($fName, $lName, $title, $email, $passwd, $school, $city, $state);
} else {
    $registered = false;
}

if ( !$registered ){
  header("Location: registerFail.html");
}

$user = User::current();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/master.css" />
        <link rel="stylesheet" href="css/registration.css" type="text/css" media="all" />
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="js/header.js"></script>
        <script src="js/addteam.js"></script>
        <script type="text/javascript">
            selectedId = "#signin";
        </script>
        <title>Add Teams</title>
    </head>
    <body>
        <div id="container">
            <?php showHeader($user); ?>

            <div id="content">

                <div id="middleBar" style="overflow-x:hidden; overflow-y:scroll;">
                    <h3 id="hAddTeam">ADD TEAM</h3>
                    <p id="pRequiredField"><span class="hightlighted">*</span>fields are required</p>
                    <form id="addTeamForm" method="POST" action="addTeamDB.php" onsubmit="return validate()"  >
                        <fieldset>
                        <legend>Register Team</legend>
                        <table>
                            <tr>
                                <td><label for="teamName">Team Name<span class="hightlighted">*</span>:</label></td>
                                <td><input class="teaminput" type="text" name="teamName" id ="teamName" /></td>
                                <td><label id="teamNameMessage" name="teamNameMessage" class="errorMessage"></label></td>
                            </tr>
                            <tr>
                                <td><label for="teamPassword">Password<span class="hightlighted">*</span>:</label></td>
                                <td><input class="teaminput" type="password" name="teamPassword" id="teamPassword"/></td>
                                <td><label id="teamPasswordMessage" name="teamPasswordMessage" class="errorMessage"></label></td>
                            </tr>
                            <tr>
                                <td><label for="teamConfirmPassword">Confirm password<span class="hightlighted">*</span>:</label></td>
                                <td><input class="teaminput" type="password" name="teamConfirmPassword" id="teamConfirmPassword"/></td>
                                <td><label id="teamConfirmPasswordMessage" name="teamConfirmPasswordMessage" class="errorMessage"></label></td>
                            </tr>
                        </table>
                        <div id="description" class="description">
                            <table>
                                <tr>
                                 <td> <label id="teamDescription" for="teamDescription">Description:</label> </td>
                                 <td> <textarea id ="tTeamDescription" rows="0" cols="25" style="resize: none"> </textarea> </td>
                                </tr>
                            </table>
                        </div>
                    </fieldset>
                    </form>
                    <div id="modifiable"> </div>
                    <div id="addMoreTeam" class="submit">
                        <input id="addMoreTeam" name="addMoreTeam" value="Add More" type="submit"  onclick ="addNode();"/>
                    </div>
                    <div id="addTeamSubmit" class="submit">
                        <input name="addTeamSubmit" value="Submit" type="submit" onclick="submitAllForms();return false;"/>
                    </div>
                </div>
            </div>
            <?php include_once 'footer.php'; ?>
        </div>
    </body>
</html>

