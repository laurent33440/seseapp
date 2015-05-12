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
    
    <!--TINY MCE TESTS--> 
    <script type="text/javascript" src="app_js/tinymce/4.1.3/tinymce.min.js"></script>
    
    <script type="text/javascript">
        
//        // Prevent jQuery (thus Bootstrap) UI dialog (modal) from blocking focusin
//        $(document).on('focusin', function(e) {
//            if ($(event.target).closest(".mce-window").length) {
//                        e.stopImmediatePropagation();
//                }
//        });
        
        tinymce.init({
            selector: "textarea#textarea1",
            language : 'fr_FR',
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste "
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });

    </script>


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
          <h1 class="navbar-text  "> test AJAX - version : <?php echo' 010614 '; ?> </h1>
        </div>
      </div>
    </div>    
    <div class="container">
        <form  method="post" action="<?php echo'/sese/index.php'; ?>" class="form-horizontal" >
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Informations relatives au fonctions liées au référentiel
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="active">N° fonction</th>
                                        <th class="active">Descriptif</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> 2 </td>
                                        <td>
                                            <div class="input-group">
                                                <div id="inputText">
                                                    <input type="text" class="form-control" value="" id="foncDesc2" placeholder="Entrez le descriptif de la fonction">
                                                </div>
                                              <span class="input-group-btn">
                                                <button class="btn btn-success" type="button">Ajouter</button>
                                                <button class="btn btn-danger" type="button">Supprimer</button>
                                              </span>
                                            </div><!-- /input-group -->
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td> 3 </td>
                                        <td>
                                            <div class="input-group">
                                              <input type="text" class="form-control" value="" id="foncDesc3" placeholder="Entrez le descriptif de la fonction">
                                              <span class="input-group-btn">
                                                <button class="btn btn-success" type="button">Ajouter</button>
                                                <button class="btn btn-danger" type="button">Supprimer</button>
                                              </span>
                                            </div><!-- /input-group -->
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td> 4 </td>
                                        <td>
                                            <div class="input-group">
                                              <input type="text" class="form-control" value="" id="foncDesc4" placeholder="Entrez le descriptif de la fonction">
                                              <span class="input-group-btn">
                                                <button class="btn btn-success" type="button">Ajouter</button>
                                                <button class="btn btn-danger" type="button">Supprimer</button>
                                              </span>
                                            </div><!-- /input-group -->
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td> <input type="number" class="form-control" id="foncId" placeholder="Entrez le n° de la fonction">
                                        </td>
                                        <td><input type="text" class="form-control" id="foncDesc" placeholder="Entrez le descriptif de la fonction">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="col-md-4">
                            <button class="btn btn-primary btn-block  btn-success" type="submit"> 
                                <span class="glyphicon glyphicon-check"></span> 
                                Ajouter la fonction 
                            </button>
                        </div>
                        <div class="col-md-4 col-md-offset-4">
                            <button class="btn btn-primary btn-block btn btn-danger" type="submit"> 
                                <span class="glyphicon glyphicon-check"></span> 
                                Supprimer la fonction 
                            </button>
                        </div>
                        
                        
                        
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Tests avec Tiny MCE - les scripts sont placés dans le 'head' de la page  
                        <a href="http://www.tinymce.com/wiki.php/Installation" target="_blank">voir sur le site officiel</a>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <textarea id="textarea1" name="tiny_mce_content" style="width:100%">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut 
                                labore et dolore magna aliqua. Ut enim ad minim veniam, quis 
                                laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in 
                                voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat 
                                cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
            
            


            <div class="row">
                 <button class="btn btn-lg btn-primary btn-block" type="submit"> <span class="glyphicon glyphicon-check"></span> Valider les informations</button>
            </div> 
        </form>
    </div> <!-- /container --><footer>
    <div class="section-colored">
          <div class="container">
           <!-- Example row of columns -->
              <div class="row">
                <div class="col-md-4">
                    <a href="<?php echo' www.avalone-fr.com '; ?>" target='_blank' id="link_id">
                        <h5>Test AJAX -- survole moi</h5>
                    </a>
                  <p> </p>
                </div>
                  <div class="col-md-4">
                      <form>
                        <input id="target" type="text" value="Field 1">
                        <input type="text" value="Field 2">
                    </form>
                  <p> </p>
                </div >
                  <div  class="col-md-4" >
                    <a  id="link_id2" href="#" target='_blank'>
                        <h5  class="text-right">&copy; Test AJAX 2014 -- survole moi<h5>
                    </a>
                  <p> </p>
                </div>
              </div>
           </div>
    </div>
    
  </footer>

