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
<div class="register">
    REGISTER
    <form class="f2" action="/user/validate" method="post">
        <div class="str"><p>Your email   :</p> <input type="text" name="email" /></div>
        <div class="str"><p>Your password: </p><input type="text" name="password" /></div>
        <div class="str"><p>Your login   : </p><input type="text" name="login" /></div>
        <div class="str"><p>Your company name: </p><input type="text" name="company_name" /></div>
        <p class="button"><input type="submit" value="РЕГИСТРАЦИЯ"/></p>
    </form>
</div>
</body>
</html>

