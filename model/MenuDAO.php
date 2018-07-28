<?php
    namespace model;
    
    class MenuDAO extends \model\AbstractModel
    {
        const TABELA = 'menu';
        private $campos;
        
        public function __construct()
        {
            parent::__construct();
            $this->tabela = self::TABELA;
        }
        
        public function getMenus($tipoPerfilUsuario)
        {
            if( is_numeric($tipoPerfilUsuario) && $tipoPerfilUsuario ){
                
                $this->select([
                    "menu.id AS 'idMenu'",
                    "menu.idMenuPai",
                    "menu.titulo",
                    "modulo.modulo",
                    "modulo.act",
                    "modulo.descricao"
                ]);
                
                $this->innerJoin(
                        ModuloDAO::TABELA, "id",
                        self::TABELA, "idModulo" 
                );

                $this->innerJoin(
                        TipoPerfilModuloDAO::TABELA, "idModulo", 
                        ModuloDAO::TABELA, "id"
                );
                
                $this->whereTable("tipoPerfilModulo", "idTipoPerfil", "=", $tipoPerfilUsuario);
                
                return $this->execute();
                
            }else{
                throw new \Exception("Erro de autenticação. Os menus não puderam ser obtidos.");
            }
            
        }
        
    }

?>

