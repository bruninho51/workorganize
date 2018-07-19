<?php
    class ModuloDAO extends AbstractModel
    {
        public const TABELA = 'modulo';
        private $campos;
        protected $DB;
        
        public function __get($propriedade)
        {
            return $this->$propriedade;
        }   
    }

?>