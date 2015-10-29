    
    <div class="jumbotron">
        <div class="container">
          <h3> Liste des documents consultables </h3>
          <p>
          <ul>
              <?php
              foreach(form_val_documentList as $title => $doc){
                  echo"
                      <li><a href = \"#$title\">$title</a>
                  ";
              }
              ?>
          </ul>
          </p>
        </div>
    </div>
    <div class="container">
      <div class="row">
            <div class="col-md-12">
                <?php 
                foreach(form_val_documentList as $title => $doc){
                    echo"
                        <div class=\"panel panel-default\">
                          <div class=\"panel-heading\" id=\"$title\">
                            <h3 class=\"panel-title\">$title </h3>
                          </div>
                          <div class=\"panel-body\">
                            $doc
                          </div>
                        </div>
                    ";
                }
                ?>
                
            </div>
      </div>
<!--    <div class="row">
         <div class="col-md-12">
            <a href="{{! INDEX !}}">
                <button class="btn btn-lg btn-primary btn-block" type="submit" name ="LicenseViewed"> 
                    <span class="glyphicon glyphicon-check"></span> Revenir à l'accueil...
                </button>
            </a>
        </div>
    </div>-->
    </div> <!-- /container -->