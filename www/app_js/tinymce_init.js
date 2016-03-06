/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//???????????
//        // Prevent jQuery (thus Bootstrap) UI dialog (modal) from blocking focusin
//        $(document).on('focusin', function(e) {
//            if ($(event.target).closest(".mce-window").length) {
//                        e.stopImmediatePropagation();
//                }
//        });
//???????????

// recupère les parametres passes au script appelé par :  <script src="app_js/test/mon_script.js?params=val1&val2&..."></script>
    var allScripts = document.getElementsByTagName("script"); // Récupère tous les noeuds <script> du document courant
    for (var i = 0 ; i < allScripts.length ; i++) { // Pour chacun des noeuds...
    	var currentScript = allScripts.item(i);
    	if (currentScript.src // ... s'il a un attribut src non vide...
            && /test_tinymce_init.js\?params=(.*)/.test(currentScript.src)) { // ...et que ça correspond à mon_script.js avec un paramètre 'param' derrière...
    			params = currentScript.src.match(/test_tinymce_init.js\?params=(.*)/); // ...on capture de tout ce qu'il y a après 'param='
//    			alert('toute la ligne script : '+params[0]); // param[0] contient tout le contenu de src
    			alert('derriere param= : '+params[1]); // param[1] contient tout ce qu'il y a après 'param='
    	}
    }
    // var global. Must be unique thus script can only be initiate once
    var listParams_test_tinymce_init = params[1].split('&');
    // param #0 hold the url to pass the datas
    tinymce.init({
        selector: "#textarea1",
        language : 'fr_FR',
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste "
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        setup: function(editor) {
            editor.on('init',function(){
                var doc=' Aucun envoie de document par le serveur... Essayez de rafraichir la page du navigateur';
                editor.setContent(doc);
                id=$(this).attr('id');
                var def = $.ajax({
                    url:listParams_test_tinymce_init[0],
                    data:{       
                           AJAX_UPDATE:'init_content_editor',
                           AJAX_ID:id,
                           AJAX_VAL:''
                    },
                    type:"POST",
                    dataType : "json",
                    async:"true", 
                    success: function(json){
                       editor.setContent(json.doc);
                       $("#nom_document_en_edition").text(json.title);
                       alert('Recu du serveur : '+json.title+' -- '+json.doc);
                       console.log('Recu du serveur : '+json.title+' -- '+json.doc);
                    },
                    fail: function(){
                        alert('Communication avec le serveur impossible! Veuillez rafraichir la page du navigateur...');
                    }
                });
            });
            editor.on('blur', function() {
                alert('Document modifié sans etre enregistré-----');
                $("#enregistrer_texte").css("background-color", "green");
                $("#enregistrer_texte").css("color", "red");
            });
        }
    });

