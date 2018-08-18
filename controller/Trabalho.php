<?php
    namespace controller;
    use lib\factory\FactoryView as fView;

    class Trabalho
    {
        public function index()
        {
            echo "index";
        }

        public function adicionar()
        {
            $modulo = 2;
            $dados = array(
                "title" => "Add Trabalho",
            );
            fview::view("vw_addTrabalho", $dados);
            echo "adicionar";
        }
    }