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

    ini_set('DISPLAY_ERRORS', true);

    //SESSÃO
    session_start();

    //INCLUI O AUTOLOAD DO COMPOSER
    include_once("vendor/autoload.php");

    //RESGATA OBJETO DE CONFIGURAÇÕES DO SISTEMA
    $env = config\env::getInstance();
    
    /*
    *--------------------------------------
    *------ CUIDA DA SESSÃO DE LOGIN ------
    *--------------------------------------
    */

    //VERIFICA SE MOD E ACT FOI PASSADO VIA POST
    $condicaoGETURI = ( isset($_GET) && isset($_GET['mod']) && isset($_GET['act']) );
    //CASO A REQUISIÇÃO SEJA PARA FAZER O LOGIN NO SITE...
    if( $condicaoGETURI && $_GET['mod'] == 'Login' && $_GET['act'] == 'logar' ){
        //CONTROLADOR DE LOGIN E ACT LOGAR SERÃO CARREGADOS
        //(LOGAR É RESPONSÁVEL POR VALIDAR USUÁRIO E INICIAR SESSÃO)
        $respostaCtl = '';
        controller::load($_GET['mod'], $_GET['act'], false, $respostaCtl);
        
        if($respostaCtl === false){
            $_GET['act'] = '';
            
        }
        
    }

    /*
    *---------------------------------------
    */

    //VARIÁVEIS QUE SERÃO USADAS PARA IDENTIFICAR SE A URI ESTÁ NOS PADRÕES
    $padraoUri = "/^\?mod\=[a-zA-Z]*\&act\=[a-zA-Z]*/";
    $uri = explode('/', $_SERVER['REQUEST_URI'])[2];

    //SE URI NÃO SATISFAZER OS PADRÕES DA APLICAÇÃO...
    if( !preg_match($padraoUri, $uri) && $uri != '' ){
        //http_response_code(404); //ERRO 404 É EMITIDO
        helper::erro404(); //ERRO 404 É EMITIDO
    }else{
        //VERIFICA SE $_GET EXISTE E NÃO ESTÁ VAZIO
        $condicaoExisteGET = ( isset($_GET) && !empty($_GET) );
        //CONDIÇÃO QUE AVALIA SE CONTROLLER A SER ACESSADO É O DE LOGIN E SE NÃO É O INDEX
        $condicaoMetodosLoginCtl = $condicaoExisteGET && ( $_GET['mod'] == 'Login' && ($_GET['act'] != '' && $_GET['act'] != 'index') );
        //SE SESSÃO EXISTIR OU SE CONTROLLER A SER ACESSADO É O DE LOGIN E ACT NÃO É O INDEX...
        
        if(isset($_SESSION) && !empty($_SESSION) || ( $condicaoMetodosLoginCtl ) ){
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