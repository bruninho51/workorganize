<?php
/*
* BIBLIOTECA DE FORMULÁRIOS
*
* Classe de exceção do PhpClipboard
* 
*
* AUTOR: BRUNO MENDES PIMENTA
*/
namespace lib\PhpClipboard;

class PhpClipboardException extends \Exception
{
    private $messages;
    private $codes;

    public function __construct($code)
    {
        $this->errors();

        $idxError = array_search($code, $this->codes);
        parent::__construct($this->messages[$idxError], $code, null);
        
    }

    public function errors()
    {
        $this->messages = array(
            "O formulário possui um método processador inválido.",
            "Falta de propriedades do campo no construtor.",
            "Propriedade obrigatória nula.",
            "Você tentou acessar uma propriedade inexistente ou restrita.",
            "Propriedade inválida.",
            "Opções do controle inválidas. Verifique o campo opt da tabela campos na sua base de dados.",
            "Tipo de entrada de dados inválida. Verifique o tipo do campo no banco de dados."
        );
        
        $this->codes = array(
            "1",
            "2",
            "3",
            "4",
            "5",
            "6",
            "7"
        );
    }

}