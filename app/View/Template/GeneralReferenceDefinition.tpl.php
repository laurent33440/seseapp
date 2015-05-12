
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h3>Etape de définition du référentiel de formation </h3>
        <p>Dans cette étape vous allez définir les informations générales du référentiel de formation.</p>
      </div>
    </div>
    
   
    
    <div class="container-fluid">

        <form  method="post" action="{{! INDEX !}}" class="form-horizontal" >
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Informations relatives au référentiel de formation
                    </div>
                    <div class="panel-body">
                         <!--<form class="form-horizontal">-->
                            <div class="form-group">
                                <label for="inputTxt1" class="control-label col-xs-2">Nom de la formation</label>
                                <div class="col-xs-10">
                                    <input type="text" required class="form-control" id="inputAdminName" 
                                           name="{{!form_trainingName!}}" 
                                           placeholder=""
                                           value="{{!form_val_trainingName!}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputTxt2" class="control-label col-xs-2">Domaine de formation</label>
                                <div class="col-xs-10">
                                    <input type="text" required class="form-control" id="inputAdminPass" 
                                           name="{{!form_trainingDomain!}}" 
                                           placeholder="form_ph_trainingDomain"
                                           value="{{!form_val_trainingDomain!}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputTxt3" class="control-label col-xs-2"> Référence du référentiel </label>
                                <div class="col-xs-10">
                                    <input type="text" required class="form-control" id="inputAdminPass2" 
                                           name="{{!form_referentialReference!}}" 
                                           placeholder=""
                                           value="{{!form_val_referentialReference!}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputTxt4" class="control-label col-xs-2">Nom du référentiel </label>
                                <div class="col-xs-10">
                                    <input type="text" required class="form-control" id="inputAdminPass2" 
                                           name="{{!form_referencialName!}}" 
                                           placeholder=""
                                           value="{{!form_val_referencialName!}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputTxt5" class="control-label col-xs-2">Descriptif sommaire du référentiel </label>
                                <div class="col-xs-10">
                                    <input type="text" required class="form-control" id="inputAdminPass2" 
                                           name="{{!form_referentialSpecification!}}" 
                                           placeholder=""
                                           value="{{!form_val_referentialSpecification!}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputTxt6" class="control-label col-xs-2">Durée de la formation en mois </label>
                                <div class="col-xs-10">
                                    <input type="text" required class="form-control" id="inputAdminPass2" 
                                           name="{{!form_trainingTime!}}" 
                                           placeholder=""
                                           value="{{!form_val_trainingTime!}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputTxt7" class="control-label col-xs-2">Durée totale des stages en jour(s) </label>
                                <div class="col-xs-10">
                                    <input type="text" required class="form-control" id="inputAdminPass2" 
                                           name="{{!form_internshipDuration!}}" 
                                           placeholder=""
                                           value="{{!form_val_internshipDuration!}}">
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
