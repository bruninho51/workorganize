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
    use controller as controller;

    class FactoryController{
        
        public static function load($nomeController, $metodo = 'index', $dados = false){ 
            $metodo = ($metodo == '') ? 'index' : $metodo;
            
            $env = config\env::getInstance(); //INSTÂNCIA DO SINGLETON RESPONSÁVEL PELAS CONFIGURAÇÕES
            
            //VERIFICA SE O CONTROLADOR INFORMADO EXISTE
            if( self::controller_exists($nomeController) && self::act_exists($nomeController, $metodo) ){
                $class = "\\controller\\{$nomeController}";
                $controllerObj = new $class;

                if($dados == false){
                    @call_user_func( $controllerObj->$metodo() );

                }else{
                    call_user_func_array($controllerObj->$metodo(), $dados);
                }
                
                return true;
                
            }
            
            return false;
            
        }
        
        function controller_exists($nomeController){
            $env = config\env::getInstance(); //INSTÂNCIA DO SINGLETON RESPONSÁVEL PELAS CONFIGURAÇÕES
            
            $dir = scandir("{$_SERVER['DOCUMENT_ROOT']}/{$env->config['nomeProjeto']}/controller/");
            $existe = false;
            foreach($dir as $item){
                if( $item == "{$nomeController}.php" ){
                    $existe = true;
                }
            }
            
            return $existe;
            
        }
        
        
        function act_exists($nomeController, $metodo){
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