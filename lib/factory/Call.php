<?php
/*
* FACTORY DE CARREGAMENTO
*
* CLASSE RESPONSÁVEL POR CARREGAR CONTROLES, MODELS, VIEWS, CSS, JS..
* 
*
* AUTOR: BRUNO MENDES PIMENTA
*/
    namespace lib;

    use config as config;

    class Call{

        public static function view($view, $dados, $template = 'template'){            
            $env = config\env::getInstance(); //INSTÂNCIA DO SINGLETON RESPONSÁVEL PELAS CONFIGURAÇÕES
            //CRIA VARIÁVEIS PARA A VIEW
            foreach($dados as $nomeVar => $value){
                $$nomeVar = $value;
            }
            //CRIA VARIÁVEL $conteudo CONTENDO A VIEW
            if (!array_key_exists("conteudo", $dados)) {
                ob_start();
                include_once("{$_SERVER['DOCUMENT_ROOT']}/{$env->config["nomeProjeto"]}/view/{$view}.php");
                $conteudo = ob_get_contents();
                ob_end_clean();
            }else{
                $conteudo = $dados['conteudo'];
            }
            
            //INCLUI TEMPLATE
            if ($template != null) {
                include_once("{$_SERVER['DOCUMENT_ROOT']}/{$env->config["nomeProjeto"]}/view/template/{$template}.php");
            }else{
                echo $conteudo;
            }
            
        }

        public static function model($model){
            $env = config\env::getInstance(); //INSTÂNCIA DO SINGLETON RESPONSÁVEL PELAS CONFIGURAÇÕES
            $class = "\\model\\{$model}";
            
           try{
             $obj = new $class();
           } catch (Exception $ex){
               echo $ex->getMessage();
               die();
           }
            
            
            return $obj;
        }

        public static function js($nomeArquivo, $returnVar = false){
            $env = config\env::getInstance();
            $tempo = time();
            $enderecoArquivo = "js/{$nomeArquivo}.js?{$tempo}";
            if ($returnVar) {
                return "<script src='{$enderecoArquivo}'></script>".PHP_EOL;
            } else {
                echo "<script src='{$enderecoArquivo}'></script>".PHP_EOL;
            }
            
        }

        public static function css($css, $tag = false){
            
            $linkCss = "view/assets/css/{$css}.css?" . time();
            if ($tag) {
                $linkCss = "<link rel='stylesheet' href='{$linkCss}'>";
            }
            return $linkCss;
            
        }
        
        public static function controller($nomeController, $metodo = 'index', $dados = false, &$respostaCtl = false){ 
            $metodo = ($metodo == '') ? 'index' : $metodo;
            
            $env = config\env::getInstance(); //INSTÂNCIA DO SINGLETON RESPONSÁVEL PELAS CONFIGURAÇÕES
            
            //VERIFICA SE O CONTROLADOR INFORMADO EXISTE
            if( self::controller_exists($nomeController) && self::act_exists($nomeController, $metodo) ){
                $class = "\\controller\\{$nomeController}";
                $controllerObj = new $class;

                if($dados == false){
                    $controllerObj->$metodo($respostaCtl);
                }else{
                    $controllerObj->$metodo($dados, $respostaCtl);
                }
                
                return true;
                
            }
            
            return false;
            
        }
        
        private static function controller_exists($nomeController){
            $env = config\env::getInstance(); //INSTÂNCIA DO SINGLETON RESPONSÁVEL PELAS CONFIGURAÇÕES
            
            $dir = scandir("{$_SERVER['DOCUMENT_ROOT']}/{$env->config['nomeProjeto']}/controller/");
            $existe = false;
            foreach($dir as $item){
                if( $item == "{$nomeController}.php" ){
                    $existe = true;
                    break;
                }
            }
            
            return $existe;
            
        }
        
        
        private static function act_exists($nomeController, $metodo){
            $class = "\\controller\\{$nomeController}";
            
            //SE MÉTODO EXISTIR NA CLASSE...
            if(method_exists($class, $metodo)){
                //REFLECTION É USADO PARA CHECAR SE O MÉTODO É PÚBLICO
                $reflector = new \ReflectionClass($class);
                $metReflection = $reflector->getMethod($metodo);
                
                //O ACT SÓ PODERÁ SER ACESSADO SE ELE FOR ṔÚBLICO. ISSO IMPEDIRÁ
                //QUE O USUÁRIO ACESSE TODOS OS MÉTODOS DOS CONTROLADORES
                //TRAZENDO MAIS SEGURANÇA PARA A APLICAÇÃO
                return $metReflection->isPublic();
                
            }else{
                return false;
            }
            
                
            
        }
        
        
    }

?>