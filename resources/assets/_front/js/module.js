var upanddown = (function() {
    /**
     * Initialisation de la navigation principale
     * @type {{init: main_nav.init}}
     */
    var vegas_slideshow = {
        backgroundList : [],
        init : function () {
            console.log(vegas_slideshow.backgroundList);

            $("body").vegas({
                shuffle :true,
                delay: 30000,
                timer: false,
                color: '#000000',
                transition: 'fade',
                firstTransitionDuration: 1,
                slides: vegas_slideshow.backgroundList
            });
        }
    };
    return {
        vegas_slideshow : vegas_slideshow
    };
})();