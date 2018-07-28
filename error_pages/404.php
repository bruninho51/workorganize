<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Página não encontrada</title>
        <link rel="stylesheet" href="view/assets/css/principal.css?<?php echo time()?>">
        <link rel="stylesheet" href="view/assets/css/css404.css">
    </head>
    <body>
        <div id="nav404">
            <img src="view/assets/img/404.png">
            <h1>Houston temos um problema!</h1>
        </div>
        
        <div id="content">
            <h1>ERRO 404</h1>
            Sinto muito! A página que você está tentado acessar não foi encontrada! 
            <input type="button" value="Ir à Página Principal" onclick="window.location.href = '<?php echo 'http://' . $urlPrincipal?>'">
        </div>
        <script src="js/principal.js"></script>
    </body>
</html>