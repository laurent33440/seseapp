
<div class="container">
    <?php foreach (val_functionList as $functionName => $activitiesList){
        echo"
    <div class=\"panel panel-default\">
        <div class=\"panel-heading\">
            <h3 class=\"panel-title\"><h3>$functionName</h3></h3>
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
                                 foreach (form_val_skillsList as $skillName => $levels) {
                                    echo"
                                        <tr>
                                            <td> 
                                                 <span class=\"glyphicon glyphicon-question-sign\" aria-hidden=\"true\"></span>
                                                $skillName";
                                                foreach ($levels as $levelCode => $levelName) {
                                                    echo"

                                                     <select name =\"$skillName\">
                                                        <option value=\"$levelCode\">$levelName</option>
                                                     </select>  ";
                                                
                                                }
                                                echo"
                                                Autonomie";
                                                foreach($form_val_autonomyList as $autonomyCode => $autonomyName){
                                                    echo"    
                                                    <select name=\"$skillName#autonomy\">
                                                        <option value=\"$autonomyCode\">$autonomyName</option>
                                                    </select> ";
                                                }
                                                echo"
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
    </div>";
    } 
    ?>
</div>