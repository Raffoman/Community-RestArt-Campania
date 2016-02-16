<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

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
<link rel="stylesheet" href="css/stile_post.css"> <!-- per mettere la linea separatrice -->
<link href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet"> <!--per ajaxvote-->
<link href="css/style.css" rel="stylesheet"><!-- per ajaxvote-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script><!--per ajaxvote-->
<script src="js/script.js"></script><!--per ajaxvote-->
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
//includiamo la sidebar
include('sidebar.php');
?>
</ul>

</nav>

<!--CREAZIONE E SORT DEI POST-->

</div>
</header><section class="site-section site-section-light site-section-top themed-background-autumn">
<div class="container">
<h1 class="text-center animation-slideDown"><strong>Community</strong></h1>
<h2 class="h3 text-center animation-slideUp"><strong>Naviga</strong> tra i post!</h2>
</div>
</section>
<section class="site-content site-section">
<div class="container">
<a href="/cp/insert_post.php" class="btn btn-primary pull-left"><i class="fa fa-th-large"></i> Crea un post</a>
<div class="site-block clearfix" style="margin-left: 325px">

<a href="most_voted.php" class="btn btn-primary pull-left" style="margin-right: 3px"><i class="fa fa-th-large"></i> I Più Votati</a>
<a href="most_controversial.php" class="btn btn-primary pull-left" style="margin-right: 3px"><i class="fa fa-th-large"></i> I Più Controversi</a>
<a href="blog.php" class="btn btn-primary pull-left" style="margin-right: 3px"><i class="fa fa-th-large"></i> I Più Recenti</a>
<a href="oldest.php" class="btn btn-primary pull-left"><i class="fa fa-th-large"></i> I Più Vecchi</a>

</div>

<!--<div class="site-block clearfix">

</div>       COMMENTATO PER RIDURRE LO SPAZIO SEPARATORE-->

<div class="row">
<div class="col-sm-6 site-block">

<!--ROOT NECESSARIA AL COUNT DEI COMMENTI -->

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/it_IT/sdk.js#xfbml=1&appId=692169830876067&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<?php

// includiamo il file di configurazione
@include "config.php";

// includiamo la pagina contenente il codice per la creazione delle anteprime
@require "anteprima.php";

// includo ajaxvote per lo script dei voti
include ('ajaxvote.php');

// PAGINAZIONE E STAMPA DEI RECORD

// Creo una variabile dove imposto il numero di record 
// da mostrare in ogni pagina
$x_pag = 5;

// Recupero il numero di pagina corrente.
// Generalmente si utilizza una querystring
$pag = isset($_GET['pag']) ? $_GET['pag'] : 1;

// Controllo se $pag è valorizzato e se è numerico
// ...in caso contrario gli assegno valore 1
if (!$pag || !is_numeric($pag)) $pag = 1; 


// Uso mysql_num_rows per contare il totale delle righe presenti all'interno della tabella agenda
$all_rows = mysql_num_rows(mysql_query("SELECT post_id FROM ac_post"));

// Tramite una semplice operazione matematica definisco il numero totale di pagine
$all_pages = ceil($all_rows / $x_pag);

// Calcolo da quale record iniziare
$first = ($pag - 1) * $x_pag;

