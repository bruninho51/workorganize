<?php
/*
* BIBLIOTECA DE FORMULÁRIOS
*
* ONDE FICARÁ AS FUNÇÕES RESPONSÁVEIS POR PROCESSAR OS FORMULÁRIOS
* 
*
* AUTOR: BRUNO MENDES PIMENTA
*/
namespace lib\PhpClipboard;
use lib\Call;

class MyProcessPhpClipboard
{
    function cadastrarTrabalho($dados)
    {
        Call::controller('Trabalho', 'validarAnotacao', $dados, $semErros);
        
        if ($semErros === true) {
            
        } else {
            Call::controller('Trabalho','adicionar',array('erros' => $semErros));
        }
    }
    
    function cadastrarAnotacao($dados)
    {
        echo '<pre>';
        print_r($dados);
        echo '</pre>';
    }

}