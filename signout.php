<?php

require_once 'db/user.php';

User::logout();

header("Location: index.php");

?>
