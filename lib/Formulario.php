<?php
/*
* BIBLIOTECA DE FORMULÁRIOS
*
* BIBLIOTECA RESPONSÁVEL PELA OBTENÇÃO E CRIAÇÃO DE FORMULÁRIOS NO SITE
* 
*
* AUTOR: BRUNO MENDES PIMENTA
*/
    namespace lib;

    use config as config;
    use model as model;
    use model\DB as DB;
    use model\CRUD as CRUD;
    const TABELAFORMULARIO = "formulario";

    class Formulario{
        
        private $forms;

        public function __construct($idModulo, $idFormulario = false) 
        {
            $db = DB::rescue();
            $crud = CRUD::build();

            $crud->select(TABELAFORMULARIO);
            $crud->where(TABELAFORMULARIO, "modulo", "=", (string) $idModulo);
            echo $crud->sql();
            $formularios = $db->execute($crud);
            $resposta = array();
            while ($line = $formularios->fetch_assoc()) {
                $resposta[] = $line;
            }
            $this->forms = $resposta;

        }
    }