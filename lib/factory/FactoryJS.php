<?php
/*
* FACTORY DE CARREGAMENTO DE ARQUIVOS JAVASCRIPT
*
* CLASSE RESPONSÁVEL POR COLOCAR DEPENDÊNCIAS JAVASCRIPT
* NA PÁGINA
*
* AUTOR: BRUNO MENDES PIMENTA
*/
    namespace lib\factory;

    use config as config;

    class FactoryJS{
        
        public static function js($nomeArquivo){
            $env = config\env::getInstance();
            $enderecoArquivo = "js/{$nomeArquivo}.js";
            echo "<script src='{$enderecoArquivo}'></script>".PHP_EOL;
            
        }
        
        
    }