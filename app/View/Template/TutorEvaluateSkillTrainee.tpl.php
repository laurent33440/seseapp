<form class="form-horizontal" role="form" method="post" action="{{!INDEX!}}">
    
    <div class="jumbotron">
            <div class="container">
                <h2> Evaluer un stagiaire</h2>
                <div class="row">
                    <div class="col-md-4">
                        <p>
                        <h3> Choisir un stagiaire à évaluer</h3>
                        </p>
                    </div>
                    <div class="col-md-8 ">
                        
                          <select class="form-control" name="_traineeName"  >
                        <?php
                          foreach (form_val_traineeList as  $name) {
                              echo"<option value=\"$name\">$name</option>";
                          }
                        ?>
                          </select>
                        
                    </div>
                </div>
            </div>
    </div>
    
    <div class="container">
         <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class=\"panel-title\">Evaluation des attitudes professionnelles</h3>
                </div>
                <div class="panel-body">
                     <div class="table-responsive" id="visit_table">
                            <table class=\"table table-hover table-striped table-bordered\">
                                <thead>
                                    <tr>
                                        <th class=\"active\"> <h4></h4></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach (form_val_professionnalSkillList as $skillName => $levels) {
                                        echo"
                                            <tr>
                                                <td> 
                                                     <span class=\"glyphicon glyphicon-question-sign\" aria-hidden=\"true\"></span>
                                                    $skillName"
                                                    ."<select name =\"_results##$skillName#$skillName#$skillName\">";
                                                    foreach ($levels as $levelCode => $levelName) {
                                                        echo"<option value=\"$levelCode\">$levelName</option>";
                                                    }
                                                    echo"
                                                    </select> 
                                                </td>";
                                        echo"                
                                            </tr>
                                        ";
                                        }
                                        ?>
                                </tbody>
                            </table>
                     </div>
                </div>
         </div>

        <?php foreach (form_val_functionList as $functionName => $activitiesList){
            echo"
        <div class=\"panel panel-default\">
            <div class=\"panel-heading\">
                <h2 class=\"panel-title\">$functionName</h2>
            </div>
            <div class=\"panel-body\">
                ";
            foreach ($activitiesList as $activityName => $skillsList) {
                echo"

                <div class=\"table-responsive\" id=\"visit_table\">
                            <table class=\"table table-hover table-striped table-bordered\">
                                <thead>
                                    <tr>
                                        <th class=\"active\"> <h4>$activityName</h4></th>
                                    </tr>
                                </thead>
                                <tbody>
                                ";
                                     foreach ($skillsList as $skillName => $levels) {
                                        echo"
                                            <tr>
                                                <td> 
                                                     <span class=\"glyphicon glyphicon-question-sign\" aria-hidden=\"true\"></span>
                                                    $skillName"
                                                    ."<select name =\"_results##$activityName#$activityName#$skillName\">";
                                                    foreach ($levels as $levelCode => $levelName) {
                                                        echo"<option value=\"$levelCode\">$levelName</option>";
                                                    }
                                                    echo"
                                                    </select> 
                                                    Autonomie
                                                    <select name=\"_autonomyResults##$activityName#$skillName\">";
                                                    foreach(form_val_autonomyList as $autonomyCode => $autonomyName){
                                                        echo"<option value=\"$autonomyCode\">$autonomyName</option>";
                                                    }
                                                    echo"
                                                    </select> 
                                                </td>";
                                        echo"                
                                            </tr>
                                        ";
                                        }
                                echo"
                                </tbody> 
                </table>";
            } 
            echo"   
                </div>
            </div>
        </div>";
        } 
        ?>

        <div class="form-group">
            <div class="col-lg-10 ">
                <input id="submit" name="submit" type="submit" value="Valider l'évaluation " class="btn btn-primary">
            </div>
        </div>


    </div>
</form>