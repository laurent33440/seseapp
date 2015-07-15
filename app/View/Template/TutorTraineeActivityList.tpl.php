
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"> Liste des activités souhaitées pour les stagiaires  </h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive" id="visit_table">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="active">Activités souhaitées pour les stagiaires</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (form_val_activityList as $idActivity => $activity) {
                                    echo"
                                        <tr>
                                            <td> 
                                                $activity
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