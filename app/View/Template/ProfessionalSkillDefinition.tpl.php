
<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
  <div class="container">
    <h3>Etape de définition des critères de comportements en milieu professionnel </h3>
    <p>Dans cette étape vous allez définir les critères d'évaluation des comportements professionnels.</p>
  </div>
</div>

<div class="container-fluid">

    <form  method="post" action="{{! INDEX !}}" class="form-horizontal" >
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Informations relatives critères professionnels
                </div>
                <div class="panel-body">
                     <div class="table-responsive" id="func_table">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="active">Descriptif du critère d'évaluation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (form_val_descriptionList as $idFunc => $value) {
                                    echo"
                                        <tr>
                                            <td>
                                                <div class=\"input-group\">
                                                  <input type=\"text\" class=\"form-control\"
                                                  id=\"_descriptionList#$idFunc\"
                                                  name=\"form_descriptionList##$idFunc\"
                                                  placeholder=\"Entrez le descriptif de la fonction\"
                                                  value = \"$value\">
                                                  <span class=\"input-group-btn\">
                                                    <button class=\"btn btn-success\" name=\"BUTTON_ADD_FUNCTION\" value=\"$idFunc\" id=\"addFunction#$idFunc\" type=\"submit\">
                                                        <span class=\"glyphicon glyphicon-plus-sign\"></span>
                                                        Ajouter
                                                    </button>
                                                    <button class=\"btn btn-danger\" name=\"BUTTON_DEL_FUNCTION\" value=\"$idFunc\" id=\"delFunction#$idFunc\" type=\"submit\">
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
