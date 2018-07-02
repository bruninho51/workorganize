<?php
    namespace controller;
    use lib\factory as factory;

    class Principal {
        
        public function index(&$respostaCtl = false){
            $dados = array(
                "title" => "Tela Principal",
                "linkCss" => "dashboard",
                
            );

            factory\FactoryView::view('vw_principal', $dados);
            
        }
     
        
    }


?>