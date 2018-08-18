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
            $tempo = time();
            $enderecoArquivo = "js/{$nomeArquivo}.js?{$tempo}";
            echo "<script src='{$enderecoArquivo}'></script>".PHP_EOL;
            
        }
        
        
    }