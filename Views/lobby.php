<?php
/**
 * Created by PhpStorm.
 * User: ilyapolyakov
 * Date: 2019-03-03
 * Time: 19:38
 */
$game = $variables['game'];

echo $game->company_name . PHP_EOL;
echo $game->money . PHP_EOL;
echo $game->turn . PHP_EOL;
?>
<a href="/workers/hire">Hire Workers</a><br>
<a href="/office/choose">Choose Office</a><br>
<a href="/projects/bids">Get Projects</a><br>
<a href="/game/projects">My Projects</a>
<form method="post">
    <input type="submit" name="turn" value="NEXT TURN!">
</form>