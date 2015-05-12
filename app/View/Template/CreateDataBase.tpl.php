
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h3>Etape de création de la base de données</h3>
        <p>Dans cette étape vous allez définir les informations utiles à la création de la base de données.</p>
        <!--<p><a class="btn btn-primary btn-lg" role="button"> <span class="glyphicon glyphicon-search"></span> En savoir plus &raquo;</a></p>-->
      </div>
    </div>
    
   
    
    <div class="container">

        <form  method="post" action="{{! INDEX !}}" class="form-horizontal" >
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Informations relatives au serveur de base de données MySql
                    </div>
                    <div class="panel-body">
                         <!--<form class="form-horizontal">-->
                            <div class="form-group">
                                <label for="inputdbSrv" class="control-label col-xs-2">Serveur MySql</label>
                                <div class="col-xs-10">
                                    <input type="text" required class="form-control" id="inputdbSrv" name="{{!form_dbSrv!}}" placeholder="{{!form_ph_dbSrv!}}" value="{{!form_val_dbSrv!}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputdbUser" class="control-label col-xs-2">Nom utilisateur du serveur MySql</label>
                                <div class="col-xs-10">
                                    <input type="text" required class="form-control" id="inputdbUser" name="{{!form_dbUser!}}"placeholder="{{!form_ph_dbUser!}}" value="{{!form_val_dbUser!}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputdbPassword" class="control-label col-xs-2">Mot de passe de l'utilisateur du serveur MySql</label>
                                <div class="col-xs-10">
                                    <input type="password" required class="form-control" id="inputdbPassword" name="{{!form_dbPass!}}" placeholder="{{!form_ph_dbPass!}}" value="{{!form_val_dbPass!}}">
                                </div>
                            </div>
                         <!--</form>-->
                    </div>
                </div>
            </div>


            <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Définir le nom de la base de données
                        </div>
                        <div class="panel-body">
                            Vous définissez ici le nom de la base de données. Ce nom doit être en rapport avec la spécialité et le niveau de la classe. Par exemple : vente_2nd  
                             <!--<form class="form-horizontal">-->
                                <div class="form-group">
                                    <label for="inputdbName" class="control-label col-xs-2">Nom de la base de données</label>
                                    <div class="col-xs-10">
                                        <input type="text" required class="form-control" id="inputdbName" name="{{!form_dbName!}}" placeholder="{{!form_ph_dbName!}}" value="{{!form_val_dbName!}}">
                                    </div>
                                </div>
                             <!--</form>-->
                        </div>
                    </div>
                </div>


            <div class="row">
                
                
<!--                <input type="hidden" name="db" value="done" />-->
                 <button class="btn btn-lg btn-primary btn-block" type="submit"> <span class="glyphicon glyphicon-check"></span> Valider les informations</button>
            </div> 
        </form>
        
    </div>
