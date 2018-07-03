<?php

    namespace model;

    class DashboardDAO{
        
        public function getQtdeTrabalhoUsuario(){

            $sql = <<<'SQL'
            SELECT u.usuario, COUNT(t.id) AS qtdeTrabalho
            FROM usuario u
            JOIN trabalho t
            ON u.usuario = t.idUsuario
            GROUP BY u.usuario;
SQL;
            
            //EXECUTA SQL USANDO SINGLETON DB
            $res = DB::rescue()->execute($sql);
            
            return $res;
            
            
            
        }
        
        
        
    }
?>