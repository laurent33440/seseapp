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
                        <li><a href="LOGOUT"> <span class="glyphicon glyphicon-off" aria-hidden="true"></span> Deconnexion</a></li>
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
                      <a class="btn btn-default" href="TUTORPASS" data-toggle="tooltip" data-placement="left" title="Changer de mot de passe" role="button">
                          <img class="img-rounded" src="/app_img/params.png" alt="Changer de mot de passe">
                      </a>
                </div>
            </div>
        </div>
        
        <!-- Menu -->
        <div class="row">
            <div class="col-lg-2 col-lg-offset-1">
              <p>
                  <a class="btn btn-default" href="TUTORDOCUMENT" data-toggle="tooltip" data-placement="left" title="Informations générales" role="button">
                      <img class="img-rounded" src="/app_img/information.png" alt="Informations générales">
                  </a>
              </p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-2 ">
              <p>
                  <a class="btn btn-default" href="TUTOR_LIST" data-toggle="tooltip" data-placement="left" title="Stagiaires en responsabilité" role="button">
                      <img class="img-rounded" src="/app_img/users.png" alt="Stagiaires en responsabilité">
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
                  <a class="btn btn-default" href="ACTIVITIES_LIST" data-toggle="tooltip" data-placement="left" title="Activités souhaitées pour le stagiaire" role="button">
                      <img class="img-rounded" src="/app_img/works.png" alt="Activités souhaitées pour le stagiaire">
                  </a>
              </p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-2">
              <p>
                  <a class="btn btn-default" href="EVALUATE" data-toggle="tooltip" data-placement="left" title="Evaluer un stagiare" role="button">
                      <img class="img-rounded" src="/app_img/check2.png" alt="Evaluer un stagiare">
                  </a>
              </p>
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
        <!-- end Menu -->
      
    </div><!-- /.container -->
      
</div> <!-- section colored-->
