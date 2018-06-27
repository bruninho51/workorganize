<?php
/*
* FACTORY DE EXIBIÇÃO DE VIEW
*
* CLASSE RESPONSÁVEL POR PROCESSAR E INSERIR AS VIEWS
* 
*
* AUTOR: BRUNO MENDES PIMENTA
*/
    namespace lib\factory;

    use config as config;

    class FactoryView{
        
        public static function view($view, $dados, $template = 'template'){            
            $env = config\env::getInstance(); //INSTÂNCIA DO SINGLETON RESPONSÁVEL PELAS CONFIGURAÇÕES
            
            //CRIA VARIÁVEIS PARA A VIEW
            foreach($dados as $nomeVar => $value){
                $$nomeVar = $value;
            }
            //CRIA VARIÁVEL $conteudo CONTENDO A VIEW
            ob_start();
            include_once("{$_SERVER['DOCUMENT_ROOT']}/{$env->config["nomeProjeto"]}/view/{$view}.php");
            $conteudo = ob_get_contents();
            ob_end_clean();
            
            //INCLUI TEMPLATE
            include_once("{$_SERVER['DOCUMENT_ROOT']}/{$env->config["nomeProjeto"]}/view/template/{$template}.php");
            
        }
        
    }

?>