


<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
  <div class="container">
    <h2 class="text-center">Suivi et évaluation des stagiaires en entreprise (SESE)</h2>
    <p class="text-center">Vous avez oublié votre mot de passe...</p> 
    <p class="text-center">Vous devez fournir l'adresse mél déclarée dans l'application SESE</p>
    <p class="text-center">En retour, un mot de passe vous sera envoyé pour accéder à votre espace personnel</p>
  </div>
</div>

<div class="container">
    <form method="post" class="form-horizontal" action="{{! CHECK !}}" role="form">
        <div class="form-group">
            <label  class="col-sm-2 control-label" for="exampleInputEmail2">Votre mél</label>
            <div class="col-sm-8">
                <input type="email" class="form-control"  name="{{!form_userMail!}}" id="exampleInputEmail2" placeholder="martin.durand@exemple.com">
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-success">Valider votre mél </button>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <a class="btn btn-primary" href=" {{! INDEX !}}">Revenir à l'accueil</a>
            </div>
        </div>
    </form>
 </div> <!-- /container -->