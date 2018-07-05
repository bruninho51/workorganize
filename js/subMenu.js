function addEventosSubMenu(){
    var submenu = document.getElementById("submenuPrincipal");
    var items = document.querySelectorAll(".itemNavPart1");
    items.forEach(function(item){
        item.addEventListener('mouseover', function(){
            submenu.style.display = 'block';
        });
        item.addEventListener('mouseout', function(item){
            submenu.style.display = 'none';
        });
    });


}
    
    
