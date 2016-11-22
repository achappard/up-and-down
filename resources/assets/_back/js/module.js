var adminUp = (function() {
    /**
     * Initialisation de la navigation principale
     * @type {{init: main_nav.init}}
     */
    var test = {
        init : function () {
            console.log("Init de l'objet test !");
        }
    };
    return {
        test : test.init

    };
})();