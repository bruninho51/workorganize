<?php
    namespace model;
    use config as config;
    use interfaces\iModel as iModel;

    class TrabalhoDAO extends AbstractModel
    {
        public const TABELA = 'trabalho';
        private $campos;
        protected $DB;
        
        public function __get($propriedade)
        {
            return $this->$propriedade;
        }
        
        
    }



?>