<?php
    namespace controller;
    use lib\PhpClipboard\PhpClipboard;
    use lib\Call;

    class Trabalho
    {
        public function index()
        {
            echo "index";
        }

        public function adicionar($data)
        {
            $modulo = 2;

            $frm = new PhpClipboard($modulo);
            $erros = $data['erros'];
            
            $dados = array(
                "title" => "Tela Principal",
                "linkCss" => "dashboard",
                "form" => $frm->getForms(1, $erros)
             );

            Call::view('vw_addTrabalho', $dados);
            
        }
        
        public function validarAnotacao($dados, &$respostaCtl)
        {
            //RespostaCtl receberá os erros. Caso não tenha nenhum erro, receberá false
            //respostaCtl irá para MyProcessPhpClipboard, que passará os erros para a ação adicionar
            //do controlador Trabalho, que recarregará a página de adição de trabalhos com os erros
            
            $respostaCtl = false;
            
            if (empty($dados['titulo'])) {
                $respostaCtl['fTituloTrabalho'] = false;
            }
            if (empty($dados['dataInicio'])) {
                $respostaCtl['fDataInicioTrabalho'] = false;
            }
            if (empty($dados['dataFim'])) {
                $respostaCtl['fDataFimTrabalho'] = false;
            }
            if (empty($dados['usuarios']) || !is_array($dados['usuarios'])) {
                $respostaCtl['fUsuariosTrabalho'] = false;
            }
            if (empty($dados['descricao'])) {
                $respostaCtl['fDescricaoTrabalho'] = false;
            }
            
        }
        
    }