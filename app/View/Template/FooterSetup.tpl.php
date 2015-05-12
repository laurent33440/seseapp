
<footer>
    <div class="section-colored">
          <div class="container">
           <!-- Example row of columns -->
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
                        <h5 class="text-right">&copy; AVALONE 2014<h5>
                    </a>
                  <p> </p>
                </div>
              </div>
           </div>
    </div>
    
  </footer>

<!-- modals
===================================================== -->
 <div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true"> 
      <div class="modal-dialog"> 
        <div class="modal-content"> 
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
            <h4 class="modal-title" id="myModalLabel">Basic Modal</h4> 
          </div> 
          <div class="modal-body"> 
            <h3>Modal Body</h3> 
          </div> 
          <div class="modal-footer"> 
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
            <button type="button" class="btn btn-primary">Save changes</button> 
          </div> 
        </div> 
      </div> 
    </div> 

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="bootstrap_dev/dist/js/bootstrap.min.js"></script>
    
    <!-- trigg modal -->
    <script> $('#basicModal').modal('show'); </script>
    
    <script type="text/javascript">
           $( "input:text", document.form[0] ).blur(function(){               
               $.post(
                   'INDEX',
                    {    AJAX_UPDATE:'ok'
                    },
                    function(data){
                        alert(data.value);
                        console.log(data.value);
                        
                    },
                    'json'
               );
           });          
    </script>
    
  </body>
</html>