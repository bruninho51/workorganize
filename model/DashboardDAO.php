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
        
        public function getQtdeTrabalhoRealizadoNaoRealizado(){
            $sql = <<<'SQL'
            SELECT COUNT(id) AS qtde 
            FROM trabalho
            GROUP BY realizado 
            ORDER BY 1 DESC;
SQL;
            
            //EXECUTA SQL USANDO SINGLETON DB
            $res = DB::rescue()->execute($sql);
            
            return $res;
            
        }
        
        public function getTrabalhoRealizadoUsuario70Dias(){
            $sql = <<<'SQL'
            SELECT u.usuario, IFNULL(COUNT(t.id), 0) AS qtdeRealizada
            FROM trabalho t
            JOIN usuario u
            ON u.usuario = t.idUsuario
            WHERE t.dataFim >= NOW() - INTERVAL 70 DAY OR t.dataFim <= NOW() 
            AND t.realizado = 1
            GROUP BY u.usuario;
SQL;
            
            //EXECUTA SQL USANDO SINGLETON DB
            $res = DB::rescue()->execute($sql);
            
            return $res;
            
        }
        
        
        
    }
?>