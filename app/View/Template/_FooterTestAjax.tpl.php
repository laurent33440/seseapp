<footer>
    <div class="section-colored">
          <div class="container">
           <!-- Example row of columns -->
              <div class="row">
                <div class="col-md-4">
                    <a href="{{! URI_COMPANY !}}" target='_blank' id="link_id">
                        <h5>Test AJAX -- survole moi</h5>
                    </a>
                  <p> </p>
                </div>
                  <div class="col-md-4">
                      <form>
                        <input id="target" type="text" value="Field 1">
                        <input type="text" value="Field 2">
                    </form>
                  <p> </p>
                </div >
                  <div  class="col-md-4" >
                    <a  id="link_id2" href="#" target='_blank'>
                        <h5  class="text-right">&copy; Test AJAX 2014 -- survole moi<h5>
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
    <!--<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>-->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
    <!--<script src="bootstrap_dev/dist/js/bootstrap.min.js"></script>-->
    <script src="app_js/jquery/1.11.1/jquery.min.js"></script>
    <script src="bootstrap-3.2.0-dist/js/bootstrap.min.js"></script>
    
    <!-- trigg modal test -->
    <!--<script> $('#basicModal').modal('show'); </script>-->
    
    
    <!-- AJAX TESTS -->
    <script type="text/javascript">
           $( "#link_id" ).mouseover(function(){
               $.post(
                   'INDEX',
                    {    ajax:'ok'
                    },
                    function(data){
                        alert(data.value);
                        console.log(data.value);
                        
                    },
                    'json'
               );
           });
           $( "#link_id2" ).mouseover(function(){
               $.post(
                   'INDEX',
                    {    ajax:'ok'
                    },
                    function(data){
                        alert(data.value);
                        console.log(data.value);
                        
                    },
                    'json'
               );
           });        
    </script>
    
    <script type="text/javascript">
           $(":text").blur(function(){
               console.log($(this).attr('id'));
               id=$(this).attr('id');
               val=$(this).val();
               alert('Input id :'+id+' '+'Input val :'+val);
//               $.post(
//                   'INDEX',
//                    {    ajax:'ok'
//                    },
//                    function(data){
//                        alert(data.value);
//                        console.log(data.value);
//                        
//                    },
//                    'json'
//               );
           });
//            $(document).ready(function(){
//        alert('page chargée');
////        $("#func_table").blur(function{
////               alert('blur');
////               $.post(
////                   'INDEX',
////                    {    AJAX_UPDATE:'ok'
////                    },
////                    function(data){
////                        alert(data.value);
////                        console.log(data.value);
////                        
////                    },
////                    'json'
////               );
////           });       
//    });
    </script>
    
    <script type="text/javascript">
           $("#textarea1").mouseover(function(){
               console.log($(this).attr('id'));
               id=$(this).attr('id');
               val=$(this).val();
               alert('Input id :'+id+' '+'Input val :'+val);
//               $.post(
//                   'INDEX',
//                    {    ajax:'ok'
//                    },
//                    function(data){
//                        alert(data.value);
//                        console.log(data.value);
//                        
//                    },
//                    'json'
//               );
           });

    </script>
<!--    <script type="text/javascript">
           $( "#link_id" ).mouseover(function(){
               
               $.ajax({
                   url : '/sese/index.php',
                   type : 'POST',
                   data : 'ajax=ok'
               });
           });          
    </script>-->
    
<!--    <script type="text/javascript">
        $(document).ready(function(){
            alert('Page chargée');
        });
       
   </script>-->
    
  </body>
</html>