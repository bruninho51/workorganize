<?php
/*
* INICIO DA APLICAÇÃO
* 
* É O INDEX QUE DÁ O START NA APLICAÇÃO, TRATANDO AS URI's
* E REPASSANDO A REQUISIÇÃO PARA OS CONTROLADORES
*
* AUTOR: BRUNO MENDES PIMENTA
*/
    use config as config; //configurações da aplicação
    use helper\helper as helper; //helpers
    use lib\factory\FactoryController as controller; //load controller factory

    //INCLUI O AUTOLOAD DO COMPOSER
    include_once("vendor/autoload.php");

    session_start();

    //RESGATA OBJETO DE CONFIGURAÇÕES DO SISTEMA
    $env = config\env::getInstance();

    //VARIÁVEIS QUE SERÃO USADAS PARA IDENTIFICAR SE A URI ESTÁ NOS PADRÕES
    $padraoUri = "/^\?mod\=[a-zA-Z]*\&act\=[a-zA-Z]*/";
    $uri = explode('/', $_SERVER['REQUEST_URI'])[2];

    //SE URI NÃO SATISFAZER OS PADRÕES DA APLICAÇÃO...
    if( !preg_match($padraoUri, $uri) && $uri != '' ){
        //http_response_code(404); //ERRO 404 É EMITIDO
        helper::erro404(); //ERRO 404 É EMITIDO
    }else{
        if(isset($_SESSION)){
            $condicaoPaginaPrincipal = ( !isset($_GET) || empty($_GET)/* || !isset($_GET['mod']) || !isset($_GET['act'])*/ );
            //VERIFICA SE A PÁGINA A SER CARREGADA DEVE SER A PRINCIPAL...
            if( $condicaoPaginaPrincipal ){
                //echo 'controler principal ainda não existe';
                controller::load("Principal");
            //CASO NÃO SEJA, CONTROLADOR E ACTION PASSADOS SERÃO CARREGADOS...    
            }else{
                //CASO O load RETORNE FALSO POR CONTA DO CONTROLLER OU ACTION NÃO EXISTIR...
                if( !controller::load($_GET['mod'], $_GET['act']) ){
                    //return http_response_code(404); //ERRO 404 É EMITIDO
                    helper::erro404(); //ERRO 404 É EMITIDO
                }    

            }    
        }else{
            controller::load("Login");
        }
        
    } 

?>