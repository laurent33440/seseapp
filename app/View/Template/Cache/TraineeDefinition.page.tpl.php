<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo'/bootstrap_dev/docs-assets/ico/favicon.png'; ?>"> 

    <title>SESE</title>

    <!-- Bootstrap core CSS -->
    <!--<link href="bootstrap_dev/dist/css/bootstrap.css" rel="stylesheet">-->
    
    <link href="<?php echo'/bootstrap-3.2.0-dist/css/bootstrap.css'; ?>" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo'/app_css/welcome.css'; ?>" rel="stylesheet">
    <link href="<?php echo'/app_css/admin.css'; ?>" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
    <!-- css jQuery -->
    <link href="http://code.jquery.com/ui/1.11.4/themes/redmond/jquery-ui.css" rel="stylesheet">
    
    <!--TINY MCE TESTS--> 
    <script type="text/javascript" src="/app_js/tinymce/4.1.3/tinymce.min.js"></script>
    
    <script type="text/javascript">
        
//        // Prevent jQuery (thus Bootstrap) UI dialog (modal) from blocking focusin
//        $(document).on('focusin', function(e) {
//            if ($(event.target).closest(".mce-window").length) {
//                        e.stopImmediatePropagation();
//                }
//        });
        
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
                    this.setContent(getDoc());
                });
                editor.on('blur', function() {
                    //console.log(this.getContent());
                    highLightElement();
                    //alert('Document modifié sans ');
                });
            }
        });

    </script>
    
    
  </head>

    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <img alt="SESE" src="/app_img/logo_sese40.png">SESE
                    </a>
                    <a class="navbar-brand" href="#">
                        <img alt="Lycee Philadelphe de Gerde" src="/app_img/logo_lppdg40.png">Lycee Philadelphe de Gerde
                    </a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <!-- Single button --> 
                    <div class="btn-group nav navbar-nav navbar-right">
                      <button type="button" class="btn btn-primary dropdown-toggle navbar-btn" data-toggle="dropdown" aria-expanded="false">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        lolo : administrateur<span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" role="menu" >
                        <li><a href="/"> <span class="glyphicon glyphicon-off" aria-hidden="true"></span> Deconnexion</a></li>
                        <li><a href="#"> <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Contacter l'administrateur référant</a></li>
                      </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    <ul class="nav nav-sidebar">
                        <li role="presentation" class="dropdown"> 
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>Définition du référentiel pédagogique<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                
                                <li><a href="/index.php/administrateur/referentiel"><span class="glyphicon glyphicon-book " aria-hidden="true"></span>Référentiel de formation</a></li>
                                <li><a href="/index.php/administrateur/fonction"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>Fonctions</a></li>
                                <li><a href="/index.php/administrateur/activite"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>Activités</a></li>
                                <li><a href="/index.php/administrateur/competence"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>Compétences</a></li>
                            </ul>
                        </li>
                    </ul><ul class="nav nav-sidebar">
                        <li><a href="/index.php/administrateur/attitude_professionnelle"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>Créer/éditer les attitudes professionnelles </a></li>
                    </ul>    
                    <hr>
                    </ul><ul class="nav nav-sidebar">
                        <li><a href="/index.php/administrateur/document"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>Créer/editer les documents références </a></li>
                    </ul>
                    <ul class="nav nav-sidebar">
                        <li><a href="/index.php/administrateur/promotion"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>Créer les promotions </a></li>
                        <li><a href="/index.php/administrateur/enseignant"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Créer/Importer les enseignants</a></li>
                    </ul>
                    <hr>
                    <ul class="nav nav-sidebar">
                        <li><a href="/index.php/administrateur/stagiaire"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Créer/Importer les stagiaires</a></li>
                        <li><a href="/index.php/administrateur/stage"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Créer/Modifier les périodes de stage</a></li>
                    </ul>
                    <hr>
                    <ul class="nav nav-sidebar">
                        <li><a href="/index.php/administrateur/acces"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>Modifier le mot de passe Administrateur</a></li>
                        <li><a href=""><span class="glyphicon glyphicon-save" aria-hidden="true"></span>Archiver la base de données</a></li>
                        
                    </ul>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h1 class="page-header">Interface d'administration de SESE</h1>




