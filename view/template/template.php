<?php
    use lib\Call;

    //PEGA O LINK DO ARQUIVO CSS PASSADO PELO CONTROLADOR
    if($linkCss)
        $linkCss = Call::css($linkCss,true);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo (isset($title)) ? $title : 'System' ?></title>
        <?php echo Call::css("principal", true)?>
        <?php echo (isset($linkCss)) ? $linkCss : '' ?>
        <?php echo Call::css("multipleSelect/multiple-select",true)?>
        <?php echo Call::css("ion.checkRadio/css/ion.checkRadio",true)?>
        <?php echo Call::css("ion.checkRadio/css/ion.checkRadio.dark",true)?>
        <?php echo Call::css("pickadate/themes/default",true)?>
        <?php echo Call::css("pickadate/themes/default.date",true)?>
        <?php Call::js("jquery-3.3.1.min")?>
        <?php Call::js("nicescroll/jquery.nicescroll.min")?>
        <?php Call::js("pickadate/lib/picker")?>
        <?php Call::js("pickadate/lib/legacy")?>
        <?php Call::js("pickadate/lib/picker.date")?>
        <?php Call::js("ion.checkRadio/js/ion.checkRadio.min")?>
        <?php Call::js("multipleSelect/multiple-select")?>
    </head>
    <body>
        
        <?php //CONDIÇÃO PARA COLOCAR O MENU NA PÁGINA, POIS TEM PÁGINAS, COMO A DE LOGIN,
        // QUE NÃO PRECISAM DO MENU
        if( !isset($semMenu) || isset($semMenu) && $semMenu === false ):?>
            <?php require_once("navbar.php")?>
        <?php endif;?>
        
        
        <?php //O CONTEÚDO DA PÁGINA VAI AQUI 
        echo (isset($conteudo)) ? $conteudo : '' ?>
        
        <?php echo Call::js("principal",true)?>
    </body>
</html>