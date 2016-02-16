<html>
<head>
<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

<!-- Controllo sulla sessione attiva: se l'utente è loggato può visionare la pagina di inserimento post, altrimenti viene reindirizzato alla pagina di login.
Inoltre vengono valorizzate variabili atte a contenere nome e cognome dell'utente in modo tale da utilizzarle al momento della creazione del post -->

<?php
include("config.php");
$sessione = $_COOKIE['session'];
$sql = "SELECT * FROM ac_session WHERE session='$sessione'";
$query = @mysql_query($sql) or die (mysql_error());
$num = mysql_num_rows($query);
while($row = mysql_fetch_array($query))
{
	$uid = $row['uid'];
}
if($num == 0)
{
header("Location: $sitename/?do=login");
}
else
{
$sql1 = "SELECT * FROM ac_user WHERE id='$uid'";
$query1 = @mysql_query($sql1) or die (mysql_error());
$num1 = mysql_num_rows($query1);
while($r = mysql_fetch_array($query1))
{
	$id_aut = $r['id'];
	$nome = $r['nome'];
	$cognome = $r['cognome'];
}
?>

<head>

<?php
include("config.php");
?>

<!-- Parte relativa all'interfaccia grafica della pagina -->

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
include('cp/side.php');
?>
</ul>
</nav>
</div>
</header><section class="site-section site-section-light site-section-top themed-background-autumn">
<div class="container">
<h1 class="text-center animation-slideDown"><strong>Community</strong></h1>
<h2 class="h3 text-center animation-slideUp"><strong>Scrivi</strong> un post!</h2>
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
//includiamo il file di configurazione
@include "config.php";

//valorizziamo le variabili con i dati ricevuti dal form

if(isset($_POST['submit'])){
  if(isset($_POST['titolo'])){
    $titolo = addslashes($_POST['titolo']);
  }
  if(isset($_POST['articolo'])){
    $articolo = addslashes($_POST['articolo']);
  }
  
    $action = $_POST['action'];
    if (isset($_POST['action']) && $action == "upload")
	{
		$p_dir = "./prova/";
    
		$img_title = $_FILES['prova']['name'];
     
//Controllo: se l'immagine non è stata caricata o non esiste setta a NULL post preview
     
     if(!file_exists($_FILES['prova']['tmp_name']) || !is_uploaded_file($_FILES['prova']['tmp_name'])) {
     $sql83 = "INSERT INTO ac_post (post_autore, post_titolo, post_articolo, post_preview, post_data, id_autore) VALUES ('$nome $cognome', '$titolo', '$articolo', NULL, now(), '$id_aut')";
     // se l'inserimento ha avuto successo inviamo una notifica
     if ($titolo==NULL || $articolo==NULL){
	 echo "Uno o più campi sono vuoti! Reinserisci i tuoi dati!";
     header("Refresh:5; url=http://restartcampania.altervista.org/cp/insert_post.php");
     } elseif (mysql_query($sql83) or die (mysql_error())){
     echo "Articolo inserito con successo.";
    }
     
}

//Altrimenti prosegui con l'inserimento in post_preview della stringa del file
else{
		$p_extension = array('.jpeg', '.jpg', '.png', '.JPG', '.JPEG', '.PNG');
		$title = mysql_escape_string($_POST['title']);
		list($p_name, $p_ext) = explode(".", $_FILES['prova']['name']);
		$p_ext = strrchr($_FILES['prova']['name'], '.');
        
        if(!in_array($p_ext, $p_extension))
		{
			echo "<h3><font color='red'>Hai tentato di caricare un'immagine con estensione non supportata!</font></h3>";
		}
					$p_name_md5 = md5($p_name);
				
				    $sql5 = "SELECT * FROM ac_post WHERE post_preview LIKE '%$p_name_md5%'";
			        $query5 = mysql_query($sql5) or die (mysql_error());
				    $num5 = mysql_num_rows($query5);
					
					if($num5 == 0)
					{
					$i = 1;
					}
					else
					{
					$i = $num5+1;
					} 
					$preview = $p_name_md5."_$i$p_ext";
                    $sql11 = "INSERT INTO ac_post (post_autore, post_titolo, post_articolo, post_preview, post_data, id_autore) VALUES ('$nome $cognome', '$titolo', '$articolo', '$preview', now(), '$id_aut')";
                    //$query = mysql_query($sql11) or die (mysql_error());		
                    // se l'inserimento ha avuto successo inviamo una notifica
                    if ($titolo==NULL || $articolo==NULL){
	                echo "Uno o più campi sono vuoti! Reinserisci i tuoi dati!";
                    header("Refresh:5; url=http://restartcampania.altervista.org/cp/insert_post.php");
                    } elseif (mysql_query($sql11) or die (mysql_error())){
                    echo "Articolo inserito con successo.";
                    }
                   if ($_FILES['prova']['error'] != UPLOAD_ERR_OK) {
                   echo "Error: " . $_FILES['prova']['error'] . "<br>";
}  
                     move_uploaded_file($_FILES["prova"]["tmp_name"], "/membri/restartcampania/prova/".$preview) or die("Error");
                    
					//echo "<h3><font color='green'>Caricamento avvenuto con successo! Attendi l'approvazione dell'amministratore!</font></h3>";
                
    }
    
} // chiusura dell'else
   
 
  // popoliamo i campi della tabella articoli con i dati ricevuti dal form:
  
  }
else{
  // se non sono stati inviati dati dal form mostriamo il modulo per l'inserimento
  ?>

<!-- Parte relativa ai form per l'inserimento delle info di un post -->
  

<form name="upload" method="post" action="insert_post.php" enctype="multipart/form-data">


Seleziona un immagine: <input type="file" name="prova">
<br>
Titolo:<br>
<input name="titolo" type="text" size="30"><br>
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


<br>
<textarea name="articolo" cols="40" rows="10"></textarea><br>
<input name="submit" type="submit" value="Invia">
<input type="hidden" id="action" name="action" value="upload" /> 
</form>


  <?php
}
?>

  <?php
}
?>
