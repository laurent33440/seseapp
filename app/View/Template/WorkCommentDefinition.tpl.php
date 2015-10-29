
<!-- Main jumbotron for a call to action -->
<div class="jumbotron">
  <div class="container">
    <h3>Commentaires des visites de stage</h3>
    <p>Commentez les visites de stage réalisées. </p>
  </div>
</div>

<div class="container-fluid">

    <form  method="post" action="{{! INDEX !}}" class="form-horizontal" >
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Commentaires sur les visites de stage
                </div>
                <div class="panel-body">
                     <div class="table-responsive" id="visit_table">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="active">Stagiaire en responsabilité</th>
                                    <th class="active">Commentaire sur la visite </th>
                                    <th class="active"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (form_val_comments as $trainee => $comment) {
                                    echo"
                                        <tr>
                                            <td> 
                                                $trainee
                                            </td>
                                            <td>
                                                <div class=\"input-group\">
                                                    <textarea rows=\"4\" cols=\"80\" id=\"comment\"
                                                      name=\"form_comments#$trainee\"
                                                      placeholder=\"Entrez le commentaire de la visite du stagiaire\" />
                                                      $comment
                                                    </textarea>
                                                  
                                                </div><!-- /input-group -->
                                            </td>
                                            <td>
                                                  <span class=\"input-group-btn\">
                                                    <button class=\"btn btn-success\" name=\"BUTTON_ADD\" value=\"$trainee\" id=\"add#$trainee\" type=\"submit\">
                                                        <span class=\"glyphicon glyphicon-plus-sign\"></span>
                                                        Valider le commentaire
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
