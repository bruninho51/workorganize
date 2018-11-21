<?php
/*
* BIBLIOTECA DE FORMULÁRIOS
*
* BIBLIOTECA RESPONSÁVEL PELA OBTENÇÃO E CRIAÇÃO DE FORMULÁRIOS NO SITE
* 
*
* AUTOR: BRUNO MENDES PIMENTA
*/
    namespace lib\PhpClipboard;

    use config as config;
    use model\DB as DB;
    use model\CRUD as CRUD;
    use lib\Call;

    use lib\PhpClipboard\ProcessPhpClipboard;
    use lib\PhpClipboard\PhpClipboardEntry;

    class PhpClipboard{

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
                self::TABELAFORMULARIO.".descricao",
                self::TABELAFORMULARIO.".method",
                self::TABELAFORMULARIO.".process"
            ]);
            $crud->innerJoin(
                self::TABELAFORMULARIOMODULO, "idForm",
                self::TABELAFORMULARIO, "idFormulario"
                
            );
            $crud->where(self::TABELAFORMULARIOMODULO, "idModulo", "=", (string) $idModulo);
            
            $formularios = $db->execute($crud);

            $resposta = array();
            while ($line = $formularios->fetch_assoc()) {
                $resposta[$line['idFormulario']] = $line;
            }
            $this->forms = $resposta;

        }

        public function getDadosForms ($idFormulario = false)
        {
            $camposFormularios = array();
            $db = DB::rescue();

            $info = array();

            if ($idFormulario === false) {
                foreach ($this->forms as $form) {
                    $idFrm = $form['idFormulario'];

                    $campos = $this->getCamposFormulario($idFrm);
                    $info[$idFrm]['nomeForm'] = $form['titulo'];
                    $info[$idFrm]['method'] = $form['method'];
                    $info[$idFrm]['process'] = $form['process'];
                    $info[$idFrm]['campos'] = $campos;
                }

            } else {
                $campos = $this->getCamposFormulario($idFormulario);
                $info['campos'] = $campos;
                $info['method'] = $this->forms[$idFormulario]['method'];
                $info['process'] = $this->forms[$idFormulario]['process'];
                $info['nomeForm'] = $this->forms[$idFormulario]['titulo'];
            }

            return $info;
        }
        
        public function errors()
        {
            //Responsável por capturar e guardar as mensagens de erro
        }

        public function getForms ($idFormulario = false, $erros = false, $template = false)
        {
            $dadosForm = $this->getDadosForms($idFormulario);
            if ($idFormulario === false) {

            }else {
                $dados = array(
                  "nomeForm" => "none",
                  "info" => $dadosForm,
                );
                
                $dados["errors"] = $erros;
                    
                ob_start();
                if ($template === false) {
                    Call::view("template/templateForm", $dados, null);
                } else {
                    Call::view("template/{$template}", $dados, null);
                }
                
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
                $campos[] = new PhpClipboardEntry($campo);
            }

            return $campos;
        }

        public static function process($post) 
        {
            $process = "";
            if (isset($post['process'])) { 
                $process = $post['process'];
                unset($post['process']);
            }
            
            $data = $post;
            ProcessPhpClipboard::processClipboard($process, $data);
        }   
    }