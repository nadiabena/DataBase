<?php

try{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', 'user');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Permet d'ajouter les erreurs dans le navigateur
}catch(Exception $e){
	// En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}

$tableauShowTypes = [];
$resultat = $bdd->query('SELECT * FROM showTypes');
while ($donnees = $resultat->fetch()){
	$tableauShowTypes[$donnees["id"]] = array('type' => $donnees['type']); 
}

$tableauGenre = [];
$resultat = $bdd->query('SELECT * FROM genres');
while ($donnees = $resultat->fetch()){
	$tableauGenre1[$donnees["id"]] = array('genre' => $donnees['genre']); 
}

$titre = $_POST["titre"];
$artiste = $_POST["artiste"];
$date = $_POST["date"];

$typeSpectacle = $_POST["typeDeSpectacle"];
$genre1 = $_POST["genre1"];
$genre2 = $_POST["genre2"];

$duree = $_POST["duree"];
$heureDeDebut = $_POST["heureDeDebut"];



if(isset($titre) && isset($artiste) && isset($date) && isset($typeSpectacle) && isset($genre1) && isset($genre2) && isset($duree) && isset($heureDeDebut)){ 

	$bdd->prepare('INSERT INTO shows(title, performer, date, showTypesId, firstGenresId, secondGenreId, duration, startTime) VALUES ('.
			$bdd->quote($titre) .','. 
			$bdd->quote($performer).','.
			$bdd->quote($date).','.
			$typeSpectacle.','.
			$genre1.','.
			$genre2.','.
			$bdd->quote($duree).','.
			$bdd->quote($heureDeDebut).')')->execute();
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="fr" />
 	<meta name="author" content="Nadia B." />

 	<title>
		Exercice CRUD (2): Colyseum 
 	</title>
</head>
<body>

<form action="" method="POST">

  Titre:<input type="text" name="titre" value="I love techno"> <br/>
  Artiste: <input type="text" name="artiste" value=" David Guetta"><br>
  Date:  <input type="date" name="date" value="20 septembre 2019"><br>
  
  Type de spectacle: 
  	<select name="typeDeSpectacle">
		<?php
			foreach ($tableauShowTypes as $key => $value) {
				echo '<option value='.$key.'>'.$value["type"].'</option>';
			}
  		?>
	</select><br>

  Genre1:  
	<select name="genre1">
		<?php
			foreach ($tableauGenre1 as $key => $value) {
				echo '<option value='.$key.'>'.$value["genre"].'</option>';
			}
  		?>
  	</select><br>
  
  Genre2:  
	<select name="genre2">
		<?php
			foreach ($tableauGenre1 as $key => $value) {
				echo '<option value='.$key.'>'.$value["genre"].'</option>';
			}
  		?>
  	</select><br>
  <br>
  Durée:  <input type="time" name="duree" value="03:00:00"> Format attendu:  00:00:00<br>
  Heure de début:  <input type="time" name="heureDeDebut" value="21:00:00"> Format attendu:  00:00:00 <br>  
  <br><br>
  <input type="submit" value="Ajouter">
</form> 


</body>
</html>	


