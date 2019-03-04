<?php
/**
 * Created by PhpStorm.
 * User: ilyapolyakov
 * Date: 2019-03-02
 * Time: 14:53
 */

?>
<form method="post" action="">
    <table>
        <tr>
            <td>Name</td>
            <td>Sex</td>
            <td>Level</td>
            <td>Job</td>
            <td>Salary</td>
            <td>Skill</td>
            <td>Selection</td>
        </tr>
    <?php foreach ($variables as $worker){ ?>
        <tr>
        <td><?php echo $worker['name'];?></td>
        <td><?php echo $worker['sex'];?></td>
        <td><?php echo $worker['level'];?></td>
        <td><?php echo $worker['job'];?></td>
        <td><?php echo $worker['salary'];?></td>
        <td><?php echo $worker['power'];?></td>
        <td><input type="checkbox" name="workers[]" value='<?php echo json_encode($worker);?>'></td>
        </tr>
    <?php }?>
    </table>
    <p class="button"><a href="/game/lobby">Back</a></p>
    <p class="button"><input type="submit" value="HIRE!"/></p>
</form>
