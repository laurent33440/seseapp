
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"> Liste des stagiaires  </h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive" id="visit_table">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="active">Stagiaire en responsabilité</th>
                                    <th class="active">Période de stage </th>
                                    <th class="active">Enseignant référant</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (form_val_traineeList as $trainee => $infos) {
                                    echo"
                                        <tr>
                                            <td> 
                                                $trainee
                                                    <a href=\"#\"><span class=\"glyphicon glyphicon-envelope\" aria-hidden=\"true\"></span></a>
                                            </td>";
                                    foreach ($infos as $period=>$teacher){
                                        echo"
                                    
                                            <td>
                                                $period
                                            </td>
                                            <td>
                                                $teacher
                                                    <a href=\"/contact\"><span class=\"glyphicon glyphicon-envelope\" aria-hidden=\"true\"></span></a>
                                            </td>
                                                    
                                        </tr>
                                    ";
                                    }
                                } ?>
                            </tbody>
                        </table>
                    </div>
        </div>
    </div>
</div>