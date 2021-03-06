

    <div class="jumbotron">
      <div class="container">
        <h3>Etape de définition des activités liées au référentiel de formation </h3>
        <p>Dans cette étape vous allez définir les activités liées au référentiel de formation et aux fonctions déjà définies.</p>
      </div>
    </div>

<div class="container-fluid">

    <form  method="post" action="{{! INDEX !}}" class="form-horizontal" >
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Informations relatives aux activités liées au référentiel
                </div>
                <div class="panel-body">
                     <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th  style="width:10%;" class="active">Référence de l'activité</th>
                                    <th  style="width:30%;"class="active">Fonction associée</th>
                                    <th  style="width:60%;"class="active">Descriptif de l'activité</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (form_val_activityRefList as $idActivity => $activityRef) {
                                    echo"
                                    <tr>
                                        <td>
                                            <div class=\"input-group\">
                                              <input type=\"text\" class=\"form-control\"
                                              id=\"_activityRefList#$idActivity\"
                                              name=\"form_activityRefList##$idActivity\"
                                              placeholder=\"Entrez la référence de l'activité\"
                                              value=\"".$activityRef."\">
                                            </div><!-- /input-group -->
                                        </td>
                                        <td>

                                            <select class=\"form-control\" name=\"form_functionList##$idActivity\" id=\"_functionList#$idActivity\">";
                                            foreach (form_val_functionList[$idActivity] as $idFunction => $function) {
                                               
                                                    echo"
                                                        <option
                                                            value=\"$idFunction#$function\">$function
                                                        </option>
                                                    ";
                                                
                                            }
                                    echo "
                                            </select>
                                        </td>
                                        <td>
                                            <div class=\"input-group\">
                                                <input type=\"text\" class=\"form-control\"
                                                id=\"_activityDescriptionList#$idActivity\"
                                                name=\"form_activityDescriptionList##$idActivity\"
                                                placeholder=\"Entrez le descriptif de l'activité\"
                                                value = \"".form_val_activityDescriptionList[$idActivity]."\"
                                                >
                                                <span class=\"input-group-btn\">
                                                    <button class=\"btn btn-success\" name=\"BUTTON_ADD_ACTIVITY\" value=\"$idActivity\" id=\"addActivity#$idActivity\" type=\"submit\">
                                                        <span class=\"glyphicon glyphicon-plus-sign\"></span>
                                                        Ajouter
                                                    </button>
                                                    <button class=\"btn btn-danger\" name=\"BUTTON_DEL_ACTIVITY\" value=\"$idActivity\" id=\"delActivity#$idActivity\" type=\"submit\">
                                                        <span class=\"glyphicon glyphicon-minus-sign\"></span>
                                                        Supprimer
                                                    </button>
                                                </span>
                                            </div><!-- /input-group -->
                                        </td>

                                    </tr>
                                    ";
                                }
                                ?>


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>




        <div class="row">
             <button class="btn btn-lg btn-primary btn-block" type="submit"> <span class="glyphicon glyphicon-check"></span> Valider les informations</button>
        </div> 
    </form>
        
</div>