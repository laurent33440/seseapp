/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// recupère les parametres passes au script appelé par :  <script src="app_js/test/mon_script.js?params=val1&val2&..."></script>
    var scriptName='';
    var allScripts = document.getElementsByTagName("script"); // Récupère tous les noeuds <script> du document courant
    for (var i = 0 ; i < allScripts.length ; i++) { // Pour chacun des noeuds...
    	var currentScript = allScripts.item(i);
    	if (currentScript.src // ... s'il a un attribut src non vide...
    			&& /test_mouse_over.js\?params=(.*)/.test(currentScript.src)) { // ...et que ça correspond à mon_script.js avec un paramètre 'param' derrière...
    			params = currentScript.src.match(/test_mouse_over.js\?params=(.*)/); // ...on capture de tout ce qu'il y a après 'param='
//    			alert('toute la ligne script : '+params[0]); // param[0] contient tout le contenu de src
//    			alert('derriere param= : '+params[1]); // param[1] contient tout ce qu'il y a après 'param='
//    			window.onload = function(e) {document.getElementById('test').innerHTML = param[1];} // Affichage de la valeur du paramètre  (Aucun intérêt, hein, c'est juste pour le debuggage)
    	}
    }
    // var global. Must be unique thus script can only be initiate once
    var listParams_test_mouse_over = params[1].split('&');
    // param #0 hold the url to pass the datas 
    // param #1 hold the class of the DOM element for "mouse over" event 
    $( "."+listParams_test_mouse_over[1] ).mouseover(function(){
        id=$(this).attr('id');
        val=$(this).val();
        console.log(id);
        console.log(val);
        $.ajax({
               url:listParams_test_mouse_over[0],
               data:{       
                       AJAX_UPDATE:'mouse_over',
                       AJAX_ID:id,
                       AJAX_VAL:val
               },
               type:"POST",
               dataType : "json",
               async:"false", //synchrone
               success: function(json){
                   alert('Recu du serveur : '+json.change+' -- '+json.identificateur+' -- '+json.valeur);
                   console.log('recu du serveur : '+json.change+' -- '+json.identificateur+' -- '+json.valeur);
               }
           });
   });


