<?php
/*
* BIBLIOTECA DE FORMULÁRIOS
*
* ONDE FICARÁ AS FUNÇÕES RESPONSÁVEIS POR PROCESSAR O FORMULÁRIO
* 
*
* AUTOR: BRUNO MENDES PIMENTA
*/
namespace controller;
use lib\PhpClipboard;
class Form
{
    public function index()
    {
        PhpClipboard::process($_POST);
    }   

}