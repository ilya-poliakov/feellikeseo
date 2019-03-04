<?php
/**
 * Created by PhpStorm.
 * User: ilyapolyakov
 * Date: 2019-02-28
 * Time: 09:10
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="main.css">
    <title>entrance</title>
</head>
<body>
<div class="register">
    REGISTER
    <form class="f2" action="/user/validate" method="post">
        <div class="str"><p>Your email   :</p> <input value="<?php if(isset($variables['email_val'])) echo $variables['email_val'];?>" type="text" name="email" />
            <?php if(isset($variables['email'])) echo $variables['email'];?>
        </div>
        <div class="str"><p>Your password: </p><input type="text" name="password" />
            <?php if(isset($variables['password'])) echo $variables['password'];?>
        </div>
        <div class="str"><p>Your login   : </p><input value="<?php if(isset($variables['login_val'])) echo $variables['login_val'];?>" type="text" name="login" />
            <?php if(isset($variables['login'])) echo $variables['login'];?>
        </div>
        <p class="button"><input type="submit" value="REGISTER"/></p>
    </form>
</div>
</body>
</html>