<!-- modals
===================================================== -->
 <div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true"> 
      <div class="modal-dialog"> 
        <div class="modal-content"> 
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
            <h4 class="modal-title" id="myModalLabel">Basic Modal</h4> 
          </div> 
          <div class="modal-body"> 
            <h3>Modal Body</h3> 
          </div> 
          <div class="modal-footer"> 
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
            <button type="button" class="btn btn-primary">Save changes</button> 
          </div> 
        </div> 
      </div> 
    </div> 

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!--<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>-->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
    <!--<script src="bootstrap_dev/dist/js/bootstrap.min.js"></script>-->
    <script src="app_js/jquery/1.11.1/jquery.min.js"></script>
    <script src="bootstrap-3.2.0-dist/js/bootstrap.min.js"></script>
    
    <!-- trigg modal test -->
    <!--<script> $('#basicModal').modal('show'); </script>-->
    
    
    <!-- AJAX TESTS -->
    <script type="text/javascript">
           $( "#link_id" ).mouseover(function(){
               $.post(
                   '/sese/index.php',
                    {    ajax:'ok'
                    },
                    function(data){
                        alert(data.value);
                        console.log(data.value);
                        
                    },
                    'json'
               );
           });
           $( "#link_id2" ).mouseover(function(){
               $.post(
                   '/sese/index.php',
                    {    ajax:'ok'
                    },
                    function(data){
                        alert(data.value);
                        console.log(data.value);
                        
                    },
                    'json'
               );
           });        
    </script>
    
    <script type="text/javascript">
           $(":text").blur(function(){
               console.log($(this).attr('id'));
               id=$(this).attr('id');
               val=$(this).val();
               alert('Input id :'+id+' '+'Input val :'+val);
//               $.post(
//                   '/sese/index.php',
//                    {    ajax:'ok'
//                    },
//                    function(data){
//                        alert(data.value);
//                        console.log(data.value);
//                        
//                    },
//                    'json'
//               );
           });
//            $(document).ready(function(){
//        alert('page chargée');
////        $("#func_table").blur(function{
////               alert('blur');
////               $.post(
////                   '/sese/index.php',
////                    {    AJAX_UPDATE:'ok'
////                    },
////                    function(data){
////                        alert(data.value);
////                        console.log(data.value);
////                        
////                    },
////                    'json'
////               );
////           });       
//    });
    </script>
    
    <script type="text/javascript">
           $("#textarea1").mouseover(function(){
               console.log($(this).attr('id'));
               id=$(this).attr('id');
               val=$(this).val();
               alert('Input id :'+id+' '+'Input val :'+val);
//               $.post(
//                   '/sese/index.php',
//                    {    ajax:'ok'
//                    },
//                    function(data){
//                        alert(data.value);
//                        console.log(data.value);
//                        
//                    },
//                    'json'
//               );
           });

    </script>
<!--    <script type="text/javascript">
           $( "#link_id" ).mouseover(function(){
               
               $.ajax({
                   url : '/sese/index.php',
                   type : 'POST',
                   data : 'ajax=ok'
               });
           });          
    </script>-->
    
<!--    <script type="text/javascript">
        $(document).ready(function(){
            alert('Page chargée');
        });
       
   </script>-->
    
  </body>
</html>