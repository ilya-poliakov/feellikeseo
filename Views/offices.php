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
            <td>Capacity</td>
            <td>Comfort</td>
            <td>Rent</td>
        </tr>
        <?php foreach ($variables as $office){ ?>
            <tr>
                <td><?php echo $office['name'];?></td>
                <td><?php echo $office['capacity'];?></td>
                <td><?php echo $office['comfort'];?></td>
                <td><?php echo $office['rent'];?></td>
                <td><input type="radio" name="office" value='<?php echo json_encode($office);?>'></td>
            </tr>
        <?php }?>
    </table>
    <p class="button"><a href="/game/lobby">Back</a></p>
    <p class="button"><input type="submit" value="RENT OFFICE"/></p>
</form>