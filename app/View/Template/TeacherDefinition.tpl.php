


<div class="container-fluid">
    
    <div class="jumbotron">
        <div class="container">
          <h3> Création des enseignants reconnus dans l'application SESE </h3>
          <p>Vous définissez ici les enseignants intervenant sur les promotions des stagiaires</p>
        </div>
    </div>

    <form  method="post" action="{{! INDEX !}}" class="form-horizontal" >
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Liste des enseignants déjà enregistrés
                </div>
                <div class="panel-body">
                    <?php 
                    echo"
                    <select class=\"form-control\" name=\"form_teachersList\" id=\"teacherChoosenForUpdate\">";
                        foreach (form_val_teachersList as $idPromotion => $teacher) {
                            echo"
                                <option value=\"$idPromotion\">$teacher </option>
                            ";
                        }
                    echo "
                    </select>";
                    ?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Formulaire de création des enseignants
                </div>
                <div class="panel-body">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Promotion associé à cet enseignant
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
                        <label for="inputAdminName" class="control-label col-xs-2">Nom de l'enseignant</label>
                        <div class="col-xs-10">
                            <input type="text" required class="form-control" id="inputAdminName" 
                                   name="{{!form_teacherLastName!}}" 
                                   placeholder="Nom de l'enseignant"
                                   value="{{!form_val_teacherLastName!}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAdminPass" class="control-label col-xs-2">Prénom de l'enseignant</label>
                        <div class="col-xs-10">
                            <input type="text" required class="form-control" id="inputAdminPass" 
                                   name="{{!form_teacherFirstName!}}"
                                   placeholder="Prénom de l'enseignant"
                                   value="{{!form_val_teacherFirstName!}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAdminPass2" class="control-label col-xs-2">Mél de l'enseignant </label>
                        <div class="col-xs-10">
                            <input type="mail" required class="form-control" id="inputAdminPass2" 
                                   name="{{!form_teacherMail!}}" 
                                   placeholder=""
                                   value="{{!form_val_teacherMail!}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAdminPass2" class="control-label col-xs-2">Discipline de l'enseignant </label>
                        <div class="col-xs-10">
                            <input type="text" required class="form-control" id="inputAdminPass2" 
                                   name="{{!form_teacherSkill!}}" 
                                   placeholder="Discipline de l'enseignant"
                                   value="{{!form_val_teacherSkill!}}">
                        </div>
                    </div>
                            
                            
                    <div class="col-md-4">
                        <button class="btn btn-success btn-block" name="{{!BUTTON_ADD_TEACHER!}}" id="addFunction" type="submit">
                            <span class="glyphicon glyphicon-plus-sign"></span>
                            Ajouter un enseignant
                        </button>
                    </div>
                    <div class="col-md-4 col-md-offset-4">
                        <button class="btn btn-danger btn-block" name="{{!BUTTON_DEL_TEACHER!}}" id="delFunction" type="submit">
                            <span class="glyphicon glyphicon-minus-sign"></span>
                            Supprimer cet enseignant
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
             <button class="btn btn-lg btn-primary btn-block" type="submit"> <span class="glyphicon glyphicon-check"></span> Terminer l'enregistrement des enseignants</button>
        </div> 
    </form>

</div>
