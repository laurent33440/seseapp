
<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
  <div class="container">
    <h3>Définition des visites de stage</h3>
    <p>Définissez les visites des stagiaires qui vous sont attribués. </p>
    <!--<p><a class="btn btn-primary btn-lg" role="button"> <span class="glyphicon glyphicon-search"></span> En savoir plus &raquo;</a></p>-->
  </div>
</div>

<div class="container-fluid">

    <form  method="post" action="{{! INDEX !}}" class="form-horizontal" >
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Visites de stage
                </div>
                <div class="panel-body">
                     <div class="table-responsive" id="visit_table">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="active">Stagiaire en responsabilité</th>
                                    <th class="active">Date et heure de visite</th>
                                    <th class="active"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (form_val_visits as $trainee => $date) {
                                    echo"
                                        <tr>
                                            <td> 
                                                $trainee
                                            </td>
                                            <td>
                                                <div class=\"input-group\">
                                                  <input type=\"text\" class=\"form-control\"
                                                  id=\"datePicker\"
                                                  name=\"form_visits#$trainee\"
                                                  placeholder=\"Entrez la date de visite du stagiaire\"
                                                  value = \"$date\"/>
                                                </div><!-- /input-group -->
                                            </td>
                                            <td>
                                                  <span class=\"input-group-btn\">
                                                    <button class=\"btn btn-success\" name=\"BUTTON_ADD\" id=\"add#$trainee\" type=\"submit\">
                                                        <span class=\"glyphicon glyphicon-plus-sign\"></span>
                                                        Ajouter
                                                    </button>
                                                    <button class=\"btn btn-danger\" name=\"BUTTON_DEL\" value=\"$trainee\" id=\"del#$trainee\" type=\"submit\">
                                                        <span class=\"glyphicon glyphicon-minus-sign\"></span>
                                                        Supprimer
                                                    </button>
                                                  </span>
                                                
                                            </td>
                                        </tr>
                                    ";
                                } ?>
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
