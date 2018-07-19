<?php
/*
* FACTORY DE CARREGAMENTO DE MODELS
*
* CLASSE RESPONSÁVEL POR CRIAR OBJETOS DE MODEL
* 
*
* AUTOR: BRUNO MENDES PIMENTA
*/
    namespace lib\factory;

    use config as config;
    use model as model;

    class FactoryModel{
        public static function build($model){
            $env = config\env::getInstance(); //INSTÂNCIA DO SINGLETON RESPONSÁVEL PELAS CONFIGURAÇÕES
            $class = "\\model\\{$model}";
            
            $obj = new $class;     
            
            return $obj;
        }
    }