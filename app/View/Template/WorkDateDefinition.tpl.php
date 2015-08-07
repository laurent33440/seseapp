<div class="container-fluid">
    
    <div class="jumbotron">
      <div class="container">
        <h3>Etape de définition des dates de stages liées à l'établissement de formation </h3>
        <p>Dans cette étape vous allez définir les intitulés et les dates de stages associées .</p>
        <!--<p><a class="btn btn-primary btn-lg" role="button"> <span class="glyphicon glyphicon-search"></span> En savoir plus &raquo;</a></p>-->
      </div>
    </div>

    <form  method="post" action="{{! INDEX !}}" class="form-horizontal" >
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Informations relatives aux stages liées à l'établissement de formation
                </div>
                <div class="panel-body">
                     <div class="table-responsive" id="func_table">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:40%" class="active">Dénomination du stage</th>
                                    <th style="width:20%" class="active">Date de début de stage</th>
                                    <th style="width:20%" class="active">Date de fin de stage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (form_val_workDateName as $idWork=>$work ) {
                                    echo"
                                        <tr>
                                            <td> 
                                                <div class=\"input-group\">
                                                  <input type=\"text\" class=\"form-control\"
                                                  id=\"_workDateName#$idWork\"
                                                  name=\"form_workDateName##$idWork\"
                                                  placeholder=\"Entrez la dénomination de la période de stage\"
                                                  value = \"$work\">
                                               </div><!-- /input-group -->
                                            </td>
                                            <td> 
                                                <div class=\"input-group\">
                                                  <input type=\"date\" class=\"form-control\"
                                                  id=\"_dateOn#$idWork\"
                                                  name=\"form_dateOn##$idWork\"
                                                  placeholder=\"Entrez la date de début de stage\"
                                                  value = \"".form_val_dateOn[$idWork]."\">
                                               </div><!-- /input-group -->
                                            </td>
                                            <td>
                                                <div class=\"input-group\">
                                                  <input type=\"date\" class=\"form-control\"
                                                  id=\"_dateOff#$idWork\"
                                                  name=\"form_dateOff##$idWork\"
                                                  placeholder=\"Entrez la date de fin de stage\"
                                                  value = \"".form_val_dateOff[$idWork]."\">
                                                  <span class=\"input-group-btn\">
                                                    <button class=\"btn btn-success\" name=\"BUTTON_ADD_PROMOTION\" value=\"$idWork\" id=\"addWorkdate#$work\" type=\"submit\">
                                                        <span class=\"glyphicon glyphicon-plus-sign\"></span>
                                                        Ajouter
                                                    </button>
                                                    <button class=\"btn btn-danger\" name=\"BUTTON_DEL_PROMOTION\" value=\"$idWork\" id=\"delWorkdate#$idWork\" type=\"submit\">
                                                        <span class=\"glyphicon glyphicon-minus-sign\"></span>
                                                        Supprimer
                                                    </button>
                                                  </span>
                                                </div><!-- /input-group -->
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