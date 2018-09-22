<?php
    namespace controller;
    use lib\Formulario;
    use lib\Call;

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

            Call::view('vw_addTrabalho', $dados);
            
        }
    }