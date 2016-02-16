<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>

<?php
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

if(isset($_POST['submit'])){
  
  //Salva l'azione scelta dall'utente in $action e, a seconda che questi sia update (modifica) o delete (del) esegue l'operazione richiesta
  $action = $_POST['action'];
  
  if(isset($_POST['action']) && $action = 'del'){
	  
	  $id_post = $_SESSION['id_postm'];        //COME SOPRA
	  $sql_delete = "DELETE FROM ac_post WHERE post_id = '$id_post'";
	  $query_delete = @mysql_query($sql_delete) or die (mysql_error());
	  echo "Cancellazione avvenuta con successo! <br><br><a href='http://www.restartcampania.altervista.org/blog.php'>Clicca qui per tornare alla community</a> oppure attendi e sarai reindirizzato alla home page fra 5 secondi!";
	  header("Refresh:5; url=http://www.restartcampania.altervista.org");
	  
  }
} else {
	
?>

<br>
<form name="delete" method="post" action="cancella_post.php" enctype="multipart/form-data">

<!--pulsante per la cancellazione-->
<p>Sei sicuro di voler cancellare il tuo post?</p>
<input name="submit" type="submit" value="Elimina">
<input type="hidden" id="action" name="action" value="del"/>      <!--se ci volesse action?-->

</form>

<?php

} //chiude l'else
	
?>

</body>
</html>