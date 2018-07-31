function addEventosSubMenu(){
    var submenuCaixa = $("#submenuPrincipal");
    var items = $(".itemNavPart1");
    $(items).each(function(item){
        
        $(item).on('mouseover', function(e){
            let menuPrincipal = e.target;
            
            let idSubmenu = '#sm' + menuPrincipal.id.substr(1, menuPrincipal.id.length);
            
            let submenuMenuPrincipal = $(idSubmenu);
            $(submenuMenuPrincipal).css('display', 'block');
            
            $(".submenu:not(" + idSubmenu + ")").each(function(item){
                $(item).css('display', 'none');
            });
            
           $(submenuCaixa).css('display', 'block');
        });
        
        $(document).on("click", function(e){
            if( e.target.id !== 'submenuPrincipal' ) {
                $(submenuCaixa).css('display', 'none');
            }
        });
        
         //Alguns navegadores guardam a tecla pressionada na propriedade wich e outros na keyCode
         //É verificado se wich existe no objeto de evento usando o operador unário in
         //Também é possível usar o key, que aceita caracteres alfanuméricos
        $(document).on('keydown', function(e){
            if( 'wich' in e ? e.wich === 27 : e.keyCode === 27 ){
                $(submenuCaixa).css('display', 'none');
               
            }
        });
    });

}
    
    
