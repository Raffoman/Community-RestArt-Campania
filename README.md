# Community-RestArt-Campania
All'interno della cartella RestartCampania + Community è possibile trovare tutti i file php , html, css, javascript ecc. del sito RestartCampania e in più vi sono i file che abbiamo creato  (gruppo 29) per la realizzazione di una community. 

Il file my_restartcampania.sql corrisponde al DUMP dell’intero DATABASE (strutture e dati) da importare con phymyadmin.

I file sono stati caricati tutti insieme poiché la costruzione della sezione community andava collegata con la restante parte dei codici già presenti. Inoltre si è scelto di utilizzare i codici già presenti per utilizzare un'interfaccia che fosse uguale a quella presente già da prima. 

Inoltre si teneva precisare che è stato creato un sito "demo", o meglio un prototipo del sito comprensivo della sezione Community che è possibile visionare a questo indirizzo web:

http://www.restartcampania.altervista.org/

Cliccando infatti su questo link è possibile accedere alla pagina iniziale e se ci spostiamo sulla scheda COMMUNITY, accediamo alla sezione appena realizzata.

Di seguito sono elencati i file che sono stati realizzati per il progetto:

blog.php : file contenente i codici relativi alla creazione della scheda COMMUNITY. Quindi si parla di anteprime dei post, sistema di votazione, impaginazione, pulsante di creazione post, informazioni sui post, commenti, sorting tra i vari post attraverso i pulsanti più votati, più recenti, più controversi, i più vecchi e quant'altro.

anteprima.php : funzione richiamata da blog.php in grado di racchiudere l'intero post in un'anteprima.

post.php : pagina specifica del post accessibile dopo aver cliccato il pulsante "leggi tutto" in blog.php. Questa pagina viene numerata automaticamente per ogni post e contiene il post per intero, l'immagine di anteprima, il sistema per i commenti implementato con uno script di facebook e infine i pulsanti per la modifica e la cancellazione del post (solo se l'id del post coincide con l'id del creatore).

ajaxvote.php : script per il sistema di votazione (si interfaccia con il campo post_vote presente nel database, incrementa o diminuisce di un voto ogni volta che si clicca una delle due freccette).

most_controversial.php : pagina nella quale sono rappresentati i post con più voti negativi.

most_voted.php : pagina nella quale sono rappresentati i post con più voti positivi.

oldest.php : i post meno recenti.

Una cartella 'prova' : cartella contenente le immagini che vengono caricate in seguito alla compilazione del form di inserimento post ( i file prima sono caricati in una location temporanea e poi spostati quì).

Alcuni script sono stati inseriti nella cartella 'js' : quì è presente lo script di facebook e quello dei voti, ma anche uno script inserito in insert_post (casella di composizione di messaggi in bbcode).

Nella cartella 'css' troviamo invece : 

stile_post.css :  contiene i codici relativi alle scelte di design di alcuni componenti, ad esempio i singoli post.

Nella cartella 'cp' (contenente le pagine acceduto solo dagli utenti registrati) :

insert_post.php : file relativo alla pagina contenente il form di inserimento di un post comprensivo del form di inserimento immagine che nel caso venga omessa sarà sostituita da un'immagine di default. Questa pagina viene caricata nel caso si stia tentando di modificare il post attraverso la funzione specifica.

cancella_post.php :  si arriva a questa pagina se viene cliccato il pulsante cancella il post. All'interno di questa bisogna affermare di voler cancellare il post.

modifica_cancella.php : permette la modifica del post specifico.