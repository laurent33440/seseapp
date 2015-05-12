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
              <span class="badge">{{!CURRENT_STEP_NUMBER!}}</span> sur <span class="badge">{{!STEP_NUMBER!}}</span>
              |version : {{!VERSION!}}  
          </p>
          
        </div>
        <div class="navbar-collapse collapse">
            {{? ( BACK_BUTTON ) {%!
         <ul class="nav nav-pills navbar-right">
            <li ><a href="PREVIOUS_URI">Etape précedente</a></li>
         </ul>
             !}}
             
              {{? ( FORWARD_BUTTON ) {%!
         <ul class="nav nav-pills navbar-right">
            <li ><a href="NEXT_URI">Etape suivante</a></li>
         </ul>
             !}}
        </div><!--/.navbar-collapse -->
      </div>
    </div>