<div class="container-fluid">
    
    <div class="jumbotron">
      <div class="container">
        <h3> Création des stagiaires reconnus dans l'application SESE </h3>
        <p>Vous définissez ici les stagiaires inclus dans les promotions </p>
      </div>
    </div>

    <form  method="post" action="<?php echo' /index.php/administrateur '; ?>" class="form-horizontal" >
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Liste des stagiaires déjà enregistrés
                </div>
                <div class="panel-body">
                    <?php 
                    echo"
                    <select class=\"form-control\" name=\"_traineesList\" id=\"traineeChoosenForUpdate\">";
                        foreach ($this->_arrayParamslist[0] as $idTrainee => $trainee) {
                            echo"
                                <option value=\"$idTrainee\">$trainee </option>
                            ";
                        }
                    echo "
                    </select>";
                    ?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Formulaire de création des stagiares
                </div>
                <div class="panel-body">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Promotion associé à ce stagiaire
                        </div>
                        <div class="panel-body">
                            <?php 
                            echo"
                            <select class=\"form-control\" name=\"_promotionsList\" id=\"promotionChoosenForUpdate\">";
                                foreach ($this->_arrayParamslist[1] as $idPromotion => $promotion) {
                                    echo"
                                        <option value=\"$idPromotion\">$promotion </option>
                                    ";
                                }
                            echo "
                            </select>";
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputAdminName" class="control-label col-xs-2">Nom du stagiare</label>
                        <div class="col-xs-10">
                            <input type="text" required class="form-control" id="inputAdminName" 
                                   name="<?php echo'_traineeLastName'; ?>" 
                                   placeholder="Nom du stagiaire"
                                   value="<?php echo'kevin'; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAdminPass" class="control-label col-xs-2">Prénom du stagiaire</label>
                        <div class="col-xs-10">
                            <input type="text" required class="form-control" id="inputAdminPass" 
                                   name="<?php echo'_traineeFirstName'; ?>"
                                   placeholder="Prénom du stagiaire"
                                   value="<?php echo'bryan'; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAdminPass2" class="control-label col-xs-2">Mél du stagiaire </label>
                        <div class="col-xs-10">
                            <input type="email" required class="form-control" id="inputAdminPass2" 
                                   name="<?php echo'_traineeEmail'; ?>" 
                                   placeholder="mel du stagiaire"
                                   value="<?php echo'stage@ici.fr'; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAdminPass2" class="control-label col-xs-2">Téléphone du stagiaire </label>
                        <div class="col-xs-10">
                            <input type="tel" required class="form-control" id="inputAdminPass2" 
                                   name="<?php echo'_traineePhone'; ?>" 
                                   placeholder="Téléphone du stagiaire"
                                   value="<?php echo'0556565630'; ?>">
                        </div>
                    </div>
                            
                            
                    <div class="col-md-4">
                        <button class="btn btn-success btn-block" name="<?php echo'ButtonSubmitAddTeacher'; ?>" id="addFunction" type="submit">
                            <span class="glyphicon glyphicon-plus-sign"></span>
                            Ajouter un stagiaire
                        </button>
                    </div>
                    <div class="col-md-4 col-md-offset-4">
                        <button class="btn btn-danger btn-block" name="<?php echo'ButtonSubmitDelTeacher'; ?>" id="delFunction" type="submit">
                            <span class="glyphicon glyphicon-minus-sign"></span>
                            Supprimer ce stagiaire
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
             <button class="btn btn-lg btn-primary btn-block" type="submit"> <span class="glyphicon glyphicon-check"></span> Terminer l'enregistrement des stagiaires</button>
        </div> 
    </form>

</div>
            </div><!-- Center page -->
        </div><!-- Row menu left -->
    </div> <!-- Main container -->

