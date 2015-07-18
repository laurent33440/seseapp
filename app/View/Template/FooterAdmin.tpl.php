            </div><!-- Center page -->
        </div><!-- Row menu left -->
    </div> <!-- Main container -->

<footer>
    <div class="section-colored">
          <div class="container">
              <div class="row">
                <div class="col-md-4">
                    <a href="{{! URI_COMPANY !}}" target='_blank'>
                        <h5>Création AVALONE</h5>
                    </a>
                  <p> </p>
                </div>
                  <div class="col-md-4">
                  <p> </p>
                </div>
                  <div class="col-md-4">
                    <a href="{{! URI_COMPANY !}}" target='_blank'>
                        <h5 class="text-right">&copy; AVALONE 2015</h5>
                    </a>
                  <p> </p>
                </div>
              </div>
           </div>
    </div>
    
  </footer>

<!-- modals ===================================================== -->
 <div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true"> 
      <div class="modal-dialog"> 
        <div class="modal-content"> 
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
            <h4 class="modal-title" id="myModalLabel">MODAL_TITLE</h4> 
          </div> 
          <div class="modal-body"> 
            <h3>MODAL_MESSAGE</h3> 
          </div> 
          <div class="modal-footer"> 
            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button> 
            <!--<button type="button" class="btn btn-primary">Save changes</button> -->
          </div> 
        </div> 
      </div> 
    </div> 


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!--<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!--<script src="bootstrap_dev/dist/js/bootstrap.min.js"></script>-->
    <script src="{{!/bootstrap-3.2.0-dist/js/bootstrap.min.js!}}"></script>
    
     <!-- trigg modal -->
        {{? ( SHOW_MODAL ) {%!
            <script> $(\'#basicModal\').modal({\'show\' : true, \'backdrop\' : false}); </script>
        !}}
        
        
 <!-- Script for text inputs changes -->   
    <script type="text/javascript">
        $(':text').blur(function(){
               console.log($(this).attr('id'));
               id=$(this).attr('id');
               val=$(this).val();

               $.post(
                   'INDEX',
                    {       AJAX_UPDATE:'blur',
                            AJAX_ID:id,
                            AJAX_VAL:val
                    },
                    function(data){
                        alert('from server : '+' id : '+data.id+' '+'val : '+data.value);
//                        console.log(data.value);
                    },
                    'json'
               );
       });       
              
    </script>
    
    <!-- Script for select input(s) changes -->
    <script type="text/javascript">
        $("select").change(function(){
               console.log($(this).attr('id'));
               id=$(this).attr('id');
               val=$(this).val();
               $.ajax({
                   url:'INDEX',
                   data:{       AJAX_UPDATE:'document_change',
                           AJAX_ID:id,
                           AJAX_VAL:val
                   },
                   type:"POST",
                   dataType : "json",
                   async:"false", //synchrone
                   success: function(json){
                       console.log('recu du serveur : '+json.doc);
                       var ed = tinyMCE.activeEditor;
                       ed.setContent(json.doc);
                       setTitle(json.title);
                   }
               });
       });       
       
              
    </script>
    
    <!-- script qui renvoie une doc a TINYMCE : l'élément DOC est substituée dans le modelView (modelView['footer']['DOC']) par le generateur de template -->
    <script type="text/javascript">
        function getDoc(){
            $("#nom_document_en_edition").text('TITLE');
            return 'DOC';
        };
    </script>
    
    <!-- m a j titre doc en edition -->
    <script type="text/javascript">
        function setTitle(title){
            $("#nom_document_en_edition").text(title);
        };
    </script>
    
    <!-- agit sur bouton de validation de création/edition documents -->
    <script type="text/javascript">
        function highLightElement(){
            $("#valide_document").css("background-color", "green");
        };
    </script>
    
    
  </body>
</html>
