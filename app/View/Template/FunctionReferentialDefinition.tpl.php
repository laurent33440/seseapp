
<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
  <div class="container">
    <h3>Etape de définition des fonctions liées au référentiel de formation </h3>
    <p>Dans cette étape vous allez définir les fonctions liées au référentiel de formation.</p>
    <!--<p><a class="btn btn-primary btn-lg" role="button"> <span class="glyphicon glyphicon-search"></span> En savoir plus &raquo;</a></p>-->
  </div>
</div>

<div class="container-fluid">

    <form  method="post" action="{{! INDEX !}}" class="form-horizontal" >
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Informations relatives au fonctions liées au référentiel
                </div>
                <div class="panel-body">
                     <div class="table-responsive" id="func_table">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="active">Descriptif de la fonction</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (form_val_descriptions as $ref => $value) {
                                    echo"
                                        <tr>
                                            <td>
                                                <div class=\"input-group\">
                                                  <input type=\"text\" class=\"form-control\"
                                                  id=\"foncDesc#$ref\"
                                                  name=\"form_descriptions#$ref\"
                                                  placeholder=\"Entrez le descriptif de la fonction\"
                                                  value = \"$value\">
                                                  <span class=\"input-group-btn\">
                                                    <button class=\"btn btn-success\" name=\"BUTTON_ADD_FUNCTION\" id=\"addFunction#$ref\" type=\"submit\">
                                                        <span class=\"glyphicon glyphicon-plus-sign\"></span>
                                                        Ajouter
                                                    </button>
                                                    <button class=\"btn btn-danger\" name=\"BUTTON_DEL_FUNCTION\" value=\"$ref\" id=\"delFunction#$ref\" type=\"submit\">
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