<footer>
    <div class="section-colored">
          <div class="container">
              <div class="row">
                <div class="col-md-4">
                    <a href="<?php echo' www.avalone-fr.com '; ?>" target='_blank'>
                        <h5>Création AVALONE</h5>
                    </a>
                  <p> </p>
                </div>
                  <div class="col-md-4">
                  <p> </p>
                </div>
                  <div class="col-md-4">
                    <a href="<?php echo' www.avalone-fr.com '; ?>" target='_blank'>
                        <h5 class="text-right">&copy; AVALONE 2015</h5>
                    </a>
                  <p> </p>
                </div>
              </div>
           </div>
    </div>
    
  </footer>

<!-- modals ===================================================== -->
    <div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true"> 
      <div class="modal-dialog"> 
        <div class="modal-content"> 
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
            <h4 class="modal-title" id="myModalLabel">MODAL_TITLE</h4> 
          </div> 
          <div class="modal-body"> 
            <h3>MODAL_MESSAGE</h3> 
          </div> 
          <div class="modal-footer"> 
            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button> 
            <!--<button type="button" class="btn btn-primary">Save changes</button> -->
          </div> 
        </div> 
      </div> 
    </div> 


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!--<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!--<script src="bootstrap_dev/dist/js/bootstrap.min.js"></script>-->
    <script src="<?php echo'/bootstrap-3.2.0-dist/js/bootstrap.min.js'; ?>"></script>
    
     <!-- trigg modal -->
        <?php if ( false ) echo'
            <script> $(\'#basicModal\').modal({\'show\' : true, \'backdrop\' : false}); </script>
        '; ?>
        
        
 <!-- Script for text inputs changes -->   
    <script type="text/javascript">
        $('[type="text"]').blur(function(){
               id=$(this).attr('id');
               val=$(this).val();
               console.log(id);
               console.log(val);
               $.ajax({
                   url:'/index.php/administrateur',
                   data:{       
                           AJAX_UPDATE:'texte_change',
                           AJAX_ID:id,
                           AJAX_VAL:val
                   },
                   type:"POST",
                   dataType : "json",
                   async:"false", //synchrone
                   success: function(json){
                       console.log('recu du serveur : '+json.doc);
                   }
               });
       });       
              
    </script>
    
    <!-- Script for select input(s) changes -->
    <script type="text/javascript">
        $("select").change(function(){
               id=$(this).attr('id');
               val=$(this).val();
               console.log(id);
               console.log(val);
               $.ajax({
                   url:'/index.php/administrateur',
                   data:{       
                           AJAX_UPDATE:'document_change',
                           AJAX_ID:id,
                           AJAX_VAL:val
                   },
                   type:"POST",
                   dataType : "json",
                   async:"false", //synchrone
                   success: function(json){
                       console.log('recu du serveur : '+json.doc);
                       var ed = tinyMCE.activeEditor;
                       ed.setContent(json.doc);
                       setTitle(json.title);
                   }
               });
       });       
       
              
    </script>
    
    <!-- Script for date inputs changes -->   
    <script type="text/javascript">
        $('[type="date"]').change(function(){
               id=$(this).attr('id');
               val=$(this).val();
               console.log(id);
               console.log(val);
               $.ajax({
                   url:'/index.php/administrateur',
                   data:{       
                           AJAX_UPDATE:'date_change',
                           AJAX_ID:id,
                           AJAX_VAL:val
                   },
                   type:"POST",
                   dataType : "json",
                   async:"false", //synchrone
                   success: function(json){
                       console.log('recu du serveur : '+json.doc);
                   }
               });
       });       
              
    </script>
    
    <!-- script qui renvoie une doc a TINYMCE : l'élément DOC est substituée dans le modelView (modelView['footer']['DOC']) par le generateur de template -->
    <script type="text/javascript">
        function getDoc(){
            $("#nom_document_en_edition").text('TITLE');
            return 'DOC';
        };
    </script>
    
    <!-- m a j titre doc en edition -->
    <script type="text/javascript">
        function setTitle(title){
            $("#nom_document_en_edition").text(title);
        };
    </script>
    
    <!-- agit sur bouton de validation de création/edition documents -->
    <script type="text/javascript">
        function highLightElement(){
            $("#valide_document").css("background-color", "green");
        };
    </script>
    
    
  </body>
</html>
