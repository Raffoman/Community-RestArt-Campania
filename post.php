<html>
<head>
<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

<?php

//APRO UNA SESSIONE
session_start();
include("config.php");
$sessione = $_COOKIE['session'];
$sql8 = "SELECT * FROM ac_session WHERE session='$sessione'";
$query8 = @mysql_query($sql8) or die (mysql_error());
$num8 = mysql_num_rows($query8);
while($row2 = mysql_fetch_array($query8))
{
	$uid = $row2['uid'];
}
$sql9 = "SELECT id FROM ac_user WHERE id='$uid'";
$query9 = @mysql_query($sql9) or die (mysql_error());
$num9 = mysql_num_rows($query9);
while($r = mysql_fetch_array($query9))
{
	$id_aut = $r['id'];
}
?>

<!--HEADER-->

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
<link rel="stylesheet" href="css/stile_post.css">
<script src="js/vendor/modernizr-2.7.1-respond-1.4.2.js"></script>
</head>
<body><div id="page-container">
<header>
<div class="container">
<a href="http://www.restartcampania.com/" class="site-logo">
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
include('sidebar.php');
?>
</ul>

</nav>

<?php

  //RENDIAMO POST_ID VARIABILE GLOBALE, VERIFICANDO CHE SIA UN VALORE NUMERICO

  if(isset($_GET['id'])&&(is_numeric($_GET['id']))){
  // valorizziamo la variabile relativa all'id dell'articolo e includiamo il file di configurazione
 
  $post_id = $_GET['id'];
  
  //per condividere l'id del post
  $_SESSION["id_postm"] = $post_id; // dovrebbe essere  ricavato: $codice = quello che vuoi o quello generato, o ecc..
  session_register("id_postm");

  @include "config.php";

  // selezioniamo dalla tabella i dati relativi all'articolo
  $sql = "SELECT post_autore,post_titolo,post_data,post_articolo FROM ac_post WHERE post_id='$post_id'";
  $query = @mysql_query($sql) or die (mysql_error());

  // se per quell'id esiste un articolo..
  if(mysql_num_rows($query) > 0){
    // ...estraiamo i dati e mostriamoli a video
    $row = mysql_fetch_array($query) or die (mysql_error());
    $autore = stripslashes($row['post_autore']);
    $titolo = stripslashes($row['post_titolo']);
    $data = $row['post_data'];
    $articolo = stripslashes($row['post_articolo']);
    $data = preg_replace('/^(.{4})-(.{2})-(.{2})$/','$3-$2-$1', $data); 
    } 
    }
?>

<!--MOSTRO AUTORE E TITOLO DEL POST-->

</div>
</header><section class="site-section site-section-light site-section-top themed-background-autumn">
<div class="container">
<h1 class="text-center animation-slideDown"><strong><p align="left"><?php echo $titolo; ?><p></strong></h1>
<h2 class="h3 text-center animation-slideUp"><p align="left"><?php echo $autore; ?></p></h2>
</div>
</section>
<section class="site-content site-section">

<!--PULSANTE CHE REINDIRIZZA A BLOG.PHP-->

<div class="container">
<div class="site-block clearfix">
<a href="/blog.php" class="btn btn-primary pull-left"><i class="fa fa-th-large"></i> Tutti i post</a>
</div>
<div class="row">
<div class="col-sm-6 site-block">


<div class="container">
<div class="site-block text-center">
<div class="btn-group portfolio-filter">
</div>
</div>
<body>

<!--Like Button-->

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/it_IT/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>






<?php
//controlliamo che sia stato inviato un id numerico alla pagina
if(isset($_GET['id'])&&(is_numeric($_GET['id']))){
  // valorizziamo la variabile relativa all'id dell'articolo e includiamo il file di configurazione
  $post_id = $_GET['id'];
  @include "config.php";

  // selezioniamo dalla tabella i dati relativi all'articolo
  $sql = "SELECT post_autore,post_titolo,post_data,post_articolo,post_preview,id_autore FROM ac_post WHERE post_id='$post_id'";
  $query = @mysql_query($sql) or die (mysql_error());



  // se per quell'id esiste un articolo..
  if(mysql_num_rows($query) > 0){
    // ...estraiamo i dati e mostriamoli a video
    $row = mysql_fetch_array($query) or die (mysql_error());
    $autore = stripslashes($row['post_autore']);
    $titolo = stripslashes($row['post_titolo']);
    $data = $row['post_data'];
    $articolo = stripslashes($row['post_articolo']);
    $img = stripslashes($row['post_preview']);
    $id_autorep = $row['id_autore'];
    
    //NEL CASO NON SIA INSERITA UN IMMAGINE, NE INSERISCO UNA DI DEFAULT
    
    if($img==""){ ?>
   	<img src="https://risultati5stelle.files.wordpress.com/2015/03/restart-campania.jpg?w=1100" id="img_post">
    <?php
    } else {
   ?>
   <img src="<?php echo $sitename; ?>/prova/<?php echo $img; ?>" id="img_post">
   <?php
   }
   ?>
   <br>
   <br>
   <br>
   <br>
   
   <?php
   
    //CHIUDO IL POST INSERENDO LA DATA DI PUBBLICAZIONE 
    
    echo "<div style='text-align:left'>".$articolo . "</div>" . "<br><br>";              //div style e roba varia è quello che serve per centrare il tutto
    $data = preg_replace('/^(.{4})-(.{2})-(.{2})$/','$3-$2-$1', $data);
    echo "<div style='text-align:right'>Articolo postato il <b>" . $data . "</b>";   //come sopra, solo che lo allinea a destra
    if($id_aut == $id_autorep){
    	echo "| <a href='http://www.restartcampania.altervista.org/cp/modifica_cancella.php'>Modifica il tuo post</a> | <a href='http://www.restartcampania.altervista.org/cp/cancella_post.php'>Elimina il tuo post</a></div>";
    }
    } 
    }
	else{
	  echo "Nessun post trovato!";
    }
	?> 
    
<!--SCRIPT DEI COMMENTI-->

<div style='text-align:right'> 
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/it_IT/sdk.js#xfbml=1&appId=692169830876067&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<!--Like button-->
<div style="text-align=right">
<?php
echo "Metti mi piace alla pagina di Restart Campania o condividi su Facebook" . "<br><br>";
?>
<div class="fb-like" data-href="https://www.facebook.com/restartcampania/?fref=ts" data-width="400" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
</div>
<br>
<?php
echo "<div style='text-align:right'>"
?>

<!--MOSTRO I COMMENTI SUL POST-->

<div class="fb-comments" data-href="http://www.restartcampania.altervista.org/post.php?id=<?php echo $post_id; ?>" data-width="500" data-numposts="5" data-colorscheme="light"></div>

<br/><br/><iframe allowTransparency='true' expr:src='&quot;http://www.facebook.com/plugins/like.php?href=&quot; + data:post.canonicalUrl + &quot;&amp;layout=standard&amp;show_faces=false&amp;width=100&amp;action=like&amp;font=arial&amp;colorscheme=light&quot;' frameborder='0' scrolling='no' style='border:none; overflow:hidden; width:450px; height:35px;'/>
</div>
</body>
    
    
    
   