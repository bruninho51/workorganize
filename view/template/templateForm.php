<style>
    .f_container{
        width: 80%;
        min-height: 50vh;
        margin: 0 auto;
    }
</style>
<div class="f_container">
    <?php foreach ($campos as $campo) :?>
    
        <label><?php echo $campo['label']?></label>
        <input type="<?php echo $campo['tipo']?>">

    <?php endforeach;?>
</div>