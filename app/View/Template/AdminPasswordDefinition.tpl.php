


<div class="container-fluid"> 
    
    <div class="jumbotron">
      <div class="container">
        <h3>Modification du mot de passe administrateur</h3>
        <p>Dans ce formulaire vous allez pouvoir modifier le mot de passe administrateur</p>
      </div>
    </div>
    
    <form  method="post" action="{{! INDEX !}}" class="form-horizontal" >
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Informations relatives au mot de passe de l'administrateur de l'application SESE
                </div>
                <div class="panel-body">
                     
                        <div class="form-group">
                            <label for="inputdbSrv" class="control-label col-xs-2">Mot de passe actuel</label>
                            <div class="col-xs-10">
                                <input type="password" class="form-control" id="adminCurrentPassword" 
                                       placeholder="Entrez le mot de passe actuel de l'administrateur"
                                       name="{{!form_adminCurrentPassword!}}"
                                       value="{{!form_val_adminCurrentPassword!}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputdbUser" class="control-label col-xs-2">Nouveau mot de passe administrateur</label>
                            <div class="col-xs-10">
                                <input type="password" class="form-control" id="adminNewPassword" 
                                       placeholder="Nouveau mot de passe administrateur"
                                       name="{{!form_adminNewPassword!}}"
                                       value="{{!form_val_adminNewPassword!}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputdbPassword" class="control-label col-xs-2">Confirmez le nouveau mot de passe administrateur</label>
                            <div class="col-xs-10">
                                <input type="password" class="form-control" id="adminConfirmPassword" 
                                       placeholder="Confirmez le nouveau mot de passe administrateur"
                                       name="{{!form_adminConfirmPassword!}}"
                                       value="{{!form_val_adminConfirmPassword!}}">
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>

        <div class="row">
             <button class="btn btn-lg btn-primary btn-block" type="submit"> <span class="glyphicon glyphicon-check"></span> Valider les informations</button>
        </div> 
    </form>

</div>
