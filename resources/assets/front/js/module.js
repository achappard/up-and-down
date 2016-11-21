var upanddown = (function() {
    /**
     * Initialisation de la navigation principale
     * @type {{init: main_nav.init}}
     */
    var main_nav = {
        init : function(current_viewport){
            $("#toggle-mobile-menu").on('click', function () {
               if( $(this).hasClass("open") ){
                   $(this).removeClass("open");
                   $(this).next('#main-nav').removeClass('open');
               }else{
                   $(this).addClass("open").
                   $(this).next('#main-nav').addClass('open');
               }
            });
        },
    };


    return {
        init_main_navigation : main_nav.init,
    };
})();