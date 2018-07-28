<?php
    namespace model;

    class ModuloDAO extends \model\AbstractModel
    {
        const TABELA = 'modulo';
        private $campos;
        
        public function __construct()
        {
            parent::__construct();
            $this->tabela = self::TABELA;
            
        }
        
        public function __get($propriedade)
        {
            return $this->$propriedade;
        }   
        
        public function getModulos($id = false)
        {
            $this->select(["id", "modulo", "act", "descricao"]);
            if ( $id ){
                $this->where("id", "=", $id);
            }
            //$this->where("");
            $dadosModulos = $this->execute();
            $modulos = array();
            
            while( $modulo = $dadosModulos->fetch_assoc() ){
                array_push($modulos, $modulo);
            }
            
            return $modulos;
            
        }
    }

?>