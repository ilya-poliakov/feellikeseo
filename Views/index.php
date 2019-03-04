<h2>Welcome to the brand new game...</h2>
<h1>Feel Like CEO!</h1>
<?php if(isset($variables['user'])){?>
    <h3>Hi, <?php echo $variables['user']->login; ?></h3>
    <a href="game/start">Start Game!</a><br>
    <a href="user/logout">Logout</a><br>
<?php }else {?>
    <a href="user/login">Login</a><br>
    <a href="user/register">Register</a><br>
<?php } ?>