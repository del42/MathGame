<?php
function showHeader($user) {
    ?>
    <div id="header">
        <font class="logo" id="logo" size="6" face="cursive">MaThMaGic</font>
        <?php
        if ($user->verified()) {
            ?>
            <div class="user">
                <label>Signed in as <?= $user->getUserName(); ?> (</label><a href="signout.php" class="signout" onclick="signout();"> Sign Out? </a><label>)</label>
            </div>
            <?php
        }
        ?>
        <ul class="mainNavigate">

            <?php
            if ($user->verified() && $user->getUserType() == User::LEADER) {
                ?>
                <li class="list" > 
                    <a class="nav" href="index.php" id="home">Home</a>
                </li>
                <li class="list" >
                    <a class="nav" href="profile.php" id="profile">Profile</a>
                </li>
                <li class = "list" >
                    <a class = "nav" href = "gameDescription.php" id = "gameDesc">Game Desc</a>
                </li>
            <?php } else if ($user->verified() && $user->getUserType() == User::TEAM) { ?>
            <?php } else {
                ?>
                <li class = "list" >
                    <a class = "nav" href = "index.php" id = "home">Home</a>
                </li>
                <li class = "list" >
                    <a class = "nav" href = "login.php" id = "signin">Sign In</a>
                </li>
                <li class = "list" >
                    <a class = "nav" href = "gameDescription.php" id = "gameDesc">Game Desc</a>
                </li>
                <?php
            }
            ?> 
        </ul>

    </div>
    <?php
}
?>
