<?php
    namespace helper;
    use config as config;

    final class helper {
        public static function erro404(){
            $env = config\env::getInstance();
            header('HTTP/1.0 404 Not Found');
            include "{$_SERVER['DOCUMENT_ROOT']}/{$env->config['nomeProjeto']}/error_pages/404.php";
        }    
    }
    


?>