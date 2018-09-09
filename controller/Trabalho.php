<?php
    namespace controller;
    use lib\factory\FactoryView as fView;
    use lib\Formulario;

    class Trabalho
    {
        public function index()
        {
            echo "index";
        }

        public function adicionar()
        {
            $modulo = 2;

            $frm = new Formulario($modulo);

            $dados = array(
                "title" => "Tela Principal",
                "linkCss" => "dashboard",
                "campos" => $frm->getForms(1)
             );

            fview::view('vw_addTrabalho', $dados);
            
        }
    }