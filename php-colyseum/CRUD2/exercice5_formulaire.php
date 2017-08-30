<?php

try{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', 'user');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Permet d'ajouter les erreurs dans le navigateur
}catch(Exception $e){
	// En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}


$resultat = $bdd->query('SELECT * FROM shows WHERE title = "Vestibulum accumsan"');

$typeShows = $bdd->query("SELECT s.type FROM showTypes s, shows WHERE shows.title = 'Vestibulum accumsan' AND shows.id = s.id");
$donneesTypeShows = $typeShows->fetch();

$genre1 = $bdd->query("SELECT g.genre FROM shows s, genres g WHERE s.title = 'Vestibulum accumsan' AND s.firstGenresId = g.id");
$donneesGenre1 = $genre1->fetch();

$genre2 = $bdd->query("SELECT g.genre FROM shows s, genres g WHERE s.title = 'Vestibulum accumsan' AND s.secondGenreId = g.id");
$donneesGenre2 = $genre2->fetch();


$tableauShows = [];
while ($donnees = $resultat->fetch()){
	$tableauShows[] = array('title' => $donnees['title'],
							 'performer' => $donnees['performer'],
							 'date' => $donnees['date'],
							 'showTypesId' => $donnees['showTypesId'],
							 'firstGenresId' => $donnees['firstGenresId'],
							 'secondGenreId' => $donnees['secondGenreId'],
							 'duration' => $donnees['duration'],
							 'startTime' => $donnees['startTime']);
}


/*echo "test:".$_POST["startTime"];
if(isset($_POST["title"]) && isset($_POST["performer"]) && isset($_POST["date"]) && isset($_POST["showTypesId"]) &&isset($_POST["firstGenresId"]) &&
   isset($_POST["secondGenreId"]) && isset($_POST["duration"]) && isset($_POST["startTime"]) ){ */
	
	$title = $_POST["title"];
	$performer = $_POST["performer"];
	$date = $_POST["date"];
	$showTypesId = $_POST["showTypesId"];
	$firstGenresId = $_POST["firstGenresId"];
	$secondGenreId = $_POST["secondGenreId"];
	$duration = $_POST["duration"];
	$startTime = $_POST["startTime"];


	echo "test:".$startTime;
	//echo "date:".$date;
	//startTime = '".$startTime."' ,

	$d=$bdd->prepare("UPDATE shows SET startTime = '$startTime', date = '$date'
				   WHERE title = 'Vestibulum accumsan' ")->execute(); //->execute()

	var_dump($d);

/*}*/

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
  Titre :<input type="text" name="title" value="<?php echo $tableauShows[0]["title"];?>"> <br/> <!-- Nom -->	
  Artiste: <input type="text" name="performer" value="<?php echo $tableauShows[0]["performer"];?>"><br><!-- Prénom -->
  Date:<input type="date" name="date" value="<?php echo $tableauShows[0]["date"];?>"> <br/> 

  Type de Spectacle (showTypesId) <input type="text" name="typeDeSpectacle" value="<?php echo $donneesTypeShows["type"];?>"> <br/>
  Genre 1 (firstGenresId) <input type="text" name="genre1" value="<?php echo $donneesGenre1["genre"];?>"> <br/> 
  Genre 2 (secondGenreId) <input type="text" name="genre2" value="<?php echo $donneesGenre2["genre"];?>"> <br/>

  Durée (duration) <input type="text" name="duration" value="<?php echo $tableauShows[0]["duration"];?>"> <br/> 
  Date de début (startTime) <input type="text" name="startTime" value="<?php echo $tableauShows[0]["startTime"];?>"> <br/> 


  <br><br>
  <input type="submit" value="Mettre à jour">
</form> 


</body>
</html>	


