<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<!--IL modifica_cancella.php DI GIANPIERO ADESSO E' modifica_cancella_originale.php-->

<?php
//PER IL DISPLAY DEGLI ERRORI
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_STRICT);*/
session_start();
include("config.php");
?>

<head>
<meta charset="utf-8">
<title>RestArt</title>
<meta name="robots" content="noindex, nofollow">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
<link rel="shortcut icon" href="img/favicon.ico">
<link rel="apple-touch-icon" href="img/icon57.png" sizes="57x57">
<link rel="apple-touch-icon" href="img/icon72.png" sizes="72x72">
<link rel="apple-touch-icon" href="img/icon76.png" sizes="76x76">
<link rel="apple-touch-icon" href="img/icon114.png" sizes="114x114">
<link rel="apple-touch-icon" href="img/icon120.png" sizes="120x120">
<link rel="apple-touch-icon" href="img/icon144.png" sizes="144x144">
<link rel="apple-touch-icon" href="img/icon152.png" sizes="152x152">
<link rel="stylesheet" href="css/f-bootstrap.min-2.css">
<link rel="stylesheet" href="css/f-plugins-2.css">
<link rel="stylesheet" href="css/f-main-2.css">
<link rel="stylesheet" href="css/f-themes-2.css">
<script src="js/vendor/modernizr-2.7.1-respond-1.4.2.js"></script>
</head>
<body><div id="page-container">
<header>
<div class="container">
<a href="http://www.restartcampania.altervista.org/" class="site-logo">
<i class="gi gi-flash"></i> <strong>Rest</strong>Art
</a>
<nav>
<a href="javascript:void(0)" class="btn btn-default site-menu-toggle visible-xs visible-sm">
<i class="fa fa-bars"></i>
</a>
<ul class="site-nav">
<li class="visible-xs visible-sm">
<a href="javascript:void(0)" class="site-menu-toggle text-center">
<i class="fa fa-times"></i>
</a>
</li>

<?php
include('cp/side.php');
?>

</ul>

</nav>

</div>
</header><section class="site-section site-section-light site-section-top themed-background-autumn">
<div class="container">
<h1 class="text-center animation-slideDown"><strong>Community</strong></h1>
<h2 class="h3 text-center animation-slideUp"><strong>Modifica</strong> un post!</h2>
</div>
</section>
<section class="site-content site-section">

<div class="container">
<div class="site-block clearfix">
<a href="/blog.php" class="btn btn-primary pull-left"><i class="fa fa-th-large"></i> Torna indietro</a>
</div>
<div class="row">
<div class="col-sm-6 site-block"> 

<div class="container">
<div class="site-block text-center">
<div class="btn-group portfolio-filter">
</div>
</div>

<body>

<?php

@include "config.php";

//Qui ci vanno le conseguenze della modifica e della cancellazione

//"Se è stato premuto uno dei due submit salva in $titolo il titolo del post e in $articolo l'articolo del post"
if(isset($_POST['submit'])){
	
	if(isset($_POST['titolo'])){
    $titolo = addslashes($_POST['titolo']);
  }
  
  if(isset($_POST['articolo'])){
    $articolo = addslashes($_POST['articolo']);
  }
  
  //Salva l'azione scelta dall'utente in $action e, a seconda che questi sia update (modifica) o delete (del) esegue l'operazione richiesta
  $action = $_POST['action'];
  
  if(isset($_POST['action']) && $action = 'modifica'){
  
	  $id_post = $_SESSION['id_postm'];        //DOMANDA: VA BENE USARE $_POST['post_id']? - IN ALTERNATIVA SI PUO' USARE, COME SOTTO, $_SESSION['id_postm']
	  $sql_update = "UPDATE ac_post SET post_titolo = '$titolo', post_articolo = '$articolo' WHERE post_id = '$id_post'";
	  $query_update = mysql_query($sql_update) or die (mysql_error());
	  echo "Modifica avvenuta con successo! <br><br><a href='http://www.restartcampania.altervista.org/blog.php'>Clicca qui per tornare alla community</a> oppure attendi e sarai reindirizzato alla home page fra 5 secondi!";
	  header("Refresh:5; url=http://www.restartcampania.altervista.org");
	  
  }
}

//Dopo un paio di if/elseif ci va un else con il form di modifica
//"Se non è stato submitted nulla allora mostra il form di inserimento"
else {
	
//PROBLEMA NUMERO 2 - QUI CI ANDREBBE UNA QUERY PER SELEZIONARE IL POST CHE: id = id del post da modificare; IL PROBLEMA E'
//COME INDICARE "id del post da modificare" - SI USA $_GET('id')? IL RISULTATO DELLA QUERY DEVE ESSERE $titolop E $articolop

//SOLUZIONE 1 - PASSIAMO L'ID DEL POST TRAMITE LA SESSIONE CORRENTE
	$idp = $_SESSION['id_postm'];
	$sql_ricerca = "SELECT post_titolo, post_articolo FROM ac_post WHERE post_id = '$idp'"; //
	$query_ricerca = mysql_query($sql_ricerca) or die (mysql_error());
	
	while($row_post = mysql_fetch_array($query_ricerca)){
		
		$titolop = stripslashes($row_post['post_titolo']);
		$articolop = stripslashes($row_post['post_articolo']);
		
	}
// DOMANDA: SERVE session_destroy?
?>

<br>
<form name="update_delete" method="post" action="modifica_cancella.php" enctype="multipart/form-data">

<!--PROBLEMA NUMERO 1 - COME GESTIAMO L'IMMAGINE? L'UTENTE PUO' INSERIRE UNA NUOVA IMMAGINE? -->

<!--Seleziona un immagine: <input type="file" name="prova">
<br> SOLUZIONE 1 - NON PUO'.-->

<!--per $titolop intendo il titolo del post che si vuole modificare-->

Titolo:<br>
<input name="titolo" type="text" size="30" value="<?php echo $titolop;?>"><br>
<br>

Articolo:
<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    image_list: [                                              //lista di immagini fra cui scegliere
    {title: 'Reggia di Caserta', value: 'Reg_Cas.jpg'},
    {title: 'Piazza del Plebiscito', value: 'Piaz_Pleb.jpg'}
  ],
  	image_advtab: true,            //aggiunge le opzioni avanzate all'immagine
style_formats: [                   //e questo dovrebbe mettere l'immagine a sinistra
  {title: 'Image Left',            //ma forse la mette a sinistra solo nell'inserimento del post
  selector: 'img',
  styles: {
    'float' : 'left',
    'margin': '0 10px 0 10px'
  }}
]
});
</script>

<!--con $articolop intendo l'articolo del post che si vuole modificare-->

<br>
<textarea name="articolo" cols="40" rows="10"><?php echo $articolop;?></textarea><br>      <!-- "articolo" e "titolo", come nomi delle textarea servono per essere usati da $_POST-->

<!--pulsante per la modifica-->

<input name="submit" type="submit" value="Modifica">
<input type="hidden" id="action" name="action" value="modifica"/> <!--è importante il value?-->

</form>

<?php

} //chiude l'else
	
?>

</body>
</html>
