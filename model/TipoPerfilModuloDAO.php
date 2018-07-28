<?php
    namespace model;
    
    class TipoPerfilModuloDAO extends \model\AbstractModel
    {
        const TABELA = 'tipoPerfilModulo';
        private $campos;
        
        public function __construct()
        {
            parent::__construct();
            $this->tabela = self::TABELA;
            
        }
        
    }
?>