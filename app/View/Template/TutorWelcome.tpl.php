
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Informations générales - visites programmées -  DATE </h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive" id="visit_table">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="active">Date de visite</th>
                                    <th class="active">Stagiaire en responsabilité</th>
                                    <th class="active">Enseignant visiteur</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (form_val_visitsInfos as $date => $infos) {
                                    echo"
                                        <tr>
                                            <td> 
                                                $date
                                            </td>";
                                    foreach ($infos as $trainee=>$teacher){
                                        echo"
                                    
                                            <td>
                                                $trainee
                                            </td>
                                            <td>
                                                $teacher
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