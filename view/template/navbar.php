<?php lib\factory\FactoryJS::js("subMenu")?>
<nav id="navPrincipal">
    <div id="menuPrincipal">
        <div id="navParte1">
            <h1><img src="#" alt="WorkOrganize"></h1>
            <ul>
                <li><a class="itemNavPart1" href="#">Link 1</a></li>
                <li><a class="itemNavPart1" href="#">Link 2</a></li>
                <li><a class="itemNavPart1" href="#">Link 3</a></li>
                <li><a class="itemNavPart1" href="#">Link 4</a></li>
            </ul>
        </div>
        <div id="navParte2">
            <ul>
                <li><a href='<?php echo "/{$env->config['nomeProjeto']}/?mod=Login&act=logoof"?>'>Logoff</a></li>
            </ul>
        </div>
    </div>    
    
    <div id="submenuPrincipal">
        
    </div>

    <script>
        //ADICIONA OS EVENTOS MOUSEUP E MOUSEOUT NOS LINKS DA NAVPART1,
        //PARA ABRIR O SUBMENU
        addEventosSubMenu.call(this);
    </script>
    
</nav>