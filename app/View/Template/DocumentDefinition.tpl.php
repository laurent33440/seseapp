
                <div class="container-fluid">
                    <div class="jumbotron">
                      <h2>Editer et créer les documents de références</h2>
                      <p></p>
                    </div>
                    <form class="form" role="form" method="post" action="{{!INDEX!}}">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Choisissez un documents existants ou créez un nouveau document</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-inline">
                                    <div class="form-group">
                                        <label >Documents disponibles</label>
                                        <select  class="form-control" name="_docName" >
                                            <?php
                                            foreach (form_val_docList as $doc) {
                                                echo"
                                                <option value=\"$doc\">$doc</option>
                                                ";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label >Créer un nouveau document</label>
                                        <input type="text" class="form-control" name="_newDocName">
                                    </div>
                                    <div class="form-group">
                                        <label >type de document</label>
                                        <?php
                                        foreach(form_val_documentTypeList as $type){
                                            echo"
                                                <div class=\"radio-inline\">
                                                    <label>
                                                        <input type=\"radio\" name=\"_docType\" value=\"$type\"> $type
                                                    </label>
                                                </div>
                                            ";
                                        }
                                    ?>
                                    </div>
                                    <div class="form-group">
                                        <label >Lecteurs autorisés</label>
                                        <?php
                                        foreach(form_val_readerList as $reader){
                                            echo"
                                                <div class=\"checkbox-inline\">
                                                    <label>
                                                        <input type=\"checkbox\" name=\"_access##$reader#$reader\" value=\"$reader\"> $reader
                                                    </label>
                                                </div>
                                            ";
                                        }
                                    ?>
                                    </div>
                                </div>      
                            </div>
                        </div>
                        <div class="row">
                            <div class="panel panel-default">
                                <div id="nom_document_en_edition" class="panel-heading">
                                    Document en cours d'edition
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-12">
                                        <textarea rows="35" cols="80" id="textarea1" name="_documentContent" style="width:100% ">
                                            Ecrivez votre texte...
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-10 ">
                                <input id="valide_document" name="submit" type="submit" value="Valider le document " class="btn btn-primary">
                            </div>
                        </div>
                    </form>
            
                </div>
            