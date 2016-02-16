<!-- Funzione che permette di visualizzare un'anteprima del testo di ogni singolo post -->
<?php
function anteprima($testo, $lunghezza, $finale) {
return (count($parole = explode(' ', $testo)) > $lunghezza) ? implode(' ', array_slice($parole, 0, $lunghezza)) . $finale : $testo . $finale;
}
?>