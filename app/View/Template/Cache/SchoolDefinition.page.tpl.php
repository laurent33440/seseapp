<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo'bootstrap_dev/docs-assets/ico/favicon.png'; ?>"> 

    <title>Livret PFMP</title>

    <!-- Bootstrap core CSS -->
    <!--<link href="bootstrap_dev/dist/css/bootstrap.css" rel="stylesheet">-->
    <link href="<?php echo'bootstrap-3.2.0-dist/css/bootstrap.css'; ?>" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo'app_css/welcome.css'; ?>" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
<body>

    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!--<a class="navbar-brand" href="#"> <img src="logo_philadelphe_bleu_h100.png" alt="logo"> </a> -->
          <p class="navbar-text "> suivi et évaluation des stagiaires en entreprise|installation|étape 
              <span class="badge"><?php echo'3'; ?></span> sur <span class="badge"><?php echo'11'; ?></span>
              |version : <?php echo'010614'; ?>  
          </p>
          
        </div>
        <div class="navbar-collapse collapse">
            <?php if ( true ) echo'
         <ul class="nav nav-pills navbar-right">
            <li ><a href="/sese/index.php/previous">Etape précedente</a></li>
         </ul>
             '; ?>
             
              <?php if ( true ) echo'
         <ul class="nav nav-pills navbar-right">
            <li ><a href="/sese/index.php/next">Etape suivante</a></li>
         </ul>
             '; ?>
        </div><!--/.navbar-collapse -->
      </div>
    </div>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h3>Etape de définition de l'établissement de formation </h3>
        <p>Dans cette étape vous allez définir les informations utiles à la définition de l'établissement de formation.</p>
        <!--<p><a class="btn btn-primary btn-lg" role="button"> <span class="glyphicon glyphicon-search"></span> En savoir plus &raquo;</a></p>-->
      </div>
    </div>
    
   
    
    <div class="container">

        <form  method="post" action="<?php echo' /sese/index.php '; ?>" class="form-horizontal" >
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Informations relatives  à l'établissement de formation
                    </div>
                    <div class="panel-body">
                         <!--<form class="form-horizontal">-->
                            <div class="form-group">
                                <label for="inputAdminName" class="control-label col-xs-2">Nom de l'établissement</label>
                                <div class="col-xs-10">
                                    <input type="text" required class="form-control" id="inputAdminName" 
                                           name="<?php echo'_schoolName'; ?>" 
                                           placeholder="Nom de l'établissement de formation"
                                           value="<?php echo''; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAdminPass" class="control-label col-xs-2">N° de SIRET de l'établissement</label>
                                <div class="col-xs-10">
                                    <input type="text" required class="form-control" id="inputAdminPass" 
                                           name="<?php echo'_schoolSiret'; ?>"
                                           placeholder=""
                                           value="<?php echo''; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAdminPass2" class="control-label col-xs-2">Adresse principale de l'établissement </label>
                                <div class="col-xs-10">
                                    <input type="text" required class="form-control" id="inputAdminPass2" 
                                           name="<?php echo'_schoolAddress1'; ?>" 
                                           placeholder=""
                                           value="<?php echo''; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAdminPass2" class="control-label col-xs-2">Adresse secondaire de l'établissement </label>
                                <div class="col-xs-10">
                                    <input type="text" required class="form-control" id="inputAdminPass2" 
                                           name="<?php echo'_schoolAddress2'; ?>" 
                                           placeholder="Si utile"
                                           value="<?php echo''; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAdminPass2" class="control-label col-xs-2">Ville de l'établissement </label>
                                <div class="col-xs-10">
                                    <input type="text" required class="form-control" id="inputAdminPass2" 
                                           name="<?php echo'_schoolCity'; ?>" 
                                           placeholder=""
                                           value="<?php echo''; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAdminPass2" class="control-label col-xs-2">Code postal du lieu de l'établissement </label>
                                <div class="col-xs-10">
                                    <input type="text" required class="form-control" id="inputAdminPass2" 
                                           name="<?php echo'_schoolZipCode'; ?>" 
                                           placeholder=""
                                           value="<?php echo''; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAdminPass2" class="control-label col-xs-2">Numéro de téléphone de l'établissement </label>
                                <div class="col-xs-10">
                                    <input type="text" required class="form-control" id="inputAdminPass2" 
                                           name="<?php echo'_schoolPhone'; ?>" 
                                           placeholder=""
                                           value="<?php echo''; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAdminPass2" class="control-label col-xs-2">Adresse du site internet de l'établissement </label>
                                <div class="col-xs-10">
                                    <input type="text" required class="form-control" id="inputAdminPass2" 
                                           name="<?php echo'_schoolUrl'; ?>" 
                                           placeholder="S'il existe"
                                           value="<?php echo''; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAdminMel" class="control-label col-xs-2">Adresse mél de l'établissement</label>
                                <div class="col-xs-10">
                                    <input type="email" required class="form-control" id="inputAdminMel" 
                                           name="<?php echo'_schoolEmail'; ?>" 
                                           placeholder="Adresse mél de l'établissement"
                                           value="<?php echo''; ?>">
                                </div>
                            </div>
                         <!--</form>-->
                    </div>
                </div>
            </div>


            <div class="row">
                 <button class="btn btn-lg btn-primary btn-block" type="submit"> <span class="glyphicon glyphicon-check"></span> Valider les informations</button>
            </div> 
        </form>
        
    </div>

<footer>
    <div class="section-colored">
          <div class="container">
           <!-- Example row of columns -->
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
                        <h5 class="text-right">&copy; AVALONE 2014<h5>
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
    <script src="bootstrap-3.2.0-dist/js/bootstrap.min.js"></script>
    
     <!-- trigg modal -->
        <?php if ( false ) echo'
            <script> $(\'#basicModal\').modal({\'show\' : true, \'backdrop\' : false}); </script>
        '; ?>
        
        
<!--    <script type="text/javascript">
        $(':text').blur(function(){
               console.log($(this).attr('id'));
               id=$(this).attr('id');
               val=$(this).val();

               $.post(
                   'INDEX',
                    {       AJAX_UPDATE:'ok',
                            AJAX_ID:id,
                            AJAX_VAL:val
                    },
                    function(data){
                        alert('from server : '+' id : '+data.id+' '+'val : '+data.value);
//                        console.log(data.value);
                    },
                    'json'
               );
       });       
              
    </script>-->
    
<!--    <script type="text/javascript">
        $(document).ready(function(){
            alert('Page chargée');
        });
       
   </script>-->
    
  </body>
</html>

