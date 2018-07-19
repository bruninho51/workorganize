<?php

    namespace model;
    use lib\factory\FactoryModel as fModel;
    use model\DB as DB;
    

    class DashboardDAO
    {
        
        private $DB;
    
        public function __construct(){
            $this->DB = DB::rescue();
        }
        
        public function getQtdeTrabalhoUsuario(){
            $tabelaTrabalho = TrabalhoDAO::TABELA;
            $tabelaUsuario  = UsuarioDAO::TABELA;
            
            
            $this->DB->select($tabelaUsuario, [
                    $tabelaUsuario.'.usuario',
                    'COUNT('.$tabelaTrabalho.'.id) AS qtdeTrabalho'
            ]);
            
            
            
            $this->DB->innerJoin(
                    $tabelaTrabalho,
                    "idUsuario",
                    $tabelaUsuario,
                    "usuario"
            );
            
            $this->DB->groupBy(
                    $tabelaUsuario, 
                    "usuario"
            );
            
            //EXECUTA SQL USANDO SINGLETON DB
            $res = $this->DB->execute();
            return $res;
            
            
            
        }
        
        public function getQtdeTrabalhoRealizadoNaoRealizado(){
            
            
            $this->DB->select(TrabalhoDAO::TABELA, [
                    "COUNT(id) AS qtde"
            ]);
            
            $this->DB->groupBy(
                    null, 
                    "realizado"
            );
            
            $this->DB->orderBy(
                    null, 
                    "1", 
                    "DESC"
            );
            
            //EXECUTA SQL USANDO SINGLETON DB
            $res = $this->DB->execute();
            
            return $res;
            
        }
        
        public function getTrabalhoRealizadoUsuario70Dias(){
            
            
        }
        
        public function getTrabalhoRealizadoUltimos12Meses(){

            $realizado = 1;
            $datas = array();
            $mes = (int) date('m');
            $ano = (int) date('Y');
            $dia = (int) date('d');
            $pilhaSql = array();
            $dados = array();

            //FOR RESPONSÁVEL POR PROCESSAR AS FAIXAS DE DATA DOS ÚLTIMOS 12 MESES
            for($i=1;$i<=12;$i++)
            {
                $this->DB->clear();
                
                $datas[$i]['max'] = new \DateTime("{$ano}-{$mes}-{$dia}");
                $datas[$i]['min'] = new \DateTime("{$ano}-{$mes}-01");
                
                $this->DB->select(UsuarioDAO::TABELA, [
                        UsuarioDAO::TABELA.'.usuario', 
                        'COUNT('.TrabalhoDAO::TABELA.'.id) AS \''.$i.'\''
                ]);
                
                $this->DB->innerJoin(
                        TrabalhoDAO::TABELA, 
                        "idUsuario", 
                        UsuarioDAO::TABELA, 
                        "usuario"
                );
                
                $this->DB->where(
                        TrabalhoDAO::TABELA, 
                        "realizado", 
                        "=", 
                        (string)$realizado
                );
                
                $this->DB->where(
                        TrabalhoDAO::TABELA, 
                        "dataTermino", 
                        "<=", 
                        "'{$datas[$i]['max']->format('Y-m-d')}'"
                );
                
                $this->DB->where(
                        TrabalhoDAO::TABELA, 
                        "dataTermino", 
                        ">=", 
                        "'{$datas[$i]['min']->format('Y-m-d')}'"
                );
                
                $this->DB->groupBy(
                        UsuarioDAO::TABELA, 
                        "usuario"
                );
                
                echo $this->DB->sql();
                
                $mes--;
                
                if($mes == 0){
                    $mes = 12;
                    $ano--;
                }
                $dia = date('t', $ano.'-'.$mes.'-'.$dia);
                
                array_push($pilhaSql,$this->DB->sql());
            }
            for($j=0;$j<count($pilhaSql);$j++){
                $res = $this->DB->execute($pilhaSql[$j]);
                while( $linha = $res->fetch_assoc() ){
                    $dados[$linha['usuario']][$j+1] = $linha[$j];
                }
            }
            
            return $dados;
            
            
        }
        
        
    }
?>