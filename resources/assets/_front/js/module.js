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
        uploadlist:[],
        block_add_input: false,
        addtional_input_file: '<input class="inputMyFile hidden" type="file" id="" name="myfiles[]" multiple>',

        /**
         * Initialise l'uplaod (lance les écouteurs, etc..)
         */
        init : function () {
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
            console.log(event);
            var files =  event.target.files;
            for(var i = 0; i < files.length; i++)
            {
                upload_form.add_file_to_list( files.item(i) );
            }

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
            console.log(upload_form.uploadlist);
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