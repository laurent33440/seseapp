
<!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h3>Etape de définition des compétences liées au référentiel de formation </h3>
        <p>Dans cette étape vous allez définir les compétences liées au référentiel de formation et l'association des activités déjà définies.</p>
      </div>
    </div>

<div class="container">
    <form  method="post" action="{{! INDEX !}}" class="form-horizontal" >
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Informations relatives aux compétences liées au référentiel
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="active">Référence de la compétence</th>
                                    <th class="active">Descriptif de la compétence</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (form_val_skillsDescriptionsList as $idSkill => $skill) {
                                    echo"
                                    <tr>
                                        <td>
                                            <div class=\"input-group\">
                                              <input type=\"text\" class=\"form-control\"
                                              id=\"_skillsReferencesList#$idSkill\"
                                              name=\"form_skillsReferencesList##$idSkill\"
                                              placeholder=\"Entrez la référence de la compétence\"
                                              value=\"".form_val_skillsReferencesList[$idSkill]."\"
                                              >
                                            </div><!-- /input-group -->
                                        </td>
                                        <td>
                                            <div class=\"input-group\">
                                                <input type=\"text\" class=\"form-control\"
                                                id=\"_skillsDescriptionsList#$idSkill\"
                                                name=\"form_skillsDescriptionsList##$idSkill\"
                                                placeholder=\"Entrez le descriptif de la compétence\"
                                                value = \"$skill\"
                                                >
                                                <span class=\"input-group-btn\">
                                                    <button class=\"btn btn-success\" name=\"BUTTON_ADD_SKILL\" value=\"$idSkill\" id=\"addSkill#$idSkill\" type=\"submit\">
                                                        <span class=\"glyphicon glyphicon-plus-sign\"></span>
                                                        Ajouter
                                                    </button>
                                                    <button class=\"btn btn-danger\" name=\"BUTTON_DEL_SKILL\" value=\"$idSkill\" id=\"delSkill#$idSkill\" type=\"submit\">
                                                        <span class=\"glyphicon glyphicon-minus-sign\"></span>
                                                        Supprimer
                                                    </button>
                                                </span>
                                            </div><!-- /input-group -->
                                        </td>
                                    </tr>
                                    
                                
                                <!-- liste les activités associées à la compétence --> 
                                    <tr>
                                        <td colspan=\"2\">
                                            <div class=\"panel panel-default\">
                                                <div class=\"panel-heading\">
                                                    Liste des activités associées à la compétence
                                                </div>
                                                <div class=\"panel-body\">
                                                     <div class=\"table-responsive\">
                                                        <table class=\"table table-hover table-striped table-bordered\">
                                                            <thead>
                                                                <tr>
                                                                    <th class=\"active\">Descriptif des activités associées</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            ";
                                                                foreach (form_val_bindedActivitiesLists[$idSkill] as $activityId => $activityBinded ) { // for a given skill list all activities binded                                                                    
                                                                    echo"
                                                                    <tr>
                                                                        <td>
                                                                            <div class=\"input-group\">
                                                                              <select class=\"form-control\" name=\"form_bindedActivitiesLists##$idSkill#$idSkill\" id=\"activityChoosenForSkill#$idSkill#$activityId\">
                                                                                ";
                                                                                foreach (form_val_activitiesList as $selectedActivityId => $activity) { //list all activities available
                                                                                    if($selectedActivityId===$activityId){// find binded activity in list
                                                                                        $selected= 'selected="selected"';
                                                                                        $activityIdAlreadySelected = $activityId;
                                                                                    }else{
                                                                                        $selected='';
                                                                                    }
                                            
                                                                                    echo"
                                                                                    <option
                                                                                        $selected
                                                                                        value=\"$selectedActivityId\">$activity
                                                                                    </option>
                                                                                    ";
                                                                                }
                                                                                echo "
                                                                              </select>
                                                                              <span class=\"input-group-btn\">
                                                                                <button class=\"btn btn-sm btn-info\" name=\"BUTTON_BIND_ACTIVITY\" value=\"$idSkill\" id=\"addActivity#$idSkill\" type=\"submit\">
                                                                                    <span class=\"glyphicon glyphicon-paperclip\"></span>
                                                                                    Associer</button>
                                                                                <button class=\"btn btn-sm btn-warning\" name=\"BUTTON_FREE_ACTIVITY\" value=\"$idSkill#$activityIdAlreadySelected\" id=\"delActivity#$idSkill\" type=\"submit\">
                                                                                    <span class=\"glyphicon glyphicon-resize-full\"></span>
                                                                                    Dissocier</button>
                                                                              </span>
                                                                            </div><!-- /input-group -->
                                                                        </td>

                                                                    </tr>
                                                                    ";
                                                                    
                                                                }
                                                                echo"
                                                                 </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
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

