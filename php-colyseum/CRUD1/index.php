<?php
try{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', 'user');
}catch(Exception $e){
	// En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}

$resultat = $bdd->query('SELECT * FROM clients');

$tableDimension2 = [];

while ($donnees = $resultat->fetch()){
	$tableDimension2[$donnees["id"]] = array('lastName' => $donnees['lastName'],
										   'firstName' => $donnees['firstName'],
										   'birthDate' => $donnees['birthDate'],
										   'card' => $donnees['card'],
										   'cardNumber' => $donnees['cardNumber']); 	
}

$tableauShowTypes = [];
$resultat = $bdd->query('SELECT * FROM showTypes');
while ($donnees = $resultat->fetch()){
	$tableauShowTypes[$donnees["id"]] = array('type' => $donnees['type']); 
}


$resultat = $bdd->query('SELECT * FROM clients LIMIT 20');
$tableauClients20 = [];

while ($donnees = $resultat->fetch()){
	$tableauClients20[$donnees["id"]] = array('lastName' => $donnees['lastName'],
										   'firstName' => $donnees['firstName'],
										   'birthDate' => $donnees['birthDate'],
										   'card' => $donnees['card'],
										   'cardNumber' => $donnees['cardNumber']);
}


$resultatCardNumberNotNull = $bdd->query('SELECT * FROM clients WHERE cardNumber IS NOT NULL');
$tableauCardNumberNotNull = [];

while ($donnees = $resultatCardNumberNotNull->fetch()){
	$tableauCardNumberNotNull[$donnees["id"]] = array('lastName' => $donnees['lastName'],
										   'firstName' => $donnees['firstName'],
										   'birthDate' => $donnees['birthDate'],
										   'card' => $donnees['card'],
										   'cardNumber' => $donnees['cardNumber']);
}

$resultatLastNameBeginByM = $bdd->query('SELECT lastName, firstName FROM clients WHERE lastName LIKE "M%" ORDER BY lastName ASC');
$tableauLastNameBeginByM = [];

while ($donnees = $resultatLastNameBeginByM->fetch()){
	$tableauLastNameBeginByM[] = array('lastName' => $donnees['lastName'],
										   'firstName' => $donnees['firstName']);
}

$resultatShows = $bdd->query('SELECT title, performer, date, startTime FROM shows ORDER BY title ASC');
$tableauShows = [];

while ($donnees = $resultatShows->fetch()){
	$tableauShows[] = array('title' => $donnees['title'],
										   'performer' => $donnees['performer'],
										   'date' => $donnees['date'],
										   'startTime' => $donnees['startTime']);
}



?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="fr" />
 	<meta name="author" content="Nadia B." />

 	<title>
		Exercice CRUD (1): Colyseum 
 	</title>
</head>
<body>

	<h1>Exercice 1: Afficher tous les clients.</h1>
	<ul>	
	<?php foreach ($tableDimension2 as $key => $value) {
			echo "<li>".$key." - ".$value["lastName"]." - ".$value["firstName"]." - ".$value["birthDate"]." - ".$value["card"]." - ".$value["cardNumber"]."</li>";
		  }
		  echo "<hr/>";
		?>
	</ul>

	<h1>Exercice 2: Afficher tous les types de spectacles possibles</h1>
	<ul>
	<?php foreach ($tableauShowTypes as $key => $value) {
			echo "<li>".$value["type"]."</li>";
		  }
		  echo "<hr/>";
		?>
	</ul>

	<h1>Exercice 3: Afficher les 20 premiers clients.</h1>
	<ul>	
	<?php foreach ($tableauClients20 as $key => $value) {
			echo "<li>".$key." - ".$value["lastName"]." - ".$value["firstName"]." - ".$value["birthDate"]." - ".$value["card"]." - ".$value["cardNumber"]."</li>";
		  }
		  echo "<hr/>";
		?>
	</ul>

	<h1>Exercice 4: N'afficher que les clients possédant une carte de fidélité.</h1>
	<ul>
	<?php foreach ($tableauCardNumberNotNull as $key => $value) {
			echo "<li>".$key." - ".$value["lastName"]." - ".$value["firstName"]." - ".$value["birthDate"]." - ".$value["card"]." - ".$value["cardNumber"]."</li>";
		  }
		  echo "<hr/>";
	?>		
	</ul>

	<h1>Exercice 5: Afficher uniquement le nom et le prénom de tous les clients dont le nom commence par la lettre "M".</h1>
	<ul>
	<?php foreach ($tableauLastNameBeginByM as $key => $value) {
			echo "<li>"."Nom : ".$value["lastName"]."</li>";
			echo "<li>"."Prénom : ".$value["firstName"]."</li>";
			echo "<br/>";
		  }
		  echo "<hr/>";
	?>		
	</ul>

	<h1>Exercice 6: Afficher le titre de tous les spectacles ainsi que l'artiste, la date et l'heure. Trier les titres par ordre alphabétique. Afficher les résultat comme ceci : Spectacle par artiste, le date à heure.</h1>
	<ul>
	<?php foreach ($tableauShows as $key => $value) {
			echo "<li>".$value["title"]." par ".$value["performer"]." le ".$value["date"]." à ".$value["startTime"]."</li>";
		  }
		  echo "<hr/>";
	?>		
	</ul>

	<h1>Exercice 7: Afficher tous les clients comme ceci :<br/>

		Nom : *Nom de famille du client*<br/>
		Prénom : *Prénom du client*<br/>
		Date de naissance : *Date de naissance du client*<br/>
		Carte de fidélité : *Oui (Si le client en possède une) ou Non (s'il n'en possède pas)*<br/>
		Numéro de carte : *Numéro de la carte fidélité du client s'il en possède une.*</h1>
	<ul>
	<?php foreach ($tableDimension2 as $key => $value) {
			echo "<li>"."Nom : *".$value["lastName"]."*</li>";
			echo "<li>"."Prénom : *".$value["firstName"]."*</li>";
			echo "<li>"."Date de naissance : *".$value["birthDate"]."*</li>";

			if($value["card"] == 1){
				echo "<li>"."Carte de fidélité  : *Oui*"."</li>";
				echo "<li>"."Numéro de carte  : *".$value["cardNumber"]."*</li>";
			}else{
				echo "<li>"."Carte de fidélité : *Non*"."</li>";
			}
			echo "<br/>";
		  }
		  echo "<hr/>";
	?>		
	</ul>






</body>
</html>	