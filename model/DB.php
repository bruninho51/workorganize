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
        
        private function __wakeup(){}
        private function __clone(){}
        
        private function __construct(){
            $env = config\env::getInstance();
            $host = $env->config['dbhost'];
            $dbusuario = $env->config['dbusuario'];
            $dbsenha = $env->config['dbsenha'];
            $dbbanco = $env->config['dbbanco'];
            $this->mysqli = new \mysqli($host, $dbusuario, $dbsenha, $dbbanco);
        }
        
        public function execute($sql){
            $res = $this->mysqli->query($sql);
            return $res;
        }
        
        public static function rescue(){
            if(self::$DB === null){    
            self::$DB = new DB();
        }
         
         return self::$DB;
        }
    }
    