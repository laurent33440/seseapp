<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo'bootstrap_dev/docs-assets/ico/favicon.png'; ?>"> 

    <title>SESE</title>

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
      <!--    <a class="navbar-brand" href="#"> <img src="logo_philadelphe_bleu_h100.png" alt="logo"> </a> -->
          <h1 class="navbar-text  "> Suivi et évaluation des stagiaires en entreprise - version : <?php echo' 010614 '; ?> </h1>
        </div>
      </div>
    </div> 
<div class="container">
       <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Erreur interne à l'application : </h3>
                  </div>
                  <div class="panel-body">
                      <h4>Voici le message d'erreur de l'application : </h4>
                      <p>
                           ERREUR PDO dans /home/laurent/Dropbox/Projets/web/sese/app/model/persistant/PdoCrud.php L.157 : SQLSTATE[23000]: Integrity constraint violation: 1452 Cannot add or update a child row: a foreign key constraint fails (`lolobase`.`Constituer`, CONSTRAINT `FK_Constituer_id_activite` FOREIGN KEY (`id_activite`) REFERENCES `Activite` (`id_activite`)) backtrace : #0 /home/laurent/Dropbox/Projets/web/sese/app/model/persistant/PdoCrud.php(157): PDO->query('INSERT INTO Con...')
#1 /home/laurent/Dropbox/Projets/web/sese/app/model/SkillsReferenceDefinitionModel.php(163): model\persistant\PdoCrud->dbQI(Array, 'Constituer')
#2 /home/laurent/Dropbox/Projets/web/sese/app/controller/SkillsReferenceDefinitionController.php(144): model\SkillsReferenceDefinitionModel->addSkillToDataBase()
#3 /home/laurent/Dropbox/Projets/web/sese/app/controller/SkillsReferenceDefinitionController.php(48): controller\SkillsReferenceDefinitionController->compute(Array)
#4 /home/laurent/Dropbox/Projets/web/sese/app/MainSetupRouter.php(68): controller\SkillsReferenceDefinitionController->run()
#5 /home/laurent/Dropbox/Projets/web/sese/app/Kernel.php(75): MainSetupRouter->run()
#6 /home/laurent/Dropbox/Projets/web/sese/www/index.php(33): Kernel::run()
#7 {main}</br> 
                      </p> 
                  </div>
                </div>
            </div>
        </div>
        
        <div class="row">
             <div class="col-md-12">
                 <a href="<?php echo'/sese/index.php'; ?>/oncriticalerror">
                     <button class="btn btn-lg btn-primary btn-block" > <span class="glyphicon glyphicon-check"></span> 
                         Revenir à l'accueil
                     </button>
                 </a>
              </div>
        </div>
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

