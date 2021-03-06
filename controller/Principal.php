<?php
    namespace controller;
    use lib as lib;
    use lib\Call;
    use model\DB as DB;

    class Principal {
        
        public function index(&$respostaCtl = false){
            
            $DashboardDAO = Call::model('DashboardDAO');
            
            //CONTERÁ DADOS PARA O PRIMEIRO GRÁFICO
            $dadosGraficoTrabalhoUsuario = [];
            //CONTERÁ DADOS PARA O SEGUNDO GRÁFICO
            $dadosGraficoTrabalhoRealizadoNaoRealizado = [];
            //CONTERÁ DADOS PARA O TERCEIRO GRÁFICO
            $dadosGraficoTrabalhoRealizadoUsuario70Dias = [];
            
            //PERCORRERÁ RESPOSTA USANDO FETCH_ASSOC() -- PRIMEIRO GRÁFICO
            $res = $DashboardDAO->getQtdeTrabalhoUsuario();
            while( $row = $res->fetch_assoc() ){
                array_push($dadosGraficoTrabalhoUsuario, $row);
            }
            
            //PERCORRERÁ RESPOSTA USANDO FETCH_ASSOC() -- SEGUNDO GRÁFICO
            $res = $DashboardDAO->getQtdeTrabalhoRealizadoNaoRealizado();
            while( $row = $res->fetch_assoc() ){
                array_push($dadosGraficoTrabalhoRealizadoNaoRealizado, $row);
            }
            
            //DADOS -- TERCEIRO GRÁFICO
            $getTrabalhoRealizadoUltimos12Meses = $DashboardDAO->getTrabalhoRealizadoUltimos12Meses();
            
            
            //DADOS QUE SERÃO ENCAMINHADOS PARA A VIEW
            $dados = array(
                "title" => "Tela Principal",
                "linkCss" => "dashboard",
                "dadosGraficoTrabalhoUsuario" => $dadosGraficoTrabalhoUsuario,
                "dadosGraficoTrabalhoRealizadoNaoRealizado" => $dadosGraficoTrabalhoRealizadoNaoRealizado,
                "getTrabalhoRealizadoUltimos12Meses" => $getTrabalhoRealizadoUltimos12Meses
            );

            Call::view('vw_principal', $dados);
            
        }
     
        
    }


?>