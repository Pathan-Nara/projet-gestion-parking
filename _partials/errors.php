<?php
if(!empty($error)) :
    foreach($error as $errors) :
        ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $errors; ?>
        </div>
    <?php
    endforeach;
endif;
?>