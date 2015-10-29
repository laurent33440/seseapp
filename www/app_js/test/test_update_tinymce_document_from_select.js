/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// recupère les parametres passes au script appelé par :  <script src="app_js/test/mon_script.js?params=val1&val2&..."></script>

    var allScripts = document.getElementsByTagName("script"); // Récupère tous les noeuds <script> du document courant
    for (var i = 0 ; i < allScripts.length ; i++) { // Pour chacun des noeuds...
    	var currentScript = allScripts.item(i);
    	if (currentScript.src // ... s'il a un attribut src non vide...
    			&& /test_update_tinymce_document_from_select.js\?params=(.*)/.test(currentScript.src)) { // ...et que ça correspond à mon_script.js avec un paramètre 'param' derrière...
    			params = currentScript.src.match(/test_update_tinymce_document_from_select.js\?params=(.*)/); // ...on capture de tout ce qu'il y a après 'param='
//    			alert('toute la ligne script : '+params[0]); // param[0] contient tout le contenu de src
//    			alert('update -- derriere param= : '+params[1]); // param[1] contient tout ce qu'il y a après 'param='
    	}
    }
    // var global. Must be unique thus script can only be initiate once
    var listParams_test_update_tinymce_document_from_select = params[1].split('&');
    // param #O holds the url to pass the datas
    // param #1 holds the id of the select html element wich send new doc to update tinymce
    // param #2 holds the id of the html element wich holds the title of doc
    $("#"+listParams_test_update_tinymce_document_from_select[1]).change(function(){
        id=$(this).attr('id');
        val=$(this).val();
        console.log(id);
        console.log(val);
        $.ajax({
           url:listParams_test_update_tinymce_document_from_select[0],
           data:{       
                   AJAX_UPDATE:'document_change',
                   AJAX_ID:id,
                   AJAX_VAL:val
           },
           type:"POST",
           dataType : "json",
           async:"true", //synchrone
           success: function(json){
               var ed = tinyMCE.activeEditor;
               ed.setContent(json.doc);
               $("#"+listParams_test_update_tinymce_document_from_select[2]).text(json.title);
           }
        });
   });   



