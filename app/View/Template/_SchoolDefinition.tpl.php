
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h3>Etape de définition de l'établissement de formation </h3>
        <p>Dans cette étape vous allez définir les informations utiles à la définition de l'établissement de formation.</p>
        <!--<p><a class="btn btn-primary btn-lg" role="button"> <span class="glyphicon glyphicon-search"></span> En savoir plus &raquo;</a></p>-->
      </div>
    </div>
    
   
    
    <div class="container">

        <form  method="post" action="{{! INDEX !}}" class="form-horizontal" >
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Informations relatives  à l'établissement de formation
                    </div>
                    <div class="panel-body">
                         <!--<form class="form-horizontal">-->
                            <div class="form-group">
                                <label for="inputAdminName" class="control-label col-xs-2">Nom de l'établissement</label>
                                <div class="col-xs-10">
                                    <input type="text" required class="form-control" id="inputAdminName" 
                                           name="{{!form_schoolName!}}" 
                                           placeholder="Nom de l'établissement de formation"
                                           value="{{!form_val_schoolName!}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAdminPass" class="control-label col-xs-2">N° de SIRET de l'établissement</label>
                                <div class="col-xs-10">
                                    <input type="text" required class="form-control" id="inputAdminPass" 
                                           name="{{!form_schoolSiret!}}"
                                           placeholder=""
                                           value="{{!form_val_schoolSiret!}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAdminPass2" class="control-label col-xs-2">Adresse principale de l'établissement </label>
                                <div class="col-xs-10">
                                    <input type="text" required class="form-control" id="inputAdminPass2" 
                                           name="{{!form_schoolAddress1!}}" 
                                           placeholder=""
                                           value="{{!form_val_schoolAddress1!}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAdminPass2" class="control-label col-xs-2">Adresse secondaire de l'établissement </label>
                                <div class="col-xs-10">
                                    <input type="text" required class="form-control" id="inputAdminPass2" 
                                           name="{{!form_schoolAddress2!}}" 
                                           placeholder="Si utile"
                                           value="{{!form_val_schoolAddress2!}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAdminPass2" class="control-label col-xs-2">Ville de l'établissement </label>
                                <div class="col-xs-10">
                                    <input type="text" required class="form-control" id="inputAdminPass2" 
                                           name="{{!form_schoolCity!}}" 
                                           placeholder=""
                                           value="{{!form_val_schoolCity!}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAdminPass2" class="control-label col-xs-2">Code postal du lieu de l'établissement </label>
                                <div class="col-xs-10">
                                    <input type="text" required class="form-control" id="inputAdminPass2" 
                                           name="{{!form_schoolZipCode!}}" 
                                           placeholder=""
                                           value="{{!form_val_schoolZipCode!}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAdminPass2" class="control-label col-xs-2">Numéro de téléphone de l'établissement </label>
                                <div class="col-xs-10">
                                    <input type="text" required class="form-control" id="inputAdminPass2" 
                                           name="{{!form_schoolPhone!}}" 
                                           placeholder=""
                                           value="{{!form_val_schoolPhone!}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAdminPass2" class="control-label col-xs-2">Adresse du site internet de l'établissement </label>
                                <div class="col-xs-10">
                                    <input type="text" required class="form-control" id="inputAdminPass2" 
                                           name="{{!form_schoolUrl!}}" 
                                           placeholder="S'il existe"
                                           value="{{!form_val_schoolUrl!}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAdminMel" class="control-label col-xs-2">Adresse mél de l'établissement</label>
                                <div class="col-xs-10">
                                    <input type="email" required class="form-control" id="inputAdminMel" 
                                           name="{{!form_schoolEmail!}}" 
                                           placeholder="Adresse mél de l'établissement"
                                           value="{{!form_val_schoolEmail!}}">
                                </div>
                            </div>
                         <!--</form>-->
                    </div>
                </div>
            </div>


            <div class="row">
                 <button class="btn btn-lg btn-primary btn-block" type="submit"> <span class="glyphicon glyphicon-check"></span> Valider les informations</button>
            </div> 
        </form>
        
    </div>
