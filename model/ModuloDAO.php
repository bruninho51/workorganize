<?php
    class ModuloDAO extends \model\AbstractModel
    {
        const TABELA = 'modulo';
        private $campos;
        protected $DB;
        
        public function __get($propriedade)
        {
            return $this->$propriedade;
        }   
    }

?>