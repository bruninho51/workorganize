<?php
    use lib\factory as factory;

    //PEGA O LINK DO ARQUIVO CSS PASSADO PELO CONTROLADOR
    if($linkCss)
        $linkCss = factory\FactoryCss::css($linkCss);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo (isset($title)) ? $title : 'System' ?></title>
        <link rel="stylesheet" href="view/assets/css/principal.css?<?php echo time()?>">
        <?php echo (isset($linkCss)) ? "<link rel=\"stylesheet\" href=\"{$linkCss}\">".PHP_EOL : '' ?>
        <?php echo \lib\factory\FactoryJS::js("jquery-3.3.1.min")?>
    </head>
    <body>
        
        <?php //CONDIÇÃO PARA COLOCAR O MENU NA PÁGINA, POIS TEM PÁGINAS, COMO A DE LOGIN,
        // QUE NÃO PRECISAM DO MENU
        if( !isset($semMenu) || isset($semMenu) && $semMenu === false ):?>
            <?php require_once("navbar.php")?>
        <?php endif;?>
        
        
        <?php //O CONTEÚDO DA PÁGINA VAI AQUI 
        echo (isset($conteudo)) ? $conteudo : '' ?>
        
        <script src="js/principal.js"></script>
    </body>
</html>