// Recupero i record per la pagina corrente...
// utilizzando LIMIT per partire da $first e contare fino a $x_pag
$rs = mysql_query("SELECT * FROM ac_post ORDER BY post_data ASC LIMIT $first, $x_pag");
$nr = mysql_num_rows($rs);
if ($nr != 0){
// APRO IL FOR PER LA STAMPA DEI RISULTATI DELLA QUERY
  for($x = 0; $x < $nr; $x++){
  
    $row = mysql_fetch_assoc($rs);
    $post_id = $row['post_id'];
    $autore = stripslashes($row['post_autore']);
    $titolo = stripslashes($row['post_titolo']);
    $data = $row['post_data'];
    $articolo = stripslashes($row['post_articolo']);
    $voti = $row['post_vote'];
    $img = stripslashes($row['post_preview']);
    $id_autorep = $row['id_autore'];
    if($img==""){
    	$img="restart-campania.jpg";
    }
    //valorizziamo una variabili con il link all'intero articolo
    $link = " ..<br><a href=\"post.php?id=$post_id\">Leggi tutto</a>";
    
    ?>
 	
    <!-- SCRIPT COUNTER VOTI -->
    <div>
    <div class="item" data-postid="<?php echo $post_id; ?>" data-score="<?php echo $voti; ?>">
			<div class="vote-span" id="voti"><!-- voting-->
				<div class="vote" data-action="up" title="Vote up">
					<i class="icon-chevron-up"></i>
				</div><!--vote up-->
				<div class="vote-score"><?php echo $voti; ?></div>
				<div class="vote" data-action="down" title="Vote down">
					<i class="icon-chevron-down"></i>
				</div><!--vote down-->
			</div>
		</div><!--item-->
   <br>
   <br>
   <?php
   // PROVA IMMAGINE DI DEFAULT
   
   /*if($img==""){ ?>
   	<img src="https://risultati5stelle.files.wordpress.com/2015/03/restart-campania.jpg?w=1100" class="img_resize">
    <?php
    } else {
   */?>
   <div id='singolopost'>
   <img src="<?php echo $sitename; ?>/prova/<?php echo $img; ?>" class="img_resize">
   <?php
   //}
    echo "<h3 id='titolo'><b>".$titolo."</b></h3>";  
    ?><div> <?php
   
   
    // creaimo l'anteprima che mostra le prime 30 parole di ogni singolo articolo
    echo "<div id='anteprima_post'>".@anteprima($articolo, 30, $link)."</div>"; 
    echo "<br><br>";
    ?>
    </div></div>
    <?php
   

   
       // formattiamo la data nel formato europeo - sopra
	$data = preg_replace('/^(.{4})-(.{2})-(.{2})$/','$3-$2-$1', $data);
    
    //stampiamo una serie di informazioni
    echo  "<div class='infopost'>Scritto da <b>". $autore . "</b>";
    echo  "| Articolo postato il <b>" . $data . "</b>";
    echo  "| Commenti: "?><span class='fb-comments-count' data-href='http://www.restartcampania.altervista.org/post.php?id=<?php echo $post_id; ?>'></span></div></div> <?php //il counter adesso FUNZIONA!!!
    
   
    
   } //CHIUDO IL FOR STAMPA
   
    echo "</tr></table>";
  
}else{
  echo "Nessun Post trovato!";
}
echo "<br><br><br><br>";
// Se le pagine totali sono più di 1...
// stampo i link per andare avanti e indietro tra le diverse pagine!
if ($all_pages > 1){
  if ($pag > 1){
    echo "<a href=\"" . $_SERVER['PHP_SELF'] . "?pag=" . ($pag - 1) . "\">";
    echo "Pagina Indietro</a>&nbsp;";
  }
  // faccio un ciclo di tutte le pagine
  for ($p=1; $p<=$all_pages; $p++) {
    echo "<a href=\"" . $_SERVER['PHP_SELF'] . "?pag=" . $p . "\">";
    echo $p . "</a>&nbsp;";    
  }
  if ($all_pages > $pag){
    echo "<a href=\"" . $_SERVER['PHP_SELF'] . "?pag=" . ($pag + 1) . "\">";
    echo "Pagina Avanti</a>";
  } 
}

// TERMINO PAGINAZIONE E STAMPA   
  
   
 
 
?>

</div>
 </div>
 </div>

<!--conseguenza del fatto che li ho spostati: adesso il footer appare un po' più in basso, distaccato dalla parte di sotto del body ma i margini continuano a non essere adattati alla pagina-->
<!--credo che per sistemare il footer dovremmo soltanto piazzare bene i punti in cui i vari div e la section si chiudono-->


<section class="site-content site-section">
<div class="container">
<div class="site-block text-center">
<div class="btn-group portfolio-filter">
</div>
</div>
</div>
<?php
// FOOTER

include('footer.php');
?>
</div>
</section>
<a href="#" id="to-top"><i class="fa fa-angle-up"></i></a><script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>!window.jQuery && document.write(decodeURI('%3Cscript src="js/vendor/jquery-1.11.1.min.js"%3E%3C/script%3E'));</script>
<script src="js/vendor/f-bootstrap.min-2.js"></script>
<script src="js/f-plugins-2.js"></script>
<script src="js/f-app-2.js"></script><script src="js/pages/pricing.js"></script>
<script src="js/pages/contact.js"></script>

<script>$(function(){ Pricing.init(); });</script>
        <script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');ga('create', 'UA-16158021-6', 'auto');ga('send', 'pageview');</script>
 
 <!-- NON SONO STATI CHIUSI IN MODO ADEGUATO -->
 </body>
 </html>



