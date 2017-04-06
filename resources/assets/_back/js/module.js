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
            $('#alert-zone .alert-dismissible button.close').on('click', function (event) {
                event.stopPropagation();
                $(this).parent().slideUp(200, function () {
                    $(this).parent().parent().remove();
                });

            });

            $(document).keyup(function(e) {
                if (e.keyCode === 27) {
                    $('#alert-zone .alert-dismissible button.close').trigger('click');
                }
            });
        }
    };

    var sending = {
        init : function () {

            // Link sur le fichier à envoyer
            $('a.choose-file').on('click', function (event) {
                event.preventDefault();
                $('#file-to-send').val( $(this).data('file') );
                $('#filename').text($(this).data('filename'));
                sending.showstep(2);
            });


            // Link sur les étapes
            $('ul#step-download li').on('click', 'a.link-step', function (event) {
                event.preventDefault();
                if( $(this).parent().hasClass('hightlight')){
                    sending.showstep( $(this).data('step') );
                }
            });

        },
        showstep : function (n) {
          $('ul#step-download li').removeClass("hightlight");
          for (i=0; i<=n-1; i++){
              var num = i;
              $('ul#step-download li').eq(num).addClass("hightlight");
          }


          $('.step').addClass("hidden");
          $('#step' + n).removeClass('hidden');
        }
    };
    return {
        backgrounds : backgrounds.init,
        modal       : alertmodal.init,
        sending     : sending.init
    };
})();