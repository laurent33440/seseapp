
<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
  <div class="container">
    <h3>Etape de définition des promotions liées à l'établissement de formation </h3>
    <p>Dans cette étape vous allez définir les promotions liées à l'établissement de formation.</p>
    <!--<p><a class="btn btn-primary btn-lg" role="button"> <span class="glyphicon glyphicon-search"></span> En savoir plus &raquo;</a></p>-->
  </div>
</div>

<div class="container-fluid">

    <form  method="post" action="{{! INDEX !}}" class="form-horizontal" >
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Informations relatives au Promotion liées à l'établissement de formation
                </div>
                <div class="panel-body">
                     <div class="table-responsive" id="func_table">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:15%" class="active">Référence de la promotion </th>
                                    <th style="width:85%" class="active">Descriptif de la promotion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (form_val_references as $idPromotion=>$ref ) {
                                    echo"
                                        <tr>
                                            <td> 
                                                <div class=\"input-group\">
                                                  <input type=\"text\" class=\"form-control\"
                                                  id=\"_references#$idPromotion\"
                                                  name=\"form_references##$idPromotion\"
                                                  placeholder=\"Entrez la référence de la promotion\"
                                                  value = \"$ref\">
                                               </div><!-- /input-group -->
                                            </td>
                                            <td>
                                                <div class=\"input-group\">
                                                  <input type=\"text\" class=\"form-control\"
                                                  id=\"_descriptions#$idPromotion\"
                                                  name=\"form_descriptions##$idPromotion\"
                                                  placeholder=\"Entrez le descriptif de la promotion\"
                                                  value = \"".form_val_descriptions[$idPromotion]."\">
                                                  <span class=\"input-group-btn\">
                                                    <button class=\"btn btn-success\" name=\"BUTTON_ADD_PROMOTION\" value=\"$idPromotion\" id=\"addPromotion#$ref\" type=\"submit\">
                                                        <span class=\"glyphicon glyphicon-plus-sign\"></span>
                                                        Ajouter
                                                    </button>
                                                    <button class=\"btn btn-danger\" name=\"BUTTON_DEL_PROMOTION\" value=\"$idPromotion\" id=\"delPromotion#$ref\" type=\"submit\">
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
