<div class="row">
    <div class="col-md-12">
    <?php 
        if(isset($success)):
    ?>
    <div class="alert alert-primary mt-4"><?=$success?></div>
    <?php
        endif;
    ?>

    <?php 
        if(isset($error)):
    ?>
    <div class="alert alert-danger mt-4"><?=$error?></div>
    <?php
        endif;
    ?>

    <?=validation_errors("<div class='alert alert-danger mt-4'>", "</div>");?>
    </div>
</div>