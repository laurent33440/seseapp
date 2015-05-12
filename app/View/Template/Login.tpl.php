


<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
  <div class="container">
    <h2 class="text-center">Suivi et évaluation des stagiaires en entreprise (SESE)</h2>
    <p class="text-center">Bienvenue sur l'application SESE.</p> <p class="text-center"> Vous devez vous identifiez pour accéder à votre espace personnel</p>
    <p class="text-center"><a class="btn btn-info "role="button" href="{{! ABOUT !}}"> <span class="glyphicon glyphicon-search"></span> En savoir plus &raquo;</a></p>
  </div>
</div>

<div class="container">
    <form method="post" class="form-signin" action="{{! INDEX !}}" role="form">
        <h2 class="form-signin-heading">Identifiez-vous...</h2>
        <p>
        <input type="text" class="form-control" placeholder="Adresse mél" required autofocus 
               name="{{!form_userName!}}">
        </p>
        <p>
        <input type="password" class="form-control" placeholder="Mot de passe" required
               name="{{!form_userPass!}}">
        </p>
        <p>
            <a href="#"> Mot de passe oublié?</a>
        </p>
        <button class="btn btn-lg btn-success btn-block" type="submit"> <span class="glyphicon glyphicon-check"></span> Valider</button>
      </form>
 </div> <!-- /container -->