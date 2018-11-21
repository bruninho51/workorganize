<?php
    namespace model;
    use config as config;
    use interfaces\iModel as iModel;

    class TrabalhoDAO extends \model\AbstractModel
    {
        const TABELA = 'trabalho';
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
        
        public function getTrabalhos($usuario = false)
        {
            $this->select('*');
            if ($usuario) {
                $this->where('idUsuario', '=', $usuario);
            }
            $trabalhos = $this->execute();
            
            return $trabalhos;
        }
        
    }