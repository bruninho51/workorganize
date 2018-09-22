<?php use lib\Call;?>
<?php Call::js("subMenu")?>
<?php $menus = unserialize($_SESSION['menu'])?>
<nav id="navPrincipal">
    <div id="menuPrincipal">
        <div id="navParte1">
            <h1><a href='/<?php echo $env->config['nomeProjeto']?>'><img src="#" alt="WorkOrganize"></a></h1>
            <ul>
                <?php foreach( $menus as $menu ) : ?>
                <li><a class="itemNavPart1" id="m<?php echo $menu['idMenu']?>" href="<?php echo $menu['modulo']?>"><?php echo $menu['titulo']?></a></li>
                <?php endforeach;?>
                
            </ul>
        </div>
        <div id="navParte2">
            <ul>
                <li><a href='<?php echo "/{$env->config['nomeProjeto']}/?mod=Login&act=logoof"?>'>Logoff</a></li>
            </ul>
        </div>
    </div>    
    
    <div id="submenuPrincipal">
        <div id="submenuPrincipalFlex">
            <?php \helper\helper::buildSubmenus($menus)?>
        </div>
    </div>
    
    <script>
        //ADICIONA OS EVENTOS MOUSEUP E MOUSEOUT NOS LINKS DA NAVPART1,
        //PARA ABRIR O SUBMENU
        addEventosSubMenu.call(this);
    </script>
    
</nav>