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
                        l : enseignant<span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" role="menu" >
                        <li><a href="/"> <span class="glyphicon glyphicon-off" aria-hidden="true"></span> Deconnexion</a></li>
                        <li><a href="#"> <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Contacter l'administrateur référant</a></li>
                      </ul>
                    </div>
                </div>
            </div>
        </nav>
     

    


    <!-- Menu
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->
 <div class="section-colored-menu"> <!--see "app_sese.css" -->
     
    <div class="container">
        
        <div class="jumbotron">
          
          <div class="row">
            <div class="col-lg-10">
                <h2> Espace enseignant</h2>
                <p>Veuillez choisir une action</p>
            </div>
            <div class="col-lg-2 ">
                  <a class="btn btn-default" href="#" data-toggle="tooltip" data-placement="left" title="Changer de mot de passe" role="button">
                      <img class="img-rounded" src="/app_img/params.png" alt="Changer de mot de passe">
                  </a>
            </div>
          </div>
        </div>
        
        <!-- Menu -->
        <div class="row">
            <div class="col-lg-2">
              <p>
                  <a class="btn btn-default" href="#" data-toggle="tooltip" data-placement="left" title="Informations pédagogiques" role="button">
                      <img class="img-rounded" src="/app_img/information.png" alt="Informations pédagogiques">
                  </a>
              </p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-2">
              <p>
                  <a class="btn btn-default" href="/index.php/enseignant/stage" data-toggle="tooltip" data-placement="left" title="Creation d'un stage" role="button">
                      <img class="img-rounded" src="/app_img/create_doc.png" alt="Creation d'un stage">
                  </a>
              </p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-2">
              <p>
                  <a class="btn btn-default" href="/index.php/enseignant/contact_interne" data-toggle="tooltip" data-placement="left" title="Envoyer un message" role="button">
                      <img class="img-rounded" src="/app_img/email.png" alt="Envoyer un message">
                  </a>
              </p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-2">
              <p>
                  <a class="btn btn-default" href="/index.php/enseignant/visite" data-toggle="tooltip" data-placement="left" title="Définir les visites" role="button">
                      <img class="img-rounded" src="/app_img/appointment.png" alt="Définir les visites">
                  </a>
              </p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-2">
              <p>
                  <a class="btn btn-default" href="/index.php/enseignant/commentaire" data-toggle="tooltip" data-placement="left" title="Commenter une visite" role="button">
                      <img class="img-rounded" src="/app_img/write.png" alt="Commenter une visite">
                  </a>
              </p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-2">
              <p>
                  <a class="btn btn-default" href="#" data-toggle="tooltip" data-placement="left" title="Résultats et attestations de stages" role="button">
                      <img class="img-rounded" src="/app_img/check.png" alt="Résultats et attestations de stages">
                  </a>
              </p>
            </div><!-- /.col-lg-4 -->
            
        </div><!-- /.row -->
      
    </div><!-- /.container -->
      
</div> <!-- section colored-->



