

<!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h3>Etape de définition des activités liées au référentiel de formation </h3>
        <p>Dans cette étape vous allez définir les activités liées au référentiel de formation et aux fonctions déjà définies.</p>
        <!--<p><a class="btn btn-primary btn-lg" role="button"> <span class="glyphicon glyphicon-search"></span> En savoir plus &raquo;</a></p>-->
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
                                    <th class="active">Référence de l'activité</th>
                                    <th class="active">Fonction associée</th>
                                    <th class="active">Descriptif de l'activité</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (form_val_activitiesDescriptionsList as $idSkill => $skill) {
                                    echo"
                                    <tr>
                                        <td>
                                            <div class=\"input-group\">
                                              <input type=\"text\" class=\"form-control\"
                                              id=\"activityReference#$idSkill\"
                                              name=\"form_activitiesReferencesList#$idSkill\"
                                              placeholder=\"Entrez la référence de l'activité\"
                                              value=\"".form_val_activitiesReferencesList[$idSkill]."\">
                                            </div><!-- /input-group -->
                                        </td>
                                        <td>

                                            <select class=\"form-control\" name=\"form_functionsList#$idSkill\" id=\"functionChoosenForActivity#$idSkill\">";
                                            foreach (form_val_functionsList[$idSkill] as $idFunction => $function) {
                                                echo"
                                                    <option
                                                        value=\"$function\">$function
                                                    </option>
                                                ";
                                            }
                                    echo "
                                            </select>
                                        </td>
                                        <td>
                                            <div class=\"input-group\">
                                                <input type=\"text\" class=\"form-control\"
                                                id=\"activityDescription#$idSkill\"
                                                name=\"form_activitiesDescriptionsList#$idSkill\"
                                                placeholder=\"Entrez le descriptif de l'activité\"
                                                value = \"$skill\"
                                                >
                                                <span class=\"input-group-btn\">
                                                    <button class=\"btn btn-success\" name=\"BUTTON_ADD_ACTIVITY\" value=\"$idSkill\" id=\"addActivity#$idSkill\" type=\"submit\">
                                                        <span class=\"glyphicon glyphicon-plus-sign\"></span>
                                                        Ajouter
                                                    </button>
                                                    <button class=\"btn btn-danger\" name=\"BUTTON_DEL_ACTIVITY\" value=\"$idSkill\" id=\"delActivity#$idSkill\" type=\"submit\">
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