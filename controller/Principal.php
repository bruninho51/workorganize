<?php
    namespace controller;
    use lib\factory as factory;
    use lib\factory\FactoryModel as fModel;

    class Principal {
        
        public function index(&$respostaCtl = false){
            
            $DashboardDAO = fModel::build('DashboardDAO');
            
            //CONTERÁ DADOS PARA O PRIMEIRO GRÁFICO
            $dadosGraficoTrabalhoUsuario = [];
            
            //PERCORRERÁ RESPOSTA USANDO FETCH_ASSOC()
            $res = $DashboardDAO->getQtdeTrabalhoUsuario();
            while( $row = $res->fetch_assoc() ){
                array_push($dadosGraficoTrabalhoUsuario, $row);
            }
            
            //DADOS QUE SERÃO ENCAMINHADOS PARA A VIEW
            $dados = array(
                "title" => "Tela Principal",
                "linkCss" => "dashboard",
                "dadosGraficoTrabalhoUsuario" => $dadosGraficoTrabalhoUsuario
            );

            factory\FactoryView::view('vw_principal', $dados);
            
        }
     
        
    }


?>