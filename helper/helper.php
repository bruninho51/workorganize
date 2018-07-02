<?php
    namespace helper;
    use config as config;

    final class helper {
        public static function erro404(){
            $env = config\env::getInstance();
            header('HTTP/1.0 404 Not Found');
            include "{$_SERVER['DOCUMENT_ROOT']}/{$env->config['nomeProjeto']}/error_pages/404.php";
        }   
        
        public static function URLAction($mod, $act){
            $env = config\env::getInstance();
            $url = "{$_SERVER['HTTP_HOST']}/{$env->config['nomeProjeto']}/?mod={$mod}&act={$act}";
            return $url;
        }
        
        public static function highcharts(){
            
            <script src="https://code.highcharts.com/highcharts.src.js"></script>
            
        }
            
        
    }
    


?>