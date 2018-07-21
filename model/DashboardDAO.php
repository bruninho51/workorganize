<?php

    namespace model;
    use lib\factory\FactoryModel as fModel;
    use model\DB;
    use model\CRUD;
    

    class DashboardDAO
    {
        
        private $DB;
    
        public function __construct(){
            $this->DB = DB::rescue();
        }
        
        public function getQtdeTrabalhoUsuario(){
            $tabelaTrabalho = TrabalhoDAO::TABELA;
            $tabelaUsuario  = UsuarioDAO::TABELA;
            
            $crud = CRUD::build();
            
            
            $crud->select($tabelaUsuario, [
                    $tabelaUsuario.'.usuario',
                    'COUNT('.$tabelaTrabalho.'.id) AS qtdeTrabalho'
            ]);
            
            $crud->innerJoin(
                    $tabelaTrabalho,
                    "idUsuario",
                    $tabelaUsuario,
                    "usuario"
            );
            
            $crud->groupBy(
                    $tabelaUsuario, 
                    "usuario"
            );
            
            //EXECUTA SQL USANDO SINGLETON DB
            $res = $this->DB->execute($crud);
            return $res;
            
            
            
        }
        
        public function getQtdeTrabalhoRealizadoNaoRealizado(){
            
            $crud = CRUD::build();
            
            $crud->select(TrabalhoDAO::TABELA, [
                    "COUNT(id) AS qtde"
            ]);
            
            $crud->groupBy(
                    null, 
                    "realizado"
            );
            
            $crud->orderBy(
                    null, 
                    "1", 
                    "DESC"
            );
            
            //EXECUTA SQL USANDO SINGLETON DB
            $res = $this->DB->execute($crud);
            
            return $res;
            
        }
        
        public function getTrabalhoRealizadoUsuario70Dias(){
            
            
        }
        
        public function getTrabalhoRealizadoUltimos12Meses(){

            $crud = CRUD::build();
                
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
                $crud->clear();
                
                $datas[$i]['max'] = new \DateTime("{$ano}-{$mes}-{$dia}");
                $datas[$i]['min'] = new \DateTime("{$ano}-{$mes}-01");
                
                $crud->select(UsuarioDAO::TABELA, [
                        UsuarioDAO::TABELA.'.usuario', 
                        'COUNT('.TrabalhoDAO::TABELA.'.id) AS \''.$i.'\''
                ]);
                
                $crud->innerJoin(
                        TrabalhoDAO::TABELA, 
                        "idUsuario", 
                        UsuarioDAO::TABELA, 
                        "usuario"
                );
                
                $crud->where(
                        TrabalhoDAO::TABELA, 
                        "realizado", 
                        "=", 
                        (string)$realizado
                );
                
                $crud->where(
                        TrabalhoDAO::TABELA, 
                        "dataTermino", 
                        "<=", 
                        "'{$datas[$i]['max']->format('Y-m-d')}'"
                );
                
                $crud->where(
                        TrabalhoDAO::TABELA, 
                        "dataTermino", 
                        ">=", 
                        "'{$datas[$i]['min']->format('Y-m-d')}'"
                );
                
                $crud->groupBy(
                        UsuarioDAO::TABELA, 
                        "usuario"
                );
                
                $mes--;
                
                if($mes == 0){
                    $mes = 12;
                    $ano--;
                }
                $dia = date('t', $ano.'-'.$mes.'-'.$dia);
                
                array_push($pilhaSql,$crud->sql());
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