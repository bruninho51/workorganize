<?php
/*
* SINGLETON DE CONFIGURAÇÕES DO PROGRAMA
*
* SINGLETON RESPONSÁVEL POR GUARDAR AS CONFIGURAÇÕES
* DO SISTEMA. ELAS PODEM SER MODIFICADAS NO ARQUIVO env.json
*
* AUTOR: BRUNO MENDES PIMENTA
*/

 namespace config;

 class env{
     //GUARDARÁ INSTÂCIA
     private static $env;
     //GUARDARÁ AS CONFIGURAÇÕES
     private $config;
     
     
     
     //DEIXA OS MÉTODOS wakup, clone e construct PRIVADOS PARA QUE NÃO HAJA POSSIBILIDADE
     //DE INSTÂNCIA DA CLASSE FORA DAQUI
     private function __wakup(){}
     private function __clone(){}
     
     //RETORNARÁ APENAS A PROPRIEDADE config, CONTENDO AS CONFIGURAÇÕES
     //A CLASSE NÃO POSSUI __set, IMPEDINDO QUE AS CONFIGURAÇÕES SEJAM VIOLADAS
     //EM TEMPO DE EXECUÇÃO
     public function __get($property){
         if($property == "config"){
             return $this->$property;
         }
     }
     
     //NO CONSTRUCT, $config É ALIMENTADO COM AS CONFIGURAÇÕES DO ARQUIVO env.json
     private function __construct(){
        $jsonFile = file_get_contents("env.json");
        $jsonFile = utf8_encode($jsonFile);
        //O TRUE É PARA QUE A FUNÇÃO RETORNE UM ARRAY ASSOCIATIVO, AO INVÉS DE UM OBJETO
        $json = json_decode($jsonFile, true);
        foreach($json as $key => $item){
            $this->config[$key] = $item;
        }
     }
     
     //MÉTODO ESTÁTICO RESPONSÁVEL POR RETORNAR INSTÂNCIA DO OBJETO DE CONFIGURAÇÕES
     public static function getInstance(){
        if(self::$env === null){    
            self::$env = new env();
        }
         
         return self::$env;
     }
     
     
 }

?>