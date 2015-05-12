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
                    <h3 class="panel-title">License GPL version 3</h3>
                  </div>
                  <div class="panel-body">
                      <h4>Les principes de base de la GPL</h4>
                      Personne ne doit être limité par les logiciels qu'il utilise. Il y a quatre libertés que tout utilisateur doit posséder :</br>
                      <ul>
                          <li>la liberté d'utiliser le logiciel à n'importe quelle fin,
                          <li>la liberté de modifier le programme pour répondre à ses besoins,
                          <li>la liberté de redistribuer des copies à ses amis et voisins,
                          <li>la liberté de partager avec d'autres les modifications qu'il a faites.
                      </ul>
                      Quand un programme offre à ses utilisateurs toutes ces libertés, nous le qualifions de logiciel libre.</br>
                      Les développeurs qui écrivent des logiciels peuvent les publier sous les termes de la GNU GPL. Ce faisant, leur logiciel sera libre et le restera, indépendamment de qui modifiera et distribuera ce logiciel. Nous appelons cela copyleft : le logiciel est bien soumis au droit d'auteur, mais plutôt que d'utiliser ces droits pour restreindre l'utilisation que peuvent en faire les utilisateurs (comme c'est le cas dans les logiciels privateurs1), nous les utilisons pour nous assurer que tous les utilisateurs auront ces libertés.</br>
                      L'intégralité de la license d'utilisation est disponible <a href="http://www.gnu.org/licenses/agpl-3.0.html" target="_blank">ici</a>
                  </div>
                </div>
            </div>
      </div>
        <div class="row">
             <div class="col-md-12">
            <!--<div class="input-group">-->
                <form method="post" action="<?php echo' /seseapp/index.php '; ?>">
                    <input type="hidden" name="read" value="read" />
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name ="LicenseViewed"> <span class="glyphicon glyphicon-check"></span> Accepter la license et revenir à l'accueil...</button>
                </form>
            <!--</div> /input-group -->
            </div>
        </div>
    </div> <!-- /container -->
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

