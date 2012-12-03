<?php
include_once 'db/team.php';
include_once 'db/leader.php';
include_once 'header.php';

if (isset($_POST['teamName'])) {
    $tName = $_POST['teamName'];
    $passwd = $_POST['teamPassword'];
    $desc = $_POST['desc'];
  
$user = User::current(); 
if ($user->getUserType() == User::LEADER) {
    $fLID = $user->getlID();
}
 
$selected = Team::registerTeam($tName, $passwd, $fLID, $desc);
    } 
//echo '<META HTTP-EQUIV="Refresh" Content="0; URL=gamepage.php">';    
header('Location: gamepage.php');
    
?>
