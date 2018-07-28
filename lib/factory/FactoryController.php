<?php
/*
* FACTORY DE CARREGAMENTO DE CONTROLLERS
*
* CLASSE RESPONSÁVEL POR EXECUTAR CONTROLADORES
* 
*
* AUTOR: BRUNO MENDES PIMENTA
*/
    namespace lib\factory;

    use config as config;

    class FactoryController{
        
        public static function load($nomeController, $metodo = 'index', $dados = false, &$respostaCtl = false){ 
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