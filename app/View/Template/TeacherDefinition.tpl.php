


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
                        foreach (form_val_teachersList as $idTeacher => $teacher) {
                            if(form_val_teacherId === $idTeacher){//select current teacher
                                $select= 'selected="selected"';
                            }else{
                                $select= '';
                            }
                            
                            echo"
                                <option 
                                    $select
                                    value=\"$idTeacher\">$teacher 
                                </option>
                            ";
                        }
                    echo "
                    </select>";
                    ?>
                    
                    <div class="form-group"> <!-- spacer -->
                    </div>
                    
                    <div class="col-md-4">
                        <button class="btn btn-success btn-block" name="{{!BUTTON_CREATE_TEACHER!}}" id="addFunction" type="submit">
                            <span class="glyphicon glyphicon-plus-sign"></span>
                            Ajouter un enseignant
                        </button>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-warning btn-block" name="{{!BUTTON_EDIT_TEACHER!}}" id="addFunction" type="submit">
                            <span class="glyphicon glyphicon-pencil"></span>
                            Modifier l'enseignant
                        </button>
                    </div>
                    <div class="col-md-4 ">
                        <button class="btn btn-danger btn-block" name="{{!BUTTON_DEL_TEACHER!}}" id="delFunction" type="submit">
                            <span class="glyphicon glyphicon-minus-sign"></span>
                            Supprimer cet enseignant
                        </button>
                    </div>
                    
                    <div class="form-group"> <!-- spacer -->
                    </div>
                    
                    <div class="col-md-12">
                        <button class="btn btn-info btn-block" name="{{!BUTTON_IMPORT_TEACHER!}}" id="addFunction" type="submit">
                            <span class="glyphicon glyphicon-cloud-download"></span>
                            !!!!FUTUR INACTIF!!!Importer des enseignants à partir d'une source externe
                        </button>
                    </div>
                    
                </div>
            </div>
            
            <!-- optionnal form panel creating/updating teacher.  -->
            <?php 
            if(form_val_editFormVisible==true){
                echo"
                <div class=\"panel panel-default\">
                    <div class=\"panel-heading\">
                        Formulaire de création/édition des enseignants 
                    </div>
                    <div class=\"panel-body\">
                        <div class=\"panel panel-default\">
                            <div class=\"panel-heading\">
                                Promotion associé à cet enseignant
                            </div>
                            <div class=\"panel-body\">

                                <select class=\"form-control\" name=\"form_promotionsList\" id=\"promotionChoosenForUpdate\">";
                                    foreach (form_val_promotionsList as $idPromotion => $promotion) {
                                        echo"
                                            <option value=\"$idPromotion\">$promotion </option>
                                        ";
                                    }
                                echo "
                                </select>

                            </div>
                        </div>

                        <div class=\"form-group\">
                            <label for=\"inputAdminName\" class=\"control-label col-xs-2\">Nom de l'enseignant</label>
                            <div class=\"col-xs-10\">
                                <input type=\"text\" required class=\"form-control\" id=\"inputAdminName\" 
                                       name=\"form_teacherLastName\" 
                                       placeholder=\"Nom de l'enseignant\"
                                       value=\"form_val_teacherLastName\">
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <label for=\"inputAdminPass\" class=\"control-label col-xs-2\">Prénom de l'enseignant</label>
                            <div class=\"col-xs-10\">
                                <input type=\"text\" required class=\"form-control\" id=\"inputAdminPass\" 
                                       name=\"form_teacherFirstName\"
                                       placeholder=\"Prénom de l'enseignant\"
                                       value=\"form_val_teacherFirstName\">
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <label for=\"inputAdminPass2\" class=\"control-label col-xs-2\">Mél de l'enseignant </label>
                            <div class=\"col-xs-10\">
                                <input type=\"mail\" required class=\"form-control\" id=\"inputAdminPass2\" 
                                       name=\"form_teacherMail\" 
                                       placeholder=\"\"
                                       value=\"form_val_teacherMail\">
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <label for=\"inputAdminPass2\" class=\"control-label col-xs-2\">Discipline de l'enseignant </label>
                            <div class=\"col-xs-10\">
                                <input type=\"text\" required class=\"form-control\" id=\"inputAdminPass2\" 
                                       name=\"form_teacherSkill\" 
                                       placeholder=\"Discipline de l'enseignant\"
                                       value=\"form_val_teacherSkill\">
                            </div>
                        </div>


                        <div class=\"col-md-12\">
                            <button class=\"btn btn-success btn-block\" name=\"BUTTON_ADD_TEACHER\" id=\"addFunction\" type=\"submit\">
                                <span class=\"glyphicon glyphicon-plus-sign\"></span>
                                Valider cet enseignant
                            </button>
                        </div>

                    </div>
                </div>
                ";
            }
            ?>
            <!-- end optional form -->
            
            <!-- optionnal form panel importing teacher.  -->
            <?php 
            if(form_val_importFormVisible==true){
                echo"
                <div class=\"panel panel-default\">
                    <div class=\"panel-heading\">
                        Formulaire d'importation des enseignants 
                    </div>
                    <div class=\"panel-body\">
                        <div class=\"panel panel-default\">
                            <div class=\"panel-heading\">
                                Formats disponibles associés à l'import
                            </div>
                            <div class=\"panel-body\">

                                <select class=\"form-control\" name=\"form_formatImportList\" id=\"formatImportList\">";
                                    foreach (form_val_formatImportList as  $format) {
                                        echo"
                                            <option value=\"$format\">$format </option>
                                        ";
                                    }
                                echo "
                                </select>

                            </div>
                        </div>

                        <div class=\"col-md-12\">
                            <button class=\"btn btn-success btn-block\" name=\"BUTTON_CHOOSE_IMPORT_TEACHER\" id=\"addFunction\" type=\"submit\">
                                <span class=\"glyphicon glyphicon-plus-sign\"></span>
                                Choisir le fichier à importer
                            </button>
                        </div>

                    </div>
                </div>
                ";
            }
            ?>
            <!-- end optional form -->
            
        </div>

        <div class="row">
             <button class="btn btn-lg btn-primary btn-block" type="submit"> <span class="glyphicon glyphicon-check"></span> Terminer l'enregistrement des enseignants</button>
        </div> 
    </form>

</div>
