<?php
/*
* BIBLIOTECA DE FORMULÁRIOS
*
* ONDE FICARÁ AS FUNÇÕES RESPONSÁVEIS POR PROCESSAR O FORMULÁRIO
* 
*
* AUTOR: BRUNO MENDES PIMENTA
*/
namespace lib\PhpClipboard;


class ProcessPhpClipboard extends MyProcessPhpClipboard
{
    public static function processClipboard($process, $dadosForm)
    {
        $issetProcessOnClass = !(array_search($process, get_class_methods('\lib\MyProcessPhpClipboard')) === false);
        $noProcessNullOrEmpty = !(empty($process) || is_null($process));

        if ($noProcessNullOrEmpty && $issetProcessOnClass) {

            parent::$process($dadosForm);
        } else {
            throw new PhpClipboardException("1");
        }
    }

}