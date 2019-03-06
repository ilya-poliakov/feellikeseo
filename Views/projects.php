<?php
$dashboard = $variables['dashboard'];
$workers = $variables['workers'];
?>
<pre>
    <?php //var_dump($variables); ?>
</pre>
<form method="post" action="">
    <table>
        <tr>
            <td>Title</td>
            <td>Work Left</td>
            <td>Turns Left</td>
            <td>Award</td>
            <td>Assign workers</td>
        </tr>
        <?php foreach ($dashboard as $project){ ?>
            <tr>
                <td><?php echo $project->title;?></td>
                <td><?php echo $project->size;?></td>
                <td><?php echo $project->duration; ?></td>
                <td><?php echo $project->award;?>$</td>
                <td>
                    <select multiple name="workers[<?php echo $project->id;?>][]">
                        <?php
                            foreach ($workers as $worker){
                                if($worker->job == 'sales-manager')continue;
                                ?>
                                <option value="<?php echo $worker->id; ?>" <?php
                                foreach ($project->getAssignedWorkers() as $assignedWorker){
                                    if ($worker->id == $assignedWorker->id) {
                                        echo ' selected ';
                                        break;
                                    }
                                }
                                ?> ><?php echo $worker->name .' - '.$worker->level. ' ' .$worker->job;
                                ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </td>
            </tr>
        <?php }?>
    </table>
    <p class="button"><a href="/game/lobby">Back</a></p>
    <p class="button"><input type="submit" value="Confirm!"/></p>
</form>


