<?php
include_once 'header.php';
include_once 'db/user.php';

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
        <script type="text/javascript" src="js/register.js"></script>
        <script type="text/javascript">
            selectedId = "#signin";
        </script>
        <title>Register</title>
        <style type ="text/css"> h3 {margin-top: 0; padding-top: 1em;}</style>
    </head>
    <body>
        <div id="container">
            <?php showHeader($user); ?>

            <div id="content">

                <div id="middleBar">
                    <h3 id="hCreateAccount">CREATE AN ACCOUNT</h3>
                    <div id="form">
                        <form id="registrationForm" method="POST" action="addteam.php" >
                            <p id="pRequiredField"><span class="hightlighted">*</span> Fields are required</p>
                            <table>
                                <tr>
                                    <td><label class="description" for="firstname">First name<span class="hightlighted">*</span>:</label></td>
                                    <td><input type="text" name="firstname" id ="firstname" /></td>
                                    <td><label id="firstnameMessage" class="errorMessage"></label></td>
                                </tr>
                                <tr>
                                    <td><label class="description" for="lastname">Last name<span class="hightlighted">*</span>:</label></td>
                                    <td><input type="text" name="lastname" id="lastname"/></td>
                                    <td><label id="lastnameMessage" class="errorMessage"></label></td>
                                </tr>
                                <tr>
                                    <td><label class="description" for="title">Title<span class="hightlighted">*</span>:</label></td>
                                    <td><input type="text" name="title" id="title"/></td>
                                    <td><label class="errorMessage" id="titleMessage"></label></td>
                                </tr>
                                <tr>
                                    <td><label class="description" for="emril">Email<span class="hightlighted">*</span>:</label></td>
                                    <td><input type="text" name="email" id="email"/></td>
                                    <td><label class="errorMessage" id="emailMessage"></label></td>
                                </tr>
                                <tr>
                                    <td><label class="description" for="password">Password<span class="hightlighted">*</span>:</label></td>
                                    <td><input type="password" name="pwd" id="password"/></td>
                                    <td><label class="errorMessage" id="passwordMessage"></label></td>
                                </tr>
                                <tr>
                                    <td><label class="description" for="confirmPassword">Confirm password<span class="hightlighted">*</span>:</label></td>
                                    <td><input type="password" name="confirm" id="confirmPassword"/></td>
                                    <td><label class="errorMessage" id="confirmPasswordMessage"></label></td>
                                </tr>
                                <tr>
                                    <td><label class="description" for="school">School<span class="hightlighted">*</span>:</label></td>
                                    <td><input type="text" name="school" id="school"/></td>
                                    <td><label class="errorMessage" id="schoolMessage"></label></td>
                                </tr>
                                <tr>
                                    <td><label class="description" for="city">City<span class="hightlighted">*</span>:</label></td>
                                    <td><input type="text" name="city" id="city"/></td>
                                    <td><label class="errorMessage" id="cityMessage"></label></td>
                                </tr>
                                <tr>
                                    <td><label class="description" for="state">State<span class="hightlighted">*</span>:</label></td>
                                    <td><input type="text" name="state" id="state"/></td>
                                    <td><label class="errorMessage" id="stateMessage"></label></td>
                                </tr>
                            </table>
                            <div class="submit" id="submit" class="formRequired">
                                <input name="Submit" value="Submit" type="submit" onclick="validate(); return false;"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php include_once 'footer.php'; ?>
        </div>
    </body>
</html>

