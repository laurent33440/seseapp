


<div class="container-fluid">
    
    <div class="jumbotron">
        <div class="container">
          <h3> Création des stage pour les promotions et stagiaires associés </h3>
          <p>Vous définissez ici les informations concernant les stages à créer </p>
        </div>
    </div>

    <form  method="post" action="{{! INDEX !}}" class="form-horizontal" >
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Liste des dénominations de stages déjà enregistrées
                </div>
                <div class="panel-body">
                    <?php 
                    echo"
                    <select class=\"form-control\" name=\"form_workNameList\" id=\"workUpdate\">";
                        foreach (form_val_workNameList as $idWork => $work) {
                            echo"
                                <option value=\"$idWork\">$work </option>
                            ";
                        }
                    echo "
                    </select>";
                    ?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Liste des stagiaires associés à la promotion
                </div>
                <div class="panel-body">
                    <?php 
                    echo"
                    <select class=\"form-control\" name=\"form_traineeList\" id=\"traineeUpdate\">";
                        foreach (form_val_traineeList as $idTrainee => $trainee) {
                            echo"
                                <option value=\"$idTrainee\">$trainee </option>
                            ";
                        }
                    echo "
                    </select>";
                    ?>
                </div>
            </div>
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    Choix du professeur référant
                </div>
                <div class="panel-body">
                    <?php 
                    echo"
                    <select class=\"form-control\" name=\"form_teacherList\" id=\"teacherUpdate\">";
                        foreach (form_val_teacherList as $idTeacher => $teacher) {
                            echo"
                                <option value=\"$idTeacher\">$teacher </option>
                            ";
                        }
                    echo "
                    </select>";
                    ?>
                </div>
            </div>
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    Informations relatives à l'entreprise 
                </div>
                <div class="panel-body">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Entreprise déjà connues
                        </div>
                        <div class="panel-body">
                            <?php 
                            echo"
                            <select class=\"form-control\" name=\"form_companyList\" id=\"companyUpdate\">";
                                foreach (form_val_companyList as $idCompany => $company) {
                                    echo"
                                        <option value=\"$idCompany\">$company </option>
                                    ";
                                }
                            echo "
                            </select>";
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputAdminName" class="control-label col-xs-2">Nom de l'entreprise</label>
                        <div class="col-xs-10">
                            <input type="text" required class="form-control" id="inputAdminName" 
                                   name="{{!form_companyName!}}" 
                                   placeholder="Nom de l'enseignant"
                                   value="{{!form_val_companyName!}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAdminPass" class="control-label col-xs-2">Activité principale de l'entreprise</label>
                        <div class="col-xs-10">
                            <input type="text" required class="form-control" id="inputAdminPass" 
                                   name="{{!form_companyActivity!}}"
                                   placeholder="Prénom de l'enseignant"
                                   value="{{!form_val_companyActivity!}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAdminPass2" class="control-label col-xs-2">N° de SIRET de l'entreprise </label>
                        <div class="col-xs-10">
                            <input type="mail" required class="form-control" id="inputAdminPass2" 
                                   name="{{!form_companySiret!}}" 
                                   placeholder=""
                                   value="{{!form_val_companySiret!}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAdminPass2" class="control-label col-xs-2">Adresse de l'entreprise </label>
                        <div class="col-xs-10">
                            <input type="text" required class="form-control" id="inputAdminPass2" 
                                   name="{{!form_companyAddress!}}" 
                                   placeholder="Discipline de l'enseignant"
                                   value="{{!form_val_companyAddress!}}">
                        </div>
                    </div>
                            
                    <div class="form-group">
                        <label for="inputAdminPass2" class="control-label col-xs-2">Ville de l'entreprise</label>
                        <div class="col-xs-10">
                            <input type="text" required class="form-control" id="inputAdminPass2" 
                                   name="{{!form_companyCity!}}" 
                                   placeholder="Discipline de l'enseignant"
                                   value="{{!form_val_companyCity!}}">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputAdminPass2" class="control-label col-xs-2">Code postal du lieu de l'entreprise </label>
                        <div class="col-xs-10">
                            <input type="text" required class="form-control" id="inputAdminPass2" 
                                   name="{{!form_companyZip!}}" 
                                   placeholder="Discipline de l'enseignant"
                                   value="{{!form_val_companyZip!}}">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputAdminPass2" class="control-label col-xs-2">Numéro de téléphone de l'entreprise </label>
                        <div class="col-xs-10">
                            <input type="text" required class="form-control" id="inputAdminPass2" 
                                   name="{{!form_companyPhone!}}" 
                                   placeholder="Discipline de l'enseignant"
                                   value="{{!form_val_companyPhone!}}">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputAdminPass2" class="control-label col-xs-2">Adresse mél de  l'entreprise </label>
                        <div class="col-xs-10">
                            <input type="text" required class="form-control" id="inputAdminPass2" 
                                   name="{{!form_companyEmail!}}" 
                                   placeholder="Discipline de l'enseignant"
                                   value="{{!form_val_companyEmail!}}">
                        </div>
                    </div>
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Collaborateurs de l'entreprise déjà connus tuteur du stage
                        </div>
                        <div class="panel-body">
                            <?php 
                            echo"
                            <select class=\"form-control\" name=\"form_employeeList\" id=\"emloyeeUpdate\">";
                                foreach (form_val_employeeList as $idEmployee => $employee) {
                                    echo"
                                        <option value=\"$idEmployee\">$employee </option>
                                    ";
                                }
                            echo "
                            </select>";
                            ?>
                            
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Informations concernant ce collaborateur
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="inputAdminName" class="control-label col-xs-2">Nom du tuteur</label>
                                            <div class="col-xs-10">
                                            <input type="text" required class="form-control" id="inputAdminName" 
                                                   name="{{!form_employeeLastName!}}" 
                                                   placeholder="Nom de l'enseignant"
                                                   value="{{!form_val_employeeLastName!}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAdminName" class="control-label col-xs-2">Prénom du tuteur</label>
                                            <div class="col-xs-10">
                                            <input type="text" required class="form-control" id="inputAdminName" 
                                                   name="{{!form_employeeFirstName!}}" 
                                                   placeholder="Nom de l'enseignant"
                                                   value="{{!form_val_employeeFirstName!}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAdminName" class="control-label col-xs-2">Téléphone du tuteur</label>
                                            <div class="col-xs-10">
                                            <input type="text" required class="form-control" id="inputAdminName" 
                                                   name="{{!form_employeePhone!}}" 
                                                   placeholder="Nom de l'enseignant"
                                                   value="{{!form_val_employeePhone!}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAdminName" class="control-label col-xs-2">Mél du tuteur</label>
                                            <div class="col-xs-10">
                                            <input type="text" required class="form-control" id="inputAdminName" 
                                                   name="{{!form_employeeEmail!}}" 
                                                   placeholder="Nom de l'enseignant"
                                                   value="{{!form_val_employeeEmail!}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAdminName" class="control-label col-xs-2">Rôle du tuteur dans l'entreprise</label>
                                            <div class="col-xs-10">
                                            <input type="text" required class="form-control" id="inputAdminName" 
                                                   name="{{!form_employeeRole!}}" 
                                                   placeholder="Nom de l'enseignant"
                                                   value="{{!form_val_employeeRole!}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                            
                    
                </div>
            </div>
        </div>

        <div class="row">
            
            <div class="col-md-4">
                <button class="btn btn-success btn-block"  name="BUTTON_ADD" value="" id="addWork" type="submit">
                    <span class="glyphicon glyphicon-plus-sign"></span>
                    Ajouter un stage
                </button>
            </div>
            <div class="col-md-4 col-md-offset-4">
                <button class="btn btn-danger btn-block"   name="BUTTON_DEL" value="" id="delWork" type="submit">
                    <span class="glyphicon glyphicon-minus-sign"></span>
                    Supprimer ce stage
                </button>
            </div>
         
           <div class="col-md-12">
                <p>
                    <button class="btn btn-lg btn-primary btn-block" type="submit"> <span class="glyphicon glyphicon-check"></span> Terminer l'enregistrement des stages</button>
                </p>
           </div>
          
           
        </div> 
    </form>

</div>
