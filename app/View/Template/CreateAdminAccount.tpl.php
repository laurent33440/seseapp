


    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h3>Etape de création de l'administrateur de l'application</h3>
        <p>Dans cette étape vous allez définir les informations utiles à la définition de l'administrateur de l'application.</p>
        <!--<p><a class="btn btn-primary btn-lg" role="button"> <span class="glyphicon glyphicon-search"></span> En savoir plus &raquo;</a></p>-->
      </div>
    </div>
    
   
    
    <div class="container">

        <form  method="post" action="{{! INDEX !}}" class="form-horizontal" >
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Informations relatives  à la création de l'administrateur de l'application 
                    </div>
                    <div class="panel-body">
                         <!--<form class="form-horizontal">-->
                            <div class="form-group">
                                <label for="inputAdminName" class="control-label col-xs-2">Nom de l'administrateur</label>
                                <div class="col-xs-10">
                                    <input type="text" required class="form-control" id="inputAdminName" 
                                           name="{{!form_adminName!}}" 
                                           placeholder="{{!form_ph_adminName!}}" 
                                           value="{{!form_val_adminName!}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAdminPass" class="control-label col-xs-2">Mot de passe de l'administrateur</label>
                                <div class="col-xs-10">
                                    <input type="password" required class="form-control" id="inputAdminPass" 
                                           name="{{!form_adminPass!}}"
                                           placeholder="{{!form_ph_adminPass!}}"
                                           value="{{!form_val_adminPass!}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAdminPass2" class="control-label col-xs-2">Confirmation du mot de passe de l'administrateur</label>
                                <div class="col-xs-10">
                                    <input type="password" required class="form-control" id="inputAdminPass2" 
                                           name="{{!form_adminPassConfirm!}}" 
                                           placeholder="{{!form_ph_adminPassConfirm!}}"
                                           value="{{!form_val_adminPassConfirm!}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAdminMel" class="control-label col-xs-2">Adresse mél de l'administrateur</label>
                                <div class="col-xs-10">
                                    <input type="email" required class="form-control" id="inputAdminMel" 
                                           name="{{!form_adminEmail!}}" 
                                           placeholder="{{!form_ph_adminEmail!}}"
                                           value="{{!form_val_adminEmail!}}">
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
