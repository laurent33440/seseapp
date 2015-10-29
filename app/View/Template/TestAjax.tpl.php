    
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
                                        <td>
                                            <p>Selection test</p>
                                            <select id="selection_test" name="select_test">
                                              <option value="lundi">Lundi</option>
                                              <option value="mardi">Mardi</option>
                                              <option value="mercredi">Mercredi</option>
                                              <option value="jeudi">Jeudi</option>
                                            </select> 
                                        </td>
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
                                        <td>
                                            <div class="input-group">
                                              <p>Un champ date</p>
                                              <input type="date" class="form-control"
                                              id="input_date"
                                              name="test_date"
                                              placeholder="Entrez une date sous la forme jj/mm/aaaa (exemple : 28/10/2014) "
                                              >
                                            </div><!-- /input-group -->
                                        </td>
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
                                        <td> 
                                            <p>Selection qui met à jour la partie doc de TINYMCE</p>
                                            <select id="marque_voiture" name="select_car">
                                              <option value="volvo">Volvo</option>
                                              <option value="saab">Saab</option>
                                              <option value="mercedes">Mercedes</option>
                                              <option value="audi">Audi</option>
                                            </select> 
                                        </td>
                                        <td><input type="text" class="form-control" id="foncDesc" placeholder="Entrez le descriptif de la fonction">
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
                            <button class="btn btn-primary btn-block btn btn-danger"  type="submit"> 
                                <span class="glyphicon glyphicon-check"></span> 
                                Supprimer la fonction 
                            </button>
                        </div>
                        
                        
                        
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading" id="nom_document_en_edition">
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
                 <button class="btn btn-lg btn-primary btn-block"  id ="enregistrer_texte" type="submit"> <span class="glyphicon glyphicon-check"></span> Enregistrer le texte</button>
            </div> 
        </form>
    </div> <!-- /container -->