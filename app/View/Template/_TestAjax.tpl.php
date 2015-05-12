    
    <div class="container">
        <form  method="post" action="{{!INDEX!}}" class="form-horizontal" >
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Informations relatives au fonctions liées au référentiel
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="active">N° fonction</th>
                                        <th class="active">Descriptif</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> 2 </td>
                                        <td>
                                            <div class="input-group">
                                                <div id="inputText">
                                                    <input type="text" class="form-control" value="" id="foncDesc2" placeholder="Entrez le descriptif de la fonction">
                                                </div>
                                              <span class="input-group-btn">
                                                <button class="btn btn-success" type="button">Ajouter</button>
                                                <button class="btn btn-danger" type="button">Supprimer</button>
                                              </span>
                                            </div><!-- /input-group -->
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td> 3 </td>
                                        <td>
                                            <div class="input-group">
                                              <input type="text" class="form-control" value="" id="foncDesc3" placeholder="Entrez le descriptif de la fonction">
                                              <span class="input-group-btn">
                                                <button class="btn btn-success" type="button">Ajouter</button>
                                                <button class="btn btn-danger" type="button">Supprimer</button>
                                              </span>
                                            </div><!-- /input-group -->
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td> 4 </td>
                                        <td>
                                            <div class="input-group">
                                              <input type="text" class="form-control" value="" id="foncDesc4" placeholder="Entrez le descriptif de la fonction">
                                              <span class="input-group-btn">
                                                <button class="btn btn-success" type="button">Ajouter</button>
                                                <button class="btn btn-danger" type="button">Supprimer</button>
                                              </span>
                                            </div><!-- /input-group -->
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td> <input type="number" class="form-control" id="foncId" placeholder="Entrez le n° de la fonction">
                                        </td>
                                        <td><input type="text" class="form-control" id="foncDesc" placeholder="Entrez le descriptif de la fonction">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="col-md-4">
                            <button class="btn btn-primary btn-block  btn-success" type="submit"> 
                                <span class="glyphicon glyphicon-check"></span> 
                                Ajouter la fonction 
                            </button>
                        </div>
                        <div class="col-md-4 col-md-offset-4">
                            <button class="btn btn-primary btn-block btn btn-danger" type="submit"> 
                                <span class="glyphicon glyphicon-check"></span> 
                                Supprimer la fonction 
                            </button>
                        </div>
                        
                        
                        
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Tests avec Tiny MCE - les scripts sont placés dans le 'head' de la page  
                        <a href="http://www.tinymce.com/wiki.php/Installation" target="_blank">voir sur le site officiel</a>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <textarea id="textarea1" name="tiny_mce_content" style="width:100%">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut 
                                labore et dolore magna aliqua. Ut enim ad minim veniam, quis 
                                laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in 
                                voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat 
                                cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
            
            


            <div class="row">
                 <button class="btn btn-lg btn-primary btn-block" type="submit"> <span class="glyphicon glyphicon-check"></span> Valider les informations</button>
            </div> 
        </form>
    </div> <!-- /container -->