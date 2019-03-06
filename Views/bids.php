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
            <td>Title</td>
            <td>Size</td>
            <td>Duration</td>
            <td>Award</td>
        </tr>
        <?php foreach ($variables as $project){ ?>
            <tr>
                <td><?php echo $project['title'];?></td>
                <td><?php echo $project['size'];?></td>
                <td><?php echo $project['duration'];?></td>
                <td><?php echo $project['award'];?>$</td>
                <td><input type="checkbox" name="projects[]" value='<?php echo json_encode($project);?>'></td>
            </tr>
        <?php }?>
    </table>
    <p class="button"><a href="/game/lobby">Back</a></p>
    <p class="button"><input type="submit" value="START!"/></p>
</form>
