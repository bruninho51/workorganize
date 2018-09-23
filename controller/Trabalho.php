<?php
    namespace controller;
    use lib\PhpClipboard;
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

            $frm = new PhpClipboard($modulo);

            $dados = array(
                "title" => "Tela Principal",
                "linkCss" => "dashboard",
                "form" => $frm->getForms(1)
             );

            Call::view('vw_addTrabalho', $dados);
            
        }
    }