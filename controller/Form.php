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
use lib\Formulario;
class Form
{
    public function index()
    {
        Formulario::process($_POST);
    }   

}