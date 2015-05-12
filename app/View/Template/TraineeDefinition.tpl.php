


<div class="container-fluid">
    
    <div class="jumbotron">
      <div class="container">
        <h3> Création des stagiaires reconnus dans l'application SESE </h3>
        <p>Vous définissez ici les stagiaires inclus dans les promotions </p>
      </div>
    </div>

    <form  method="post" action="{{! INDEX !}}" class="form-horizontal" >
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Liste des stagiaires déjà enregistrés
                </div>
                <div class="panel-body">
                    <?php 
                    echo"
                    <select class=\"form-control\" name=\"form_traineesList\" id=\"traineeChoosenForUpdate\">";
                        foreach (form_val_traineesList as $idTrainee => $trainee) {
                            echo"
                                <option value=\"$idTrainee\">$trainee </option>
                            ";
                        }
                    echo "
                    </select>";
                    ?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Formulaire de création des stagiares
                </div>
                <div class="panel-body">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Promotion associé à ce stagiaire
                        </div>
                        <div class="panel-body">
                            <?php 
                            echo"
                            <select class=\"form-control\" name=\"form_promotionsList\" id=\"promotionChoosenForUpdate\">";
                                foreach (form_val_promotionsList as $idPromotion => $promotion) {
                                    echo"
                                        <option value=\"$idPromotion\">$promotion </option>
                                    ";
                                }
                            echo "
                            </select>";
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputAdminName" class="control-label col-xs-2">Nom du stagiare</label>
                        <div class="col-xs-10">
                            <input type="text" required class="form-control" id="inputAdminName" 
                                   name="{{!form_traineeLastName!}}" 
                                   placeholder="Nom du stagiaire"
                                   value="{{!form_val_traineeLastName!}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAdminPass" class="control-label col-xs-2">Prénom du stagiaire</label>
                        <div class="col-xs-10">
                            <input type="text" required class="form-control" id="inputAdminPass" 
                                   name="{{!form_traineeFirstName!}}"
                                   placeholder="Prénom du stagiaire"
                                   value="{{!form_val_traineeFirstName!}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAdminPass2" class="control-label col-xs-2">Mél du stagiaire </label>
                        <div class="col-xs-10">
                            <input type="email" required class="form-control" id="inputAdminPass2" 
                                   name="{{!form_traineeEmail!}}" 
                                   placeholder="mel du stagiaire"
                                   value="{{!form_val_traineeEmail!}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAdminPass2" class="control-label col-xs-2">Téléphone du stagiaire </label>
                        <div class="col-xs-10">
                            <input type="tel" required class="form-control" id="inputAdminPass2" 
                                   name="{{!form_traineePhone!}}" 
                                   placeholder="Téléphone du stagiaire"
                                   value="{{!form_val_traineePhone!}}">
                        </div>
                    </div>
                            
                            
                    <div class="col-md-4">
                        <button class="btn btn-success btn-block" name="{{!BUTTON_ADD_TEACHER!}}" id="addFunction" type="submit">
                            <span class="glyphicon glyphicon-plus-sign"></span>
                            Ajouter un stagiaire
                        </button>
                    </div>
                    <div class="col-md-4 col-md-offset-4">
                        <button class="btn btn-danger btn-block" name="{{!BUTTON_DEL_TEACHER!}}" id="delFunction" type="submit">
                            <span class="glyphicon glyphicon-minus-sign"></span>
                            Supprimer ce stagiaire
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
             <button class="btn btn-lg btn-primary btn-block" type="submit"> <span class="glyphicon glyphicon-check"></span> Terminer l'enregistrement des stagiaires</button>
        </div> 
    </form>

</div>
