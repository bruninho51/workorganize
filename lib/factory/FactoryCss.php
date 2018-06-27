<?php
/*
* FACTORY DE EXIBIÇÃO DE CRIAÇÃO DE LINKS CSS
*
* CLASSE RESPONSÁVEL POR CRIAR
* OS LINKS DE CSS
*
* AUTOR: BRUNO MENDES PIMENTA
*/
    namespace lib\factory;

    use config as config;

    class FactoryCss{
        
        public static function css($css){
            
            $linkCss = "view/assets/css/{$css}.css?" . time();
            return $linkCss;
            
        }
        
    }

?>