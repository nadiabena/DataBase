<?php

$lastName = $_POST["lastName"];
$firstName = $_POST["firstName"];
$birthDate = $_POST["birthDate"];
$card = $_POST["card"];
$cardNumber = $_POST["cardNumber"];

try{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', 'user');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Permet d'ajouter les erreurs dans le navigateur
}catch(Exception $e){
	// En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}


//var_dump($birthDate);

//A l'aide de ce formulaire, ajouter à la liste des clients Alicia Moore née le 8 septembre 1979 et ne possédant pas de carte de fidélité.
if(isset($lastName) && isset($firstName) && isset($birthDate) && isset($card) && isset($cardNumber) ){ 

	//$date = implode('-', array_reverse(explode('/', $date)));
	$date = explode("/", $birthDate);
	$jour = $date[0];
	$mois = $date[1];
	$annee = $date[2];

	$birthDate = $annee."-".$mois."-".$jour;

	$bdd->prepare('INSERT INTO clients(lastName, firstName, birthDate, card, cardNumber) VALUES ('.
			$bdd->quote($lastName) .','. $bdd->quote($firstName).','.$bdd->quote("1979-09-08").','.$card.','.$cardNumber.')')->execute();

	$insert = $bdd->prepare('INSERT INTO clients(lastName, firstName, birthDate, card, cardNumber) VALUES ('.$bdd->quote($lastName) .','. $bdd->quote($firstName).','. 
		$birthDate.','.$card.', :cardNumber )');  //		$bdd->quote($birthDate).','. $card.','. NULL.')')->execute();

	//$insert = $bdd->prepare('INSERT INTO clients(lastName, firstName, birthDate, card, cardNumber) VALUES ('.$bdd->quote($lastName) .','. $bdd->quote($firstName).','. 
	//	$bdd->quote($birthDate).','.$card.', :cardNumber )');  //		$bdd->quote($birthDate).','. $card.','. NULL.')')->execute();

	//$insert->bindValue(':cardNumber', $cardNumber, PDO::PARAM_INT);
	//$insert->execute();
}



//NSERT INTO `clients`(`id`, `lastName`, `firstName`, `birthDate`, `card`, `cardNumber`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6])

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
  Nom:<input type="text" name="lastName" value="Ciccone"> <br/> <!-- Nom -->	
  Prénom: <input type="text" name="firstName" value="Louise"><br><!-- Prénom -->
  Date de naissance:<input type="text" name="birthDate" value="16/08/1958"> <br/> 
  Numéro de carte de fidélite:  <input type="text" name="cardNumber" value="7125"><br>
  Carte de fidélité<input type="text" name="card" size="3" value="2"> <br>

  <br><br>
  <input type="submit" value="Ajouter">
</form> 


</body>
</html>	


