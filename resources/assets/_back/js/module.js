var adminUp = (function() {
    /**
     * Initialisation de la navigation principale
     * @type {{init: main_nav.init}}
     */
    var backgrounds = {
        init : function () {
            $('#deleteBackgroundModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var idBackground = button.data('idbackground');
                var formDelete = $("#deleteBackgroundForm");
                var action = formDelete.attr('action');
                var re = /background-management\/+\d+/g;
                var newaction = action.replace(re, "background-management/" + idBackground);
                formDelete.attr('action', newaction);
            });


        }
    };

    var alertmodal = {
        init : function () {
            $('#alert-zone .alert button.close').on('click', function (event) {
                event.stopPropagation();
                $(this).parent().slideUp(200, function () {
                    $(this).parent().parent().remove();
                });
            });

            $(document).keyup(function(e) {
                if (e.keyCode === 27) {
                    $('#alert-zone .alert button.close').trigger('click');
                }
            });
        }
    };
    return {
        backgrounds : backgrounds.init,
        modal : alertmodal.init
    };
})();