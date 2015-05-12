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
            <label for="name" class="col-sm-2 control-label">Nom</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="_senderName" placeholder="Nom et prénom" value="">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Mél</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="_emailTo" placeholder="example@domain.com" value="">
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