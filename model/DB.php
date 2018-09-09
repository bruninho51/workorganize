<?php
    namespace model;
    
    use config as config;

    class DB{
        private static $DB;
        private $host;
        private $dbusuario;
        private $dbsenha;
        private $dbbanco;
        private $mysqli;
        //private $query;
        public $crud;
        
        private function __wakeup(){}
        private function __clone(){}
        
        private function __construct(){
            $env = config\env::getInstance();
            $host = $env->config['dbhost'];
            $dbusuario = $env->config['dbusuario'];
            $dbsenha = $env->config['dbsenha'];
            $dbbanco = $env->config['dbbanco'];
            $this->mysqli = new \mysqli($host, $dbusuario, $dbsenha, $dbbanco);
            $this->mysqli->set_charset('utf8');
            
            if( $this->mysqli === false ){
                $nomeProjeto = config\env::getInstance()->config['nomeProjeto'];
                throw new \Exception("Falha na conexão com o banco de dados de {$nomeProjeto}");
            }
            
            $this->crud = new CRUD();
        }
        
        public function execute($sql){
            if( gettype( $sql ) === 'string' ){
                $res = $this->mysqli->query($sql);
                return $res;
            }else if( gettype($sql) === 'object' && get_class($sql) === 'model\CRUD' ){
                
                $query = $sql->sql();
                if( !$query === false ){
                    $res = $this->mysqli->query($query);
                    $sql->clear();
                    return $res;    
                }else{
                    return false;
                }
                
            }
            
        }
        
        public static function rescue(){
            if(self::$DB === null){    
            self::$DB = new DB();
        }
         
         return self::$DB;
        }
        
        
    }