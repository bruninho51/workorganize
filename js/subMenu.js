function addEventosSubMenu(){
    var submenuCaixa = document.getElementById("submenuPrincipal");
    var items = document.querySelectorAll(".itemNavPart1");
    items.forEach(function(item){
        item.addEventListener('mouseover', function(e){
            let menuPrincipal = e.target;
            
            let idSubmenu = 'sm' + menuPrincipal.id.substr(1, menuPrincipal.id.length);
            
            let submenuMenuPrincipal = document.getElementById(idSubmenu);
            submenuMenuPrincipal.style.display = 'block';
            
            document.querySelectorAll(".submenu:not(#"+ idSubmenu + ")").forEach(function(item){
                item.style.display = 'none';
            });
            
            submenuCaixa.style.display = 'block';
            
        });
        
        document.addEventListener("click", function(e){
            if( e.target.id !== 'submenuPrincipal' ) {
                submenuCaixa.style.display = 'none';
            }
        });
        
        document.body.addEventListener('keydown', function(e){
            //Alguns navegadores guardam a tecla pressionada na propriedade wich e outros na keyCode
            //É verificado se wich existe no objeto de evento usando o operador unário in
            //Também é possível usar o key, que aceita caracteres alfanuméricos
            if( 'wich' in e ? e.wich === 27 : e.keyCode === 27 ){
                submenuCaixa.style.display = 'none';
            }
        });
    });


}
    
    
