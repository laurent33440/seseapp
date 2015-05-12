 
<div class="container">
       <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Erreur du serveur de base de données MySQL : </h3>
                  </div>
                  <div class="panel-body">
                      <h4>Voici le message d'erreur du serveur MySQL : </h4>
                      <p>
                          {{! MESSAGE !}}
                      </p> 
                  </div>
                </div>
            </div>
        </div>
        
        <div class="row">
             <div class="col-md-12">
                <form method="post" action="{{! INDEX !}}">
                    <input type="hidden" name="done" value="done" />
                    <button class="btn btn-lg btn-primary btn-block" > <span class="glyphicon glyphicon-check"></span> Revenir à l'accueil</button>
                </form>
              </div>
        </div>
 </div>
