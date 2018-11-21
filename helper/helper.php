<?php
    namespace helper;
    use config as config;

    final class helper 
    {
        public static function erro404()
        {
            $env = config\env::getInstance();
            header('HTTP/1.0 404 Not Found');
            
            $urlPrincipal = helper::URLAction("Principal", "");
            
            include "{$_SERVER['DOCUMENT_ROOT']}/{$env->config['nomeProjeto']}/error_pages/404.php";
            
        }
       
        public static function URIAction($mod, $act)
        {
            $env = config\env::getInstance();
            $url = "?mod={$mod}&act={$act}";
            return $url;
            
        }
        
        public static function URLAction($mod, $act)
        {
            $env = config\env::getInstance();
            $url = "{$_SERVER['HTTP_HOST']}/{$env->config['nomeProjeto']}/?mod={$mod}&act={$act}";
            return $url;
        }
        
        public static function buildSubmenus($menus)
        {
            $submenus = array();
            $html = "";
            
            foreach( $menus as $menu ) {
                $html = "<div class='submenu' id='sm{$menu['idMenu']}'><ul>";
                
                foreach ( $menu['submenus'] as $submenu ) {
                    $url = helper::URIAction($submenu['modulo'], $submenu['act']);
                
                    
                    $html .= "<li>"
                            . "<a href='{$url}'"
                                . "title='{$submenu['descricao']}'>{$submenu['titulo']}"
                            . "</a>"
                           . "</li>" . PHP_EOL;
                
                                
                }
                
                $html .= "</ul></div>";
                
                echo $html;
            }
            
            
            return $submenus;
            
           
        }
        
        public static function dateBrazilian($dateAmerican)
        {
            $arrDate = explode("-",$dateAmerican);
            $dateBrazilian = "{$arrDate[2]}/{$arrDate[1]}/{$arrDate[0]}";
            
            return $dateBrazilian;
        }
        
    }
    
?>