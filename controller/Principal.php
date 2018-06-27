<?php
    namespace controller;
    use lib\factory as factory;

    class Principal {
        
        public function index(){
            $dados = array(
                "title" => "Tela Principal",
                "linkCss" => "principal"
            );

            factory\FactoryView::view('vw_principal', $dados);
            
        }
     
        
    }


?>