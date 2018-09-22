<?php
    namespace controller;
    use lib\Call;
    use config as config;
    use helper as helper;

    class Login {
        
        public function index()
        {
            $env = config\env::getInstance();
            //CASO SESSÃO EXISTA, PÁGINA PRINCIPAL SERÁ CARREGADA USANDO HEADER(POIS FactoryController CARREGA SEM MUDAR URL)
            if( isset($_SESSION) && !empty($_SESION) ){
                header("location: ?mod=Principal&act=");
                
            //CASO NÃO EXISTA, VIEW DE LOGIN SERÁ CARREGADA    
            }else
            {
                
                $dados = array(
                    "title" => "Login",
                    "linkCss" => "login",
                    "semMenu" => true
                );

                Call::view('vw_login', $dados);
            }
            
            
        }
        
        public function festa()
        {
            echo 'É festaaaaaa \º/';
        }
        
        public function logar(&$respostaCtl = false)
        {
            $env = config\env::getInstance();
            //CRIA OBJETO DA MODEL USANDO FACTORYMODEL
            $usuarioDAO = Call::model('UsuarioDAO');
            $usuario = $_POST['usuario'];
            $senha = $_POST['senha'];
            
            //RESGATA OS DADOS USANDO A MODEL DA TABELA USUARIO
            $dadosUsuario = $usuarioDAO->existeUsuario($usuario);
            //SE EXISTIREM DADOS...
            if( $dadosUsuario ){
                //E A SENHA ESTIVER CORRETA...
                if( $dadosUsuario['senha'] == $senha ){
                    
                    session_start();
                    
                    $dadosMenu = "";
                    Call::controller('Menu', 'index', false, $dadosMenu);
                    
                    $_SESSION['usuario'] = $usuario;
                    $_SESSION['menu'] = serialize($dadosMenu);
                   
                    header("location: /{$env->config['nomeProjeto']}/?mod=Principal&act=");
                    $respostaCtl = true;
                    return true;
                    
                }
                
            }
            //MUDA ACT PASSADO VIA GET PARA STRING VAZIA, POIS DESSA FORMA, O PROGRAMA IRÁ PARAR NA TELA DE LOGIN, VISTO QUE MOD VALE LOGIN
            $_GET['act'] = '';
            return false;
            
        }
        
        public function logoof()
        {
            session_destroy();
            header("location: ?mod=Login&act=");
        }
     
        
    }


?>