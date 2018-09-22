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
    use model\DB as DB;
    use model\CRUD as CRUD;
    use lib\Call;

    

    class Formulario{

        const TABELAFORMULARIO = "formulario";
        const TABELAFORMULARIOMODULO = "formularioModulo";
        const TABELACAMPOS = "campos";
        const TABELACAMPOSFORMULARIO = "camposFormulario";
        
        private $forms;        

        public function __construct($idModulo) 
        {
            $db = DB::rescue();
            $crud = CRUD::build();

            $crud->select(self::TABELAFORMULARIO, [
                self::TABELAFORMULARIO.".idFormulario",
                self::TABELAFORMULARIO.".titulo",
                self::TABELAFORMULARIO.".descricao"
            ]);
            $crud->innerJoin(
                self::TABELAFORMULARIOMODULO, "idForm",
                self::TABELAFORMULARIO, "idFormulario"
                
            );
            $crud->where(self::TABELAFORMULARIOMODULO, "idModulo", "=", (string) $idModulo);
           
            $formularios = $db->execute($crud);

            $resposta = array();
            while ($line = $formularios->fetch_assoc()) {
                $resposta[] = $line;
            }
            $this->forms = $resposta;

        }

        public function getDadosForms ($idFormulario = false)
        {
            $camposFormularios = array();
            $db = DB::rescue();

            if ($idFormulario === false) {
                foreach ($this->forms as $form) {
                    $idFrm = $form['idFormulario'];

                    $campos = $this->getCamposFormulario($idFrm);
                    $camposFormularios[$idFrm]['nomeForm'] = $form['nome'];
                    $camposFormularios[$idFrm]['campos'] = $campos;
                }
                return $camposFormularios;

            } else {
                $campos = $this->getCamposFormulario($idFormulario);
                return $campos;
            }
        }

        public function getForms ($idFormulario = false)
        {
            $dadosForm = $this->getDadosForms($idFormulario);
            if ($idFormulario === false) {

            }else {
                $dados = array(
                    "nomeForm" => "none",
                    "campos" => $dadosForm
                );
                ob_start();
                Call::view("template/templateForm", $dados, null);
                $form = ob_get_contents();
                ob_end_clean();
                return $form;
            }
        }

        private function getCamposFormulario($form) 
        {
            $form = (string) $form;
            $campos = array();

            $db = DB::rescue();
            $crud = CRUD::build();

            $crud->select(self::TABELACAMPOS, [
                self::TABELACAMPOS.".*"
            ]);
            $crud->innerJoin(
                self::TABELACAMPOSFORMULARIO, "idCampo",
                self::TABELACAMPOS, "idCampo"    
            );
            $crud->where(self::TABELACAMPOSFORMULARIO, "idFormulario", "=", $form);
            $dadosCampos = $db->execute($crud);
            while ($campo = $dadosCampos->fetch_assoc()) {
                $campos[] = $campo;
            }

            return $campos;
        }
    }