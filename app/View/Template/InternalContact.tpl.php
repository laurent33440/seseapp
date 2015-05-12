 <div class="jumbotron">
        <div class="container">
          <h3> Contacter un utilisateur de SESE</h3>
          <p>
          
          </p>
        </div>
    </div>
<div class="container">
    <form class="form-horizontal" role="form" method="post" action="{{!INDEX!}}">
        
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Contact</label>
            <div class="col-sm-10">
                <?php
                echo"
                <select class=\"form-control\" name=\"_emailChoosen\" id=\"emailList\">
                    ";
                    foreach (form_val_emailToList as $email) {
                        echo"
                        <option
                            value=\"$email\">$email
                        </option>
                        ";
                    }
                    echo "
                </select>
                ";
                ?>
            </div>
        </div>
        <div class="form-group">
            <label for="message" class="col-sm-2 control-label">Message</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="4" name="_message"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <input id="submit" name="submit" type="submit" value="Envoyer" class="btn btn-primary">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <! Will be used to display an alert to the user>
            </div>
        </div>
    </form>
    
</div>