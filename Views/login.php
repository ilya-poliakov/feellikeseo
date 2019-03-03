<?php
/**
 * Created by PhpStorm.
 * User: ilyapolyakov
 * Date: 2019-02-28
 * Time: 09:10
 */
var_dump($variables);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="main.css">
    <title>entrance</title>
</head>
<body>

<div class="to_come_in">
    TO COME IN
    <form  class="f1" action="/user/checkuser" method="post">
        <div class="str"><p>Your login   :</p> <input type="text" name="login" /></div>
        <div class="str"><p>Your password: </p><input type="text" name="password" /></div>
        <p class="button"><input type="submit" value="ВХОД"/></p>
    </form>
</div>
</body>
</html>
