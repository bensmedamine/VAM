jQuery(function($){

    $("#picture-loader").hide();
    var count_pictures = 0;
    var user_pictures = new Array();

    function set_picture_message(msg){
        $("#picture-message").html(msg);
        return true;
    }

    //prototype.indexOf
    if (!Array.prototype.indexOf) {
        Array.prototype.indexOf = function(elt /*, from*/) {
            var len = this.length;
            var from = Number(arguments[1]) || 0;
            from = (from < 0) ? Math.ceil(from) : Math.floor(from);
            if (from < 0) from += len;
            for (; from < len; from++) {
                if (from in this && this[from] === elt)
                    return from;
            }
            return -1;
        };
    }

    //prototype.unset
    Array.prototype.unset = function(val){
        var index = this.indexOf(val);
        if(index > -1){
            this.splice(index,1);
        }
    }

    $(".supprimer-user-picture").live("click", function(){
        set_picture_message("");
        var html = no_ads_picture;
        var alt = $(this).parents("div.photo").find("img").eq(0).attr("alt");
        $(this).parents("div.photo").addClass("empty").html(html);
        if (alt.length) {
            user_pictures.unset(alt);

        }
        if (count_pictures > 0 ) {
            count_pictures--;
        }
        return false;
    });


    //traitement des photos
    $("#edit-photo").live("change", function(){

        var value = $(this).val().toLowerCase();
        var img = value.split("/").pop().toLowerCase();

        //Vérification de l extension
        var ext = value.split(".").pop().toLowerCase();
        var check = ($.inArray(ext, ["gif","png","jpg","jpeg"]) == -1) ? false : true;
        if (!check) {
            set_picture_message("L\'extension de la photo est non valide.");
            return false;
        }

        //Vérification du count
        if(count_pictures > 5) {
            set_picture_message("Le nombre max des images autorisé atteint");
            return false;
        }

        //is picture existe
        var founded = false;
        $(user_pictures).each(function (index, elem) {
            if(elem == value) {
                founded = true;
            }
        });
        if (founded) {
            set_picture_message("La photo existe déjà");
            return false;
        }

        //Ecriture du nom de fichier sur le input
        $(".js-input-for-file").val(value);

        $("#picture-loader").ajaxStart(function(){
            $(this).show();
            set_picture_message("");
        }).ajaxComplete(function(){
            $(this).hide();
        });

        $.ajaxFileUpload({

            url:upload_url,
            secureuri:false,
            fileElementId:"edit-photo",
            dataType: "json",

            success: function (data) {
                var photo = JSON.parse(data);
                if(photo.error == 1) {
                    set_picture_message("Veuillez mettre une photo de type (JPG, JPEG, PNG ou GIF) de 2Mo max");
                    return false;
                }

                count_pictures++;
                user_pictures.push(photo.filename);
                var uri = photo.uri;
                var html = "<p><img src='"+img_annonces_url+photo.filename+"' alt='"+photo.filename+"' with='131' height='85'></p>";
                html += "<input type=\'hidden\' value=\'"+photo.fid+"\' name=\'pictures[]\'>";
                html += "<a href='#' title='Supprimer' class='supprimer-user-picture'><img src="+delete_png_uri+" alt='Supprimer'></a>";
                set_picture_message("");
                $("#photos-annonces .empty").eq(0).removeClass("empty").html(html);
            },
            error: function (data, status, e){
                set_picture_message("Une erreur est survenue lors du téléchargement");
            }
        })

    });

    $("#nouvelle-annonce").validate({
        errorClass: "invalid",
        validClass: "",

        rules: {

        },
        messages: {

    }
    });

    $("#edit-photo").filestyle({
        image: theme_path+"/images/choose-file.gif",
        imageheight : 35,
        imagewidth : 82,
        width : 250
    });

});