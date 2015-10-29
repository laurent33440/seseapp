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
                        <img alt="SCHOOL_NAME" src="/app_img/logo_lppdg40.png">SCHOOL_NAME
                    </a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <!-- Single button --> 
                    <div class="btn-group nav navbar-nav navbar-right">
                      <button type="button" class="btn btn-primary dropdown-toggle navbar-btn" data-toggle="dropdown" aria-expanded="false">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        USER_NAME : USER_GROUP<span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" role="menu" >
                        <li><a href="INDEX"> <span class="glyphicon glyphicon-off" aria-hidden="true"></span> Deconnexion</a></li>
                        <li><a href="LOGOUT"> <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Contacter l'administrateur référant</a></li>
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
                  <a class="btn btn-default" href="TEACHERPASS" data-toggle="tooltip" data-placement="left" title="Changer de mot de passe" role="button">
                      <img class="img-rounded" src="/app_img/params.png" alt="Changer de mot de passe">
                  </a>
            </div>
          </div>
        </div>
        
        <!-- Menu -->
        <div class="row">
            <div class="col-lg-2">
              <p>
                  <a class="btn btn-default" href="TEACHERDOCUMENT" data-toggle="tooltip" data-placement="left" title="Informations pédagogiques" role="button">
                      <img class="img-rounded" src="/app_img/information.png" alt="Informations pédagogiques">
                  </a>
              </p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-2">
              <p>
                  <a class="btn btn-default" href="WORK_DEFINITION" data-toggle="tooltip" data-placement="left" title="Creation d'un stage" role="button">
                      <img class="img-rounded" src="/app_img/create_doc.png" alt="Creation d'un stage">
                  </a>
              </p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-2">
              <p>
                  <a class="btn btn-default" href="INTERNAL_CONTACT" data-toggle="tooltip" data-placement="left" title="Envoyer un message" role="button">
                      <img class="img-rounded" src="/app_img/email.png" alt="Envoyer un message">
                  </a>
              </p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-2">
              <p>
                  <a class="btn btn-default" href="WORK_VISIT_DEFINITION" data-toggle="tooltip" data-placement="left" title="Définir les visites" role="button">
                      <img class="img-rounded" src="/app_img/appointment.png" alt="Définir les visites">
                  </a>
              </p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-2">
              <p>
                  <a class="btn btn-default" href="WORK_COMMENT_DEFINITION" data-toggle="tooltip" data-placement="left" title="Commenter une visite" role="button">
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
