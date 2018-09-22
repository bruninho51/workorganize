<?php
namespace controller;
    use lib\Call;

    class Menu 
    {
        
        public function index(&$respostaCtl = false)
        {
            $menu = Call::model('MenuDAO');
            $dados = $menu->getMenus("1");
            
            while( $menu = $dados->fetch_assoc() ){
                
                $this->processaMenu($menu);
                
            }
            
            $respostaCtl = $this->processaMenu(true);
           
        }
        
        private function processaMenu($menu) {
            static $menuPai = 0;
            //Os índices desse array são os menus principais.
            static $menusOrg = array();
            
            //Caso parâmetro seja um array ele processa
            if( is_array($menu) ) {
                if( $menu['idMenuPai'] == $menuPai ) {
                    if( $menuPai == 0 ) {
                        //Caso o pai do menu seja 0, ele é colocado no array como menu principal.
                        $menusOrg[$menu['idMenu']] = $menu;
                        
                    }else {
                        //Caso não, ele é colocado como submenu.
                        $menusOrg[$menuPai]['submenus'][] = $menu;
                    }

                //Caso o $menuPai não bata com idMenuPai, significa que o menu acabou e está começando outro.
                }else {
                    //Porém é verificado se o idMenuPai não é 0, para que a função não crie um índice 0 no array, 
                    //pois não existe menu 0. Este é apenas para representar que o menu é principal e deve ficar na barra.
                    if( $menu['idMenuPai'] != 0 ) {
                        $menuPai = $menu['idMenuPai'];
                        //O menu é posto como submenu
                        $menusOrg[$menuPai]['submenus'][] = $menu;
                    //Mas caso seja 0, o menu é colocado como pai    
                    }else{
                        $menuPai = $menu['idMenuPai'];
                        $menusOrg[$menu['idMenu']] = $menu;
                    }
                    

                }
            //Caso parâmetro seja um booleano true, função entende que não há mais menus para processar
            //e retorna os menus organizados    
            }else if( $menu === true ) {
                
                return $menusOrg;
            }
            
        }
        
    }
        
        
?>
