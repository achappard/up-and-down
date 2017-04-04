var upanddown = (function() {
    /**
     * Initialisation de la navigation principale
     * @type {{init: main_nav.init}}
     */
    var vegas_slideshow = {
        backgroundList : [],
        init : function () {
            // console.log(vegas_slideshow.backgroundList);
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

    var upload_form = {
        progress_loader: null,
        uploadProcess : null,
        uploadlist:[],
        block_add_input: false,
        addtional_input_file: '<input class="inputMyFile hidden" type="file" id="" name="myfiles[]" multiple>',

        /**
         * Initialise l'uplaod (lance les écouteurs, etc..)
         */
        init : function () {

            // CRéation du loader circulaire
            upload_form.progress_loader = $('#divProgress').circleProgress({
                value: 0,
                size: 170,
                thickness: 10,
                lineCap : "round",
                startAngle: -Math.PI / 4 * 2,
                fill: { color: "#3F9FFF" }
            });


            if (window.File && window.FileReader && window.FileList && window.Blob) {
                // Great success! All the File APIs are supported.
            } else {
                alert('The File APIs are not fully supported in this browser.');
            }


            // Click d'ajout de champs input file
            $("#addFilesToUpload_first, .addMoreFilesToUpload").on('click', upload_form.add_new_input_file);

            // Selection de fichier depuis la fenetre de dialogue
            $( "#input-file-wrapper" ).on( "change", ".inputMyFile", upload_form.files_selected );

            // Suppresion de fichier de la liste
            $( "#filesZone" ).on( "click", "div.delete-line span.remove_file", upload_form.remove_file);

            $("#cancelUpload").on('click', upload_form.cancelUpload);

            // Soumission du formulaire
            // $("#submit-upload").attr('disabled', 'disabled');
            $("#uploadForm").on('submit', function(event){
                event.preventDefault();
                event.stopImmediatePropagation();

                // Vérification du formulaire
                var email_to            = $("#inputTo").val(),
                    email_message       = $("#inputMessage").val(),
                    filesList           = [];

                for( var i = 0; i<upload_form.uploadlist.length; i++ ){
                    tab = upload_form.uploadlist[i];
                    for( var j = 0; j<upload_form.uploadlist[i].length; j++ ){
                        filesList.push(upload_form.uploadlist[i][j]);
                    }
                }

                var form_check = upload_form.checkform(email_to, email_message, filesList);

                if ( form_check.is_valid ){
                    console.log("oooo");
                    $("#uploadForm, #file-list").hide();
                    $("#transfert").show();


                    $('#input-file-wrapper').fileupload({
                        singleFileUploads : false,
                        maxChunkSize: 20000000, // 10 MB
                        formData: {
                            to          : $("#inputTo").val(),
                            message     : $("#inputMessage").val(),
                            _token      : $('meta[name="csrf-token"]').attr('content')

                        },
                        progressall: function (e, data) {
                            var progress = parseInt(data.loaded / data.total * 100, 10);
                            // upload_form.progress_loader.setPercent(progress).draw();
                            $("#pcentValue").text(progress + "%");
                            upload_form.progress_loader.circleProgress('value', progress/100);
                        }
                    });

                    // Ajout des fichiers
                    upload_form.uploadProcess = $("#input-file-wrapper").fileupload(
                        'send',
                        {
                            files: filesList,
                        }
                    )
                    .success(function (result, textStatus, jqXHR) {

                        upload_form.saveInDb(result);
                    })
                    .error(function (jqXHR, textStatus, errorThrown) {
                        $("#transfert").hide();
                        $("#error_transfert").show();
                        console.log("Erreur lors de l'upload en Ajax : Code erreur = " + errorThrown + '---'  );
                        switch (errorThrown){
                            case "Internal Server Error" :
                                $("#error-reason").text("Erreur 500 du serveur");
                                break;
                            case "abort" :
                                $("#error-reason").text("Abandon de l'utilisateur");
                                break;
                            default :
                                $("#error-reason").text("Erreur interne");
                                break;
                        }
                    });
                }
            });

        },
        /**
         * Requete Ajax pour sauvegarder en bdd les fichiers de l'upload et l'objet upload avec la liste des fichiers correspondant
         * @param res
         */
        saveInDb : function (res) {
            console.log("// Requete Ajax pour sauvegarder en bdd les fichiers de l'upload et l'objet upload avec la liste des fichiers correspondant");
            console.log(res);
            res._token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                method: "POST",
                url: $("#uploadForm").data('storeuploadurl'),
                data: res
            })
            .done(function( msg ) {
                console.log("Fini !!!");
                console.log(msg);
            });

            // On affiche le succes de l'opération
            $("#transfert").hide();
            $("#finish_transfert").show();
            console.log("hihaaaa");


        },
        cancelUpload : function (event){
            event.preventDefault();
            upload_form.uploadProcess.abort();
        },
        /**
         * Vérification du formulaire
         */
        checkform : function (email_to, email_message, filesList) {
            var errors = [];
            var fileListValidator = validateForm.validate(
                filesList,
                ['array_length_moreEqual_1'],
                ['Veuillez sélectionner au moins un fichier à envoyer']
            );
            if(fileListValidator.is_valid === false ){
                errors.push({
                    field : 'upload',
                    error :  fileListValidator.reason
                });
            }


            var emailValidator = validateForm.validate(
                email_to,
                [
                    'required',
                    'email'
                ],
                [
                    'Veuillez saisir une adresse email pour le destinataire',
                    'Veuillez saisir une adresse email valide pour le destinataire'
                ]
            );

            if( !emailValidator.is_valid ){
                errors.push({
                    field : 'inputTo',
                    error :  emailValidator.reason
                });
            }

            var messageValidator = validateForm.validate(
                email_message,
                ['required'],
                ['Veuillez saisir un message pour votre destinataire']
            );
            if( !messageValidator.is_valid ){
                errors.push({
                    field : 'inputMessage',
                    error :  messageValidator.reason
                });
            }

            upload_form.display_errors(errors);

            if( errors.length <= 0){
                return {
                    is_valid        : true
                };
            }
            return {
                is_valid            : false,
                list_errors         : errors
            };
        },
        display_errors : function(errors_list){
            //on efface les errors
            $("#helpBlock-inputTo, #helpBlock-inputMessage").text("");
            $("#block-inputTo, #block-inputMessage").removeClass("has-error");
            $("#errorFileList").removeClass("show");

            for( var i = 0; i<errors_list.length; i++){
                var err = errors_list[i];
                if( err.field === "upload"){
                    $("#errorFileList").addClass("show");
                }else{
                    $("#block-" + err.field).addClass("has-error");
                    $("#helpBlock-" + err.field).text(err.error);
                }

            }
        },
        /**
         * Ajoute un champ input file et simule un click sur celui-ci
         * @param event
         */
        add_new_input_file : function (event){
            event.preventDefault();
            if( !upload_form.block_add_input ){
                // Création de l'input
                var newInput = $(upload_form.addtional_input_file);
                newInput.attr('id', 'foobar');
                $("#input-file-wrapper").append(newInput);

                // Création de l'entrée dans la tableau
                upload_form.uploadlist.push([]);

                // On bloque l'ajout d'upload
                upload_form.block_add_input = true;

                // On lance la fenetre de dialogue
                newInput.trigger("click");
            }else{
                //trigger sur le dernier input file
                $("#input-file-wrapper input.inputMyFile:last-child").trigger("click");
            }
        },
        /**
         * Invoqué lors d'une sélection de(s) fichier(s)
         * @param event
         */
        files_selected : function (event){
            // console.log(event);
            var files =  event.target.files;
            for(var i = 0; i < files.length; i++)
            {
                upload_form.add_file_to_list( files.item(i) );
            }
            $("#errorFileList").removeClass("show");
            upload_form.update_button();
            upload_form.write_html_files_list();
            upload_form.block_add_input = false;
        },

        /**
         * Update les boutons d'upload
         */
        update_button : function(){
            var total = 0,
                tab = [];
            for( var i = 0; i<upload_form.uploadlist.length; i++ ){
                tab = upload_form.uploadlist[i];
                total+= tab.length;
            }

            if(total > 0){
                $("#addFilesToUpload_first").hide();
                $(".addMoreFilesToUpload").addClass('show');
                $("#file-list").addClass('list');
            }else{
                $("#addFilesToUpload_first").show();
                $(".addMoreFilesToUpload").removeClass('show');
                $("#file-list").removeClass('list');
            }
        },

        /**
         * Supprime fichier de la liste
         * @param event
         */
        remove_file : function (event){
            event.preventDefault();
            var filename = $(this).parent().parent().find('strong').text();
            var array_key = $(this).parent().parent().data('row');

            for( var i = 0; i<upload_form.uploadlist[array_key].length; i++ ){
                if (filename == upload_form.uploadlist[array_key][i].name){
                    upload_form.uploadlist[array_key].splice(i, 1);
                }
            }
            upload_form.update_button();
            upload_form.write_html_files_list ();
        },

        /**
         * Ecrit la liste 'visuelle' de fichiers
         */
        write_html_files_list : function (){
            var output = [],
                $outputZone = $("#filesZone");
            $.each(upload_form.uploadlist, function (index, row) {
                $.each(row, function (index_row, f){
                    output.push('<li><div class="delete-line" data-row="' + index + '" href="#"><strong>', f.name, '</strong><span class="size">', upload_form.formatSizeUnits( f.size ), '</span><span class="deleteicon"><span class="glyphicon glyphicon-remove remove_file"></span></span> </div></li>');
                });
            });
            $outputZone.html ('<ul class="list-unstyled">' + output.join('') + '</ul>');
        },
        /**
         * Ajoute un fichier à la liste
         * @param item
         * @returns {*}
         */
        add_file_to_list : function (item){
            for( var i = 0; i<upload_form.uploadlist.length; i++ ){
                if (item.name == upload_form.uploadlist[i].name){
                    return false;
                }
            }
            var indiceInsert = upload_form.uploadlist.length - 1;

            upload_form.uploadlist[indiceInsert].push(item);
            // console.log(upload_form.uploadlist);
            return upload_form.uploadlist;
        },

        /**
         * Formatte le poids des fichiers pour indiquer une taille lisible
         * @param $bytes
         * @returns {*}
         */
        formatSizeUnits :  function ($bytes){
            if ($bytes >= 1073741824)
            {
                $bytes = ($bytes / 1000000000).toFixed(2) + ' Go';
            }
            else if ($bytes >= 1048576)
            {
                $bytes = ($bytes / 1000000).toFixed(1) + ' Mo';
            }
            else if ($bytes >= 1024)
            {
                $bytes = ($bytes / 1000).toFixed(0) + ' Ko';
            }
            else if ($bytes > 1)
            {
                $bytes = $bytes + ' octets';
            }
            else if ($bytes == 1)
            {
                $bytes = $bytes + ' octet';
            }
            else
            {
                $bytes = '0 octet';
            }
            return $bytes;
        }
    };
    return {
        upload_form : upload_form.init,

        vegas_slideshow : vegas_slideshow
    };
})();



