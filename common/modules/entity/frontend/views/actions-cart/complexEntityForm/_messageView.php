<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 23.10.2015
 * Time: 12:40
 */
?>
<?php
$message = $actionLink->getMessage($task);
if($message){
?>
<div class="entity-types-create">
    <div class="alert alert-<?=!empty($messageType)?$messageType:'info'?>" role="alert">
        <?=$message?>
    </div>
</div>
<?php }?>