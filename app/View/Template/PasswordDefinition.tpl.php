


<div class="container-fluid"> 
    
    <div class="jumbotron">
      <div class="container">
        <h3>TXT_HEADER1</h3>
        <p>TXT_HEADER2</p>
      </div>
    </div>
    
    <form  method="post" action="{{! INDEX !}}" class="form-horizontal" >
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    TXT_FORM
                </div>
                <div class="panel-body">
                     
                        <div class="form-group">
                            <label for="inputdbSrv" class="control-label col-xs-2">Mot de passe actuel</label>
                            <div class="col-xs-10">
                                <input type="password" class="form-control" id="adminCurrentPassword" 
                                       placeholder="Entrez le mot de passe actuel "
                                       name="{{!form_adminCurrentPassword!}}"
                                       value="{{!form_val_adminCurrentPassword!}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputdbUser" class="control-label col-xs-2">Nouveau mot de passe </label>
                            <div class="col-xs-10">
                                <input type="password" class="form-control" id="adminNewPassword" 
                                       placeholder="Nouveau mot de passe "
                                       name="{{!form_adminNewPassword!}}"
                                       value="{{!form_val_adminNewPassword!}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputdbPassword" class="control-label col-xs-2">Confirmez le nouveau mot de passe </label>
                            <div class="col-xs-10">
                                <input type="password" class="form-control" id="adminConfirmPassword" 
                                       placeholder="Confirmez le nouveau mot de passe "
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
