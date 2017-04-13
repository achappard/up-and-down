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
        init : function ( init_obj) {



            var nowTemp = new Date();

            var date_d = ( nowTemp.getDate() < 10 ? "0" + nowTemp.getDate() : nowTemp.getDate() ),
                date_m = ( (nowTemp.getMonth() + 1) < 10 ? "0" + (nowTemp.getMonth() + 1) : (nowTemp.getMonth() + 1) ),
                date_y = nowTemp.getFullYear();

           console.log(date_d + '/' + date_m + '/' +  date_y);


            $('#datepicker').datepicker({
                autoclose: true,
                format: "dd/mm/yyyy",
                language: 'fr',
                //startDate: "12/04/2017",
                startDate: date_d + '/' + date_m + '/' +  date_y
            });



            // Le formulaire contient-il des erreurs
            if(init_obj.has_error === undefined){
                init_obj.has_error = false;
            }

            /**
             * Détection du changement du hash
             */
            $(window).hashchange( function(){
                var hash = location.hash;

                // Si le form a été soumis et qu'il y a des erreurs
                // alors on va direct à l'étape 2
                if (hash === "" && init_obj.has_error == '1'){
                    location.hash = "#step2";

                }

                var stepNum = (hash === "" ? 0 : hash.substr(5,1)) ;

                console.log("stepNum = " + stepNum);
                // Attention si l'étape est la numéro 2, il faut s'assurer qu'un document à bien été
                // sélectionner en étape 1
                if(stepNum === '2'){
                    if ( $('#file-to-send-input').val() === "" ){
                        location.hash = "#step1";
                    }else{
                        $('#filename').text($('#file-name-input').val());

                    }
                }

                if( stepNum === '3' ){
                   if(init_obj.store_download_success != '1' ){
                       location.hash = "#step2";
                   }
                }


                sending.showstep(stepNum);
            });

            /**
             * Trigger hash change
             */
            $(window).hashchange();

            /**
             * Au clic sur un document, on rempli le formulaire
             */
            $('a.choose-file').on('click', function (event) {
                $('#file-to-send-input').val( $(this).data('file') );
                $('#file-name-input').val( $(this).data('filename') );

                $('#filename').text($(this).data('filename'));
                $('#filesize').text( '(' + $(this).data('filesize') + ')');
            });


            // Link sur les étapes
            $('ul#step-download li').on('click', 'a.link-step', function (event) {

                if( ! $(this).parent().hasClass('hightlight')){
                    event.preventDefault();
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