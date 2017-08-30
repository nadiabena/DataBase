<?php

$lastName = $_POST["lastName"];
$firstName = $_POST["firstName"];
$birthDate = $_POST["birthDate"];
$card = $_POST["card"];
$cardNumber = $_POST["cardNumber"];

var_dump($card);

if($card === "on"){
	$card=1;
}else{
	$card=0;
	$cardNumber=NULL;
}

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
if(isset($lastName) && isset($firstName) && isset($birthDate)){  // && isset($card) && isset($cardNumber)

	$insert = $bdd->prepare('INSERT INTO clients(lastName, firstName, birthDate, card, cardNumber) VALUES ('.$bdd->quote($lastName) .','. $bdd->quote($firstName).','. 
		$bdd->quote($birthDate).','.$card.', :cardNumber )');  //		$bdd->quote($birthDate).','. $card.','. NULL.')')->execute();
	
	$insert->bindValue(':cardNumber', $cardNumber, PDO::PARAM_INT);
	$insert->execute();
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
  Nom: <input type="text" name="firstName">
  <br>
  Prénom:<input type="text" name="lastName"> <br/>
  Date de naissance:<input type="date" name="birthDate"> <br/>
  Carte de fidélité<input type="checkbox" name="card"> <br>
  Numéro de carte de fidélite:  <input type="text" name="cardNumber">
 
  <br><br>
  <input type="submit" value="Ajouter">
</form> 


</body>
</html>	


