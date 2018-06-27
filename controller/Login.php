<?php
    namespace controller;
    use lib\factory\FactoryView as fView;
    use config as config;

    class Login {
        
        public function index(){
            $env = config\env::getInstance();
            //CASO SESSÃO EXISTA, PÁGINA PRINCIPAL SERÁ CARREGADA USANDO HEADER(POIS FactoryController CARREGA SEM MUDAR URL)
            if(isset($_SESSION)){
                header("location: ?mod=Principal&act=");
                
            //CASO NÃO EXISTA, VIEW DE LOGIN SERÁ CARREGADA    
            }else{
                
                $dados = array(
                    "title" => "Login",
                    "linkCss" => "login"
                );

                fView::view('vw_login', $dados);   
            }
            
            
        }
        
        public function festa(){
            echo 'É festaaaaaa \º/';
        }
     
        
    }


?>