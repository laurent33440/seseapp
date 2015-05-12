<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo'/bootstrap_dev/docs-assets/ico/favicon.png'; ?>"> 

    <title>SESE</title>

    <!-- Bootstrap core CSS -->
    <!--<link href="bootstrap_dev/dist/css/bootstrap.css" rel="stylesheet">-->
    
    <link href="<?php echo'/bootstrap-3.2.0-dist/css/bootstrap.css'; ?>" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo'/app_css/welcome.css'; ?>" rel="stylesheet">
    <link href="<?php echo'/app_css/admin.css'; ?>" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
    <!-- css jQuery -->
    <link href="http://code.jquery.com/ui/1.11.4/themes/redmond/jquery-ui.css" rel="stylesheet">
    
    
  </head>
<body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <img alt="SESE" src="/app_img/logo_sese40.png">SESE
                    </a>
                    <a class="navbar-brand" href="#">
                        <img alt="Lycee Philadelphe de Gerde" src="/app_img/logo_lppdg40.png">Lycee Philadelphe de Gerde
                    </a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <!-- Single button --> 
                    <div class="btn-group nav navbar-nav navbar-right">
                      <button type="button" class="btn btn-primary dropdown-toggle navbar-btn" data-toggle="dropdown" aria-expanded="false">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        unknown user : unknown user role<span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" role="menu" >
                        <li><a href="/"> <span class="glyphicon glyphicon-off" aria-hidden="true"></span> Deconnexion</a></li>
                        <li><a href="#"> <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Contacter l'administrateur référant</a></li>
                      </ul>
                    </div>
                </div>
            </div>
        </nav>    
    <div class="jumbotron">
        <div class="container">
          <h3> Informations générales concernant l'application SESE </h3>
          <p>
          <ul>
              <li><a href = "#">Objet de l'application</a>
              <li><a href = "#">Droits sur l'information</a>
              <li><a href = "#">Licence d'utilisation</a>
          </ul>
          </p>
        </div>
    </div>
    <div class="container">
      <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">L'application SESE (Suivi et Evaluations des Stafgiaires en Entreprise </h3>
                  </div>
                  <div class="panel-body">
                      <h4>Intérêts et objectif de l'application SESE</h4>
                      Elle permet la validation partielle du cursus de l'étudiant en lycée professionnel et centres de formations.
                        Elle inclus :
                        <ul>
                            <li>Les documentations de références
                            <li>Les évaluations des tuteurs de stages
                            <li>Les journaux des activités de l'élève
                            <li>La synthèse des évaluations
                        </ul>
                        Cette application peut-être utilisée tout au long du cursus de l'étudiant.<br>
                        Elle est destinée aux centres de formations (lycées, CFA, AFPA, chambres de commerces et de l'industrie, etc.)
                  </div>
                </div>
                
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">L'application SESE et le droit</h3>
                  </div>
                  <div class="panel-body">
                      <h4>Droits sur l'information</h4>
                      Arrêté du 30 novembre 2006 portant création, au sein du ministère de l’éducation nationale, de l’enseignement supérieur et de la recherche, 
                      d’un traitement de données à caractère personnel relatif aux espaces numériques de travail (ENT).:<br>
                      Le ministre de l’éducation nationale, de l’enseignement supérieur et de la recherche,
                        Vu la convention n° 108 du 28 janvier 1981 du Conseil de l’Europe pour la protection des

                        personnes à l’égard du traitement automatisé des données à caractère personnel ;
                        Vu le code de l’éducation ;
                        Vu la loi n° 78­17 du 6 janvier 1978 relative à l’informatique, aux fichiers et aux libertés,
                        modifiée notamment par la loi n° 2004­801 du 6 août 2004 relative à la protection des
                        personnes physiques à l’égard des traitements de données à caractère personnel,
                        notamment son article 27 (II, 4°) ;
                        Vu la loi n° 2004­575 du 21 juin 2004 pour la confiance dans l’économie numérique ;
                        Vu le décret n° 2005­1309 du 20 octobre 2005 pris pour l’application de la loi n° 78­17 du
                        6 janvier 1978 relative à l’informatique, aux fichiers et aux libertés, modifiée par la loi n°
                        2004­801 du 6 août 2004 ;
                        Vu la délibération n° 2006­104 de la Commission nationale de l’informatique et des
                        libertés en date du 27 avril 2006 relative à la demande d’avis n° 1064992, portant sur le
                        projet d’arrêté relatif à la création par le ministère de l’éducation nationale, de
                        l’enseignement supérieur et de la recherche des espaces numériques de travail (ENT),

                        Article 1

                        Des traitements de données à caractère personnel relatifs aux “ espaces numériques de

                        travail “ (ENT), qui sont des sites “ web portail “ permettant d’accéder, via un point

                        d’entrée unique et sécurisé, à un bouquet de services numériques, peuvent être mis en

                        oeuvre dans les écoles, les établissements publics locaux d’enseignement (EPLE) et les

                        établissements d’enseignement supérieur visés par les dispositions des articles L. 711­1

                        à L. 722­16 du code de l’éducation.

                        Les ENT ont pour objet :

                        ­ de saisir et de mettre à la disposition des élèves et de leurs parents, des étudiants, des

                        enseignants, des personnels administratifs et plus généralement de tous les membres de

                        la communauté éducative de l’enseignement scolaire ou de l’enseignement supérieur, en

                        fonction des habilitations de chaque usager, des contenus éducatifs et pédagogiques,

                        des informations administratives, relatives à la vie scolaire, aux enseignements et au

                        fonctionnement de l’établissement ainsi que de la documentation en ligne ;

                        ­ de permettre aux usagers de l’ENT de s’inscrire en ligne à des activités proposées par

                        l’établissement, de s’inscrire à des listes de diffusion, de participer à des espaces

                        communautaires (forums de discussion, espaces collaboratifs, blogs...).

                        Article 2

                        Indépendamment des données créées lors de l’ouverture d’un compte ENT (identifiant et

                        mot de passe), les catégories de données à caractère personnel traitées par l’application

                        ENT sont les suivantes :

                        a) Dans l’enseignement primaire et secondaire, ainsi que dans l’enseignement supérieur :

                        En ce qui concerne les élèves et les étudiants :

                        ­ civilité, identité, date et lieu de naissance, ville et pays de naissance, photographie et

                        coordonnées personnelles (adresse postale, téléphones fixe et portable, télécopie,

                        adresse électronique, tout élément concernant sa vie scolaire ou universitaire) ;

                        En ce qui concerne les parents d’élèves :

                        ­ civilité, identité, adresse postale, téléphones fixe et portable, télécopie, adresse

                        électronique ;

                        En ce qui concerne les personnels enseignants et non enseignants :

                        ­ identité, situation professionnelle, structure de rattachement, coordonnées

                        professionnelles, informations administratives les concernant, toute information

                        concernant la scolarité des élèves ou des étudiants dont ils ont la charge ;

                        b) Dans le cadre du tutorat et de l’apprentissage, ainsi que pour les entreprises

                        partenaires :

                        En ce qui concerne l’apprenti :

                        ­ civilité, identité, date et lieu de naissance, ville et pays de naissance, photographie et

                        coordonnées personnelles (adresse, téléphones fixe et portable, télécopie, adresse

                        électronique) ;

                        En ce qui concerne les tuteurs de stage et maîtres d’apprentissage :

                        ­ identité et situation professionnelle du tuteur de stage ou du maître d’apprentissage ;

                        ­ dénomination de l’entreprise partenaire et nom des élèves suivis en stage ou en

                        apprentissage.

                        Article 3

                        Les données à caractère personnel utilisées dans les ENT dont la liste est annexée au “

                        schéma directeur des espaces numériques de travail (SDET) “ sont soit issues de

                        systèmes d’information mis en oeuvre par le ministère de l’éducation nationale, de

                        l’enseignement supérieur et de la recherche ou de systèmes d’information mis en oeuvre

                        par les collectivités territoriales, soit fournies par les usagers des ENT.

                        Un transfert sécurisé des données à caractère personnel dans les ENT est réalisé par

                        chaque responsable d’un ENT, à partir des systèmes d’information concernant les élèves,

                        les apprentis, les étudiants et les différentes catégories de personnel relevant de l’école

                        ou de l’établissement concerné.

                        Article 4

                        Les destinataires des données à caractère personnel sont exclusivement les catégories

                        de personnes susceptibles de disposer, dans la limite de leurs attributions respectives,

                        d’un accès à l’ENT.

                        Chaque catégorie d’utilisateur ne peut accéder qu’aux seules informations concernant

                        ses fonctions au sein de l’établissement :

                        a) Dans l’enseignement primaire et secondaire :

                        ­ les élèves, en ce qui concerne leurs informations personnelles et la vie scolaire ;

                        ­ les délégués d’élèves, en ce qui concerne la vie lycéenne ;

                        ­ les parents d’élèves, en ce qui concerne la vie scolaire de leur(s) enfant(s) ;

                        ­ les délégués de parents d’élèves, en ce qui concerne la vie de l’établissement ;

                        ­ les personnels enseignants, en ce qui concerne les informations relatives à la scolarité

                        de leurs élèves ;

                        ­ les personnels autres que les personnels enseignants, en ce qui concerne leurs

                        fonctions dans l’établissement ;

                        ­ les intervenants extérieurs, en ce qui concerne des activités scolaires ou périscolaires

                        auxquelles ils participent et qui sont organisées en accord avec le responsable de

                        l’établissement ;

                        ­ les services municipaux dans le cadre de la préinscription scolaire et des activités

                        organisées par les communes ;

                        ­ les représentants des collectivités territoriales dans les instances délibératives de l’école

                        ou de l’établissement, en ce qui concerne leur mandat ;

                        b) Dans l’enseignement supérieur :

                        ­ les étudiants, en ce qui concerne leurs informations personnelles ;

                        ­ les enseignants­chercheurs, les chercheurs et les enseignants (locaux ou extérieurs),

                        en ce qui concerne la formation de leurs étudiants et leurs travaux de recherche ;

                        ­ les personnels autres que les personnels enseignants, en ce qui concerne leurs

                        fonctions dans l’établissement ;

                        ­ les représentants des collectivités territoriales dans les instances délibératives de

                        l’établissement, en ce qui concerne leur mandat.

                        Article 5

                        Préalablement à la mise en oeuvre du traitement mentionné à l’article 1er, le responsable

                        de l’ENT informera, dans les conditions définies à l’article 32 de la loi du 6 janvier 1978

                        susvisée, les responsables légaux des élèves mineurs, les élèves majeurs et les

                        étudiants, ainsi que tous les autres utilisateurs, de la collecte et de la destination des

                        données à caractère personnel les concernant.

                        Les droits d’opposition et de rectification des personnes à l’égard des traitements des

                        données à caractère personnel, prévus par les articles 38 à 40 de la loi du 6 janvier 1978

                        susvisée, s’exercent soit par voie postale, soit par voie électronique auprès du

                        responsable de l’ENT pour les écoles et les établissements mentionnés à l’article 1er.

                        Article 6

                        Les données à caractère personnel traitées dans le cadre d’un compte ENT sont mises à

                        jour au début de chaque année scolaire ou universitaire et, en tout état de cause, sont

                        supprimées de l’ENT dans un délai de trois mois dès lors que la personne concernée n’a

                        plus vocation à détenir un compte.

                        Les contributions personnelles laissées dans les espaces communautaires et espaces de

                        stockage d’informations personnelles ou de publication ne pourront, sauf opposition du

                        contributeur lors de la fermeture de son compte ENT, être conservées par l’établissement

                        qu’à des fins informatives, pédagogiques ou scientifiques dans les conditions fixées à

                        l’article 36 de la loi du 6 janvier 1978 susvisée.

                        Article 7

                        La mise en oeuvre du traitement mentionné à l’article 1er par chaque responsable des

                        écoles, des EPLE et des établissements d’enseignement supérieur précités est

                        subordonnée à l’envoi préalable à la Commission nationale de l’informatique et des

                        libertés, en application du III de l’article 27 de la loi du 6 janvier 1978 susvisée, d’un

                        engagement de conformité au présent arrêté.

                        Cette formalité l’engage à respecter les finalités et les modalités du droit d’accès prévues

                        dans le cadre de l’ENT ainsi que le “ schéma directeur des espaces numériques de travail

                        “ et ses annexes élaborés par le ministère de l’éducation nationale, de l’enseignement

                        supérieur et de la recherche.

                        Article 8

                        Le présent arrêté, qui fait l’objet d’un affichage dans les établissements concernés, est

                        consultable par chaque utilisateur à partir de la page d’accueil de l’ENT.

                        Article 9

                        Le secrétaire général est chargé de l’exécution du présent arrêté, qui sera publié au

                        Journal officiel de la République française.

                        Pour le ministre et par délégation :

                        Le secrétaire général,

                        D. Antoine
                      
                      
                  </div>
                </div>
                
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">License GPL version 3</h3>
                  </div>
                  <div class="panel-body">
                      <h4>Les principes de base de la GPL</h4>
                      Personne ne doit être limité par les logiciels qu'il utilise. Il y a quatre libertés que tout utilisateur doit posséder :</br>
                      <ul>
                          <li>la liberté d'utiliser le logiciel à n'importe quelle fin,
                          <li>la liberté de modifier le programme pour répondre à ses besoins,
                          <li>la liberté de redistribuer des copies à ses amis et voisins,
                          <li>la liberté de partager avec d'autres les modifications qu'il a faites.
                      </ul>
                      Quand un programme offre à ses utilisateurs toutes ces libertés, nous le qualifions de logiciel libre.</br>
                      Les développeurs qui écrivent des logiciels peuvent les publier sous les termes de la GNU GPL. Ce faisant, leur logiciel sera libre et le restera, indépendamment de qui modifiera et distribuera ce logiciel. Nous appelons cela copyleft : le logiciel est bien soumis au droit d'auteur, mais plutôt que d'utiliser ces droits pour restreindre l'utilisation que peuvent en faire les utilisateurs (comme c'est le cas dans les logiciels privateurs1), nous les utilisons pour nous assurer que tous les utilisateurs auront ces libertés.</br>
                      L'intégralité de la license d'utilisation est disponible <a href="http://www.gnu.org/licenses/agpl-3.0.html" target="_blank">ici</a>
                  </div>
                </div>
            </div>
      </div>
        <div class="row">
             <div class="col-md-12">
                <a href="<?php echo' / '; ?>">
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name ="LicenseViewed"> 
                        <span class="glyphicon glyphicon-check"></span> Revenir à l'accueil...
                    </button>
                </a>
            </div>
        </div>
    </div> <!-- /container -->
<footer>
    <div class="section-colored">
          <div class="container">
           <!-- Example row of columns -->
              <div class="row">
                <div class="col-md-4">
                    <a href="<?php echo' www.avalone-fr.com '; ?>" target='_blank'>
                        <h5>Création AVALONE</h5>
                    </a>
                  <p> </p>
                </div>
                  <div class="col-md-4">
                  <p> </p>
                </div>
                  <div class="col-md-4">
                    <a href="<?php echo' www.avalone-fr.com '; ?>" target='_blank'>
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
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js"> </script>
    <script src="https://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css"></script>
    <!--<script src="bootstrap_dev/dist/js/bootstrap.min.js"></script>-->
    <script src="<?php echo'/bootstrap-3.2.0-dist/js/bootstrap.min.js'; ?>"></script>
    
     <!-- trigg modal -->
        <?php if ( false ) echo'
            <script> $(\'#basicModal\').modal({\'show\' : true, \'backdrop\' : false}); </script>
        '; ?>
        
    <!-- Script for text inputs changes -->   
    <script type="text/javascript">
        $(':text').blur(function(){
               console.log($(this).attr('id'));
               id=$(this).attr('id');
               val=$(this).val();

               $.post(
                   '/index.php/',
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

               $.post(
                   '/index.php/',
                    {       AJAX_UPDATE:'change',
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
    
    <!------- JQUERY WIDGET -------->
    <script>
      $(function() {
        $( "#datePicker" ).datepicker();
      });
    </script>
    
<!--    <script type="text/javascript">
        $(document).ready(function(){
            alert('Page chargée');
        });
       
   </script>-->
    
  </body>
</html>

