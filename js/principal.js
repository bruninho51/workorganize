$(document).ready(function(){
    //Personaliza os checkbox do site
    $('input[type=checkbox]').ionCheckRadio();
    $('input[type=date]').pickadate({
        monthsFull: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
        today: 'Agora',
        clear: 'Limpar',
        close: 'Sair',
        formatSubmit: 'yyyy/mm/dd'
    });
    $('body').niceScroll({
        cursorwidth:8,
        cursoropacitymin:0.6,
        cursorcolor:'#000',
        cursorborder:'none',
        cursorborderradius:4,
        autohidemode:'leave'
    });


});