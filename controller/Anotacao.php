<?php

    namespace controller;
    use lib\PhpClipboard\PhpClipboard;
    use lib\Call;

    class Anotacao
    {
        public function index()
        {
            $trabalhoDAO = Call::model('TrabalhoDAO');
            $resTrabalhoDAO = $trabalhoDAO->getTrabalhos();
            
            $modulo = 3;
            
            $form = new PhpClipboard($modulo);
            
            $trabalhos = array();
            while($trabalho = $resTrabalhoDAO->fetch_assoc()){
                array_push($trabalhos, $trabalho);
            }
            
            $dados = array(
                'trabalhos' => $trabalhos,
                'title' => 'Anotações',
                "linkCss" => "anotacao",
                'frmAnotacao' => $form->getForms(2)
            );
            
            Call::view('vw_addAnotacao', $dados);
        }
        
    }