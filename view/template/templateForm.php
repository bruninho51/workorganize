<style>
    .f_container form{
        width: 90%;
        display: flex;
        justify-content: center;
        margin: 0 auto;
        margin-top: 2vh;
        background-color: #1A204E;
        border-radius: 12px;
        flex-wrap: wrap;
        padding: 10px 20px 10px 20px;

    }
    .f_row{
        display: flex;
        width: 100%;
        padding: 0px 0px 7px 0px;
    }
    .flex-center{
        justify-content: center !important;
    }
    .flex-end{
        justify-content: flex-end !important;
    }
    .f_row > label{
        flex-basis: 20%;
        color: #FFF;
    }
    .f_row > input:not([type="submit"]),select{
        background-color: #FFF;

    }
    .f_row input,select{
        flex-basis: 80%;
        margin: 0px 2px 0px 2px;
    }
    .f_row input[type='date'],select{
        cursor: pointer;
    }
    .f-btn-container{
        flex-grow: 1;
        padding-top: 16px !important;
    }
    #tituloForm{
        font-size: 1.2em;
        color: #FFF;
        margin-bottom: 5px;
    }
</style>
<div class="f_container">

    <form action="<?= '?mod=Form&act='?>" method="<?= $info['method']?>">
        <h1 id="tituloForm"><?php echo $info['nomeForm']?></h1>
        <input type="hidden" name="process" value="<?php echo $info['process']?>">
        <?php foreach ($info['campos'] as $campo) :?>
            <div class="f_row flex-center">
                <?php $campo->label()?>
                <?php $campo
                    ->setClass("input-workorganize", ["text", "date", "textarea", "select"])
                    ->multipleSelect()
                    /*->errors($error)*/
                    ->show()?>
            </div>
        <?php endforeach?>
        <div class="f_row f-btn-container flex-end">
            <input class="btn-workorganize" type="submit" name="enviar" value="Enviar">
        </div>    
    </form>    
</div>
<?php echo '<pre>';print_r($errors)?>