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
                        t@t : tuteur<span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" role="menu" >
                        <li><a href="/"> <span class="glyphicon glyphicon-off" aria-hidden="true"></span> Deconnexion</a></li>
                        <li><a href="#"> <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Contacter l'administrateur référant</a></li>
                      </ul>
                    </div>
                </div>
            </div>
        </nav>
     

    


    <!-- Generic
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->
 <div class="section-colored-menu"> <!--see "app_sese.css" -->
     
    <div class="container">
        
        <div class="jumbotron">
            <div class="row">
                <div class="col-lg-10">
                    <h2> Espace tuteur de stage</h2>
                    <p>Veuillez choisir une action</p>
                </div>
                <div class="col-lg-2 ">
                      <a class="btn btn-default" href="/index.php/tuteur/mot_de_passe" data-toggle="tooltip" data-placement="left" title="Changer de mot de passe" role="button">
                          <img class="img-rounded" src="/app_img/params.png" alt="Changer de mot de passe">
                      </a>
                </div>
            </div>
        </div>
        
        <!-- Menu -->
        <div class="row">
            <div class="col-lg-2 col-lg-offset-1">
              <p>
                  <a class="btn btn-default" href="/index.php/tuteur/document" data-toggle="tooltip" data-placement="left" title="Informations générales" role="button">
                      <img class="img-rounded" src="/app_img/information.png" alt="Informations générales">
                  </a>
              </p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-2 ">
              <p>
                  <a class="btn btn-default" href="/index.php/tuteur/liste_stagiaire" data-toggle="tooltip" data-placement="left" title="Stagiaires en responsabilité" role="button">
                      <img class="img-rounded" src="/app_img/users.png" alt="Stagiaires en responsabilité">
                  </a>
              </p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-2">
              <p>
                  <a class="btn btn-default" href="/index.php/tuteur/contact_interne" data-toggle="tooltip" data-placement="left" title="Envoyer un message" role="button">
                      <img class="img-rounded" src="/app_img/email.png" alt="Envoyer un message">
                  </a>
              </p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-2">
              <p>
                  <a class="btn btn-default" href="/index.php/tuteur/liste_activites" data-toggle="tooltip" data-placement="left" title="Activités souhaitées pour le stagiaire" role="button">
                      <img class="img-rounded" src="/app_img/works.png" alt="Activités souhaitées pour le stagiaire">
                  </a>
              </p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-2">
              <p>
                  <a class="btn btn-default" href="/index.php/tuteur/evaluation_stagiaire" data-toggle="tooltip" data-placement="left" title="Evaluer un stagiare" role="button">
                      <img class="img-rounded" src="/app_img/check2.png" alt="Evaluer un stagiare">
                  </a>
              </p>
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
        <!-- end Menu -->
      
    </div><!-- /.container -->
      
</div> <!-- section colored-->

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"> Liste des stagiaires  </h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive" id="visit_table">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="active">Stagiaire en responsabilité</th>
                                    <th class="active">Période de stage </th>
                                    <th class="active">Enseignant référant</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($this->_arrayParamslist[0] as $trainee => $infos) {
                                    echo"
                                        <tr>
                                            <td> 
                                                $trainee
                                                    <a href=\"#\"><span class=\"glyphicon glyphicon-envelope\" aria-hidden=\"true\"></span></a>
                                            </td>";
                                    foreach ($infos as $period=>$teacher){
                                        echo"
                                    
                                            <td>
                                                $period
                                            </td>
                                            <td>
                                                $teacher
                                                    <a href=\"/contact\"><span class=\"glyphicon glyphicon-envelope\" aria-hidden=\"true\"></span></a>
                                            </td>
                                                    
                                        </tr>
                                    ";
                                    }
                                } ?>
                            </tbody>
                        </table>
                    </div>
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
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js"> </script>
    <script src="https://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css"></script>
    <!--<script src="bootstrap_dev/dist/js/bootstrap.min.js"></script>-->
    <script src="<?php echo'/bootstrap-3.2.0-dist/js/bootstrap.min.js'; ?>"></script>
    
     <!-- trigg modal -->
        <?php if ( false ) echo'
            <script> $(\'#basicModal\').modal({\'show\' : true, \'backdrop\' : false}); </script>
        '; ?>
        
    <!-- Script for text inputs changes -->   
    <script type="text/javascript">
        $(':text').blur(function(){
               console.log($(this).attr('id'));
               id=$(this).attr('id');
               val=$(this).val();

               $.post(
                   '/index.php/tuteur',
                    {       AJAX_UPDATE:'blur',
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
              
    </script>
    
    <!-- Script for select input(s) changes -->
    <script type="text/javascript">
        $("select").change(function(){
               console.log($(this).attr('id'));
               id=$(this).attr('id');
               val=$(this).val();

               $.post(
                   '/index.php/tuteur',
                    {       AJAX_UPDATE:'change',
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
              
    </script>
    
    <!------- JQUERY WIDGET -------->
    <script>
      $(function() {
        $( "#datePicker" ).datepicker();
      });
    </script>
    
<!--    <script type="text/javascript">
        $(document).ready(function(){
            alert('Page chargée');
        });
       
   </script>-->
    
  </body>
</html>