<div class="container-fluid">
    
    <div class="jumbotron">
        <div class="container">
          <h3> Création des stage pour les promotions et stagiaires associés </h3>
          <p>Vous définissez ici les informations concernant les stages à créer </p>
        </div>
    </div>

    <form  method="post" action="<?php echo' /index.php/enseignant/stage '; ?>" class="form-horizontal" >
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Liste des dénominations de stages déjà enregistrées
                </div>
                <div class="panel-body">
                    <?php 
                    echo"
                    <select class=\"form-control\" name=\"_workNameList\" id=\"workUpdate\">";
                        foreach ($this->_arrayParamslist[0] as $idWork => $work) {
                            echo"
                                <option value=\"$idWork\">$work </option>
                            ";
                        }
                    echo "
                    </select>";
                    ?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Liste des stagiaires associés à la promotion
                </div>
                <div class="panel-body">
                    <?php 
                    echo"
                    <select class=\"form-control\" name=\"_traineeList\" id=\"traineeUpdate\">";
                        foreach ($this->_arrayParamslist[1] as $idTrainee => $trainee) {
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
                    Choix du professeur référant
                </div>
                <div class="panel-body">
                    <?php 
                    echo"
                    <select class=\"form-control\" name=\"_teacherList\" id=\"teacherUpdate\">";
                        foreach ($this->_arrayParamslist[2] as $idTeacher => $teacher) {
                            echo"
                                <option value=\"$idTeacher\">$teacher </option>
                            ";
                        }
                    echo "
                    </select>";
                    ?>
                </div>
            </div>
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    Informations relatives à l'entreprise 
                </div>
                <div class="panel-body">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Entreprise déjà connues
                        </div>
                        <div class="panel-body">
                            <?php 
                            echo"
                            <select class=\"form-control\" name=\"_companyList\" id=\"companyUpdate\">";
                                foreach ($this->_arrayParamslist[3] as $idCompany => $company) {
                                    echo"
                                        <option value=\"$idCompany\">$company </option>
                                    ";
                                }
                            echo "
                            </select>";
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputAdminName" class="control-label col-xs-2">Nom de l'entreprise</label>
                        <div class="col-xs-10">
                            <input type="text" required class="form-control" id="inputAdminName" 
                                   name="<?php echo'_companyName'; ?>" 
                                   placeholder="Nom de l'enseignant"
                                   value="<?php echo'silibre'; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAdminPass" class="control-label col-xs-2">Activité principale de l'entreprise</label>
                        <div class="col-xs-10">
                            <input type="text" required class="form-control" id="inputAdminPass" 
                                   name="<?php echo'_companyActivity'; ?>"
                                   placeholder="Prénom de l'enseignant"
                                   value="<?php echo'dev logiciel'; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAdminPass2" class="control-label col-xs-2">N° de SIRET de l'entreprise </label>
                        <div class="col-xs-10">
                            <input type="mail" required class="form-control" id="inputAdminPass2" 
                                   name="<?php echo'_companySiret'; ?>" 
                                   placeholder=""
                                   value="<?php echo'1234'; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAdminPass2" class="control-label col-xs-2">Adresse de l'entreprise </label>
                        <div class="col-xs-10">
                            <input type="text" required class="form-control" id="inputAdminPass2" 
                                   name="<?php echo'_companyAddress'; ?>" 
                                   placeholder="Discipline de l'enseignant"
                                   value="<?php echo'48 rue pasteur'; ?>">
                        </div>
                    </div>
                            
                    <div class="form-group">
                        <label for="inputAdminPass2" class="control-label col-xs-2">Ville de l'entreprise</label>
                        <div class="col-xs-10">
                            <input type="text" required class="form-control" id="inputAdminPass2" 
                                   name="<?php echo'_companyCity'; ?>" 
                                   placeholder="Discipline de l'enseignant"
                                   value="<?php echo'ambares'; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputAdminPass2" class="control-label col-xs-2">Code postal du lieu de l'entreprise </label>
                        <div class="col-xs-10">
                            <input type="text" required class="form-control" id="inputAdminPass2" 
                                   name="<?php echo'_companyZip'; ?>" 
                                   placeholder="Discipline de l'enseignant"
                                   value="<?php echo'33440'; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputAdminPass2" class="control-label col-xs-2">Numéro de téléphone de l'entreprise </label>
                        <div class="col-xs-10">
                            <input type="text" required class="form-control" id="inputAdminPass2" 
                                   name="<?php echo'_companyPhone'; ?>" 
                                   placeholder="Discipline de l'enseignant"
                                   value="<?php echo'0556776302'; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputAdminPass2" class="control-label col-xs-2">Adresse mél de  l'entreprise </label>
                        <div class="col-xs-10">
                            <input type="text" required class="form-control" id="inputAdminPass2" 
                                   name="<?php echo'_companyEmail'; ?>" 
                                   placeholder="Discipline de l'enseignant"
                                   value="<?php echo'contact@silibre.com'; ?>">
                        </div>
                    </div>
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Collaborateurs de l'entreprise déjà connus tuteur du stage
                        </div>
                        <div class="panel-body">
                            <?php 
                            echo"
                            <select class=\"form-control\" name=\"_employeeList\" id=\"emloyeeUpdate\">";
                                foreach ($this->_arrayParamslist[4] as $idEmployee => $employee) {
                                    echo"
                                        <option value=\"$idEmployee\">$employee </option>
                                    ";
                                }
                            echo "
                            </select>";
                            ?>
                            
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Informations concernant ce collaborateur
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="inputAdminName" class="control-label col-xs-2">Nom du tuteur</label>
                                            <div class="col-xs-10">
                                            <input type="text" required class="form-control" id="inputAdminName" 
                                                   name="<?php echo'_employeeLastName'; ?>" 
                                                   placeholder="Nom de l'enseignant"
                                                   value="<?php echo''; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAdminName" class="control-label col-xs-2">Prénom du tuteur</label>
                                            <div class="col-xs-10">
                                            <input type="text" required class="form-control" id="inputAdminName" 
                                                   name="<?php echo'_employeeFirstName'; ?>" 
                                                   placeholder="Nom de l'enseignant"
                                                   value="<?php echo'employee test'; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAdminName" class="control-label col-xs-2">Téléphone du tuteur</label>
                                            <div class="col-xs-10">
                                            <input type="text" required class="form-control" id="inputAdminName" 
                                                   name="<?php echo'_employeePhone'; ?>" 
                                                   placeholder="Nom de l'enseignant"
                                                   value="<?php echo''; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAdminName" class="control-label col-xs-2">Mél du tuteur</label>
                                            <div class="col-xs-10">
                                            <input type="text" required class="form-control" id="inputAdminName" 
                                                   name="<?php echo'_employeeEmail'; ?>" 
                                                   placeholder="Nom de l'enseignant"
                                                   value="<?php echo''; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAdminName" class="control-label col-xs-2">Rôle du tuteur dans l'entreprise</label>
                                            <div class="col-xs-10">
                                            <input type="text" required class="form-control" id="inputAdminName" 
                                                   name="<?php echo'_employeeRole'; ?>" 
                                                   placeholder="Nom de l'enseignant"
                                                   value="<?php echo'employee role test'; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                            
                    
                </div>
            </div>
        </div>

        <div class="row">
            
            <div class="col-md-4">
                <button class="btn btn-success btn-block"  name="ButtonSubmitAdd" value="" id="addWork" type="submit">
                    <span class="glyphicon glyphicon-plus-sign"></span>
                    Ajouter un stage
                </button>
            </div>
            <div class="col-md-4 col-md-offset-4">
                <button class="btn btn-danger btn-block"   name="ButtonSubmitDel" value="" id="delWork" type="submit">
                    <span class="glyphicon glyphicon-minus-sign"></span>
                    Supprimer ce stage
                </button>
            </div>
         
           <div class="col-md-12">
                <p>
                    <button class="btn btn-lg btn-primary btn-block" type="submit"> <span class="glyphicon glyphicon-check"></span> Terminer l'enregistrement des stages</button>
                </p>
           </div>
          
           
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
                   '/index.php/enseignant',
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
                   '/index.php/enseignant',
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

