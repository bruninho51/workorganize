<?php
    namespace model;

    use config as config;

    class UsuarioDAO{
        
        public function get($usuario = false){
            $sql = "SELECT * FROM usuario";
            
            if($usuario)
                $sql .= " WHERE usuario = '{$usuario}'";
            
            //EXECUTA SQL USANDO SINGLETON DB
            $res = DB::rescue()->execute($sql);
            
            return $res;
            
            
        }
        
        public function existeUsuario($usuario){
            $res = $this->get($usuario);
            if( $res->num_rows == 1 ){
                return $res->fetch_assoc();
            }else{
                return false;
            }
        }
        
    }