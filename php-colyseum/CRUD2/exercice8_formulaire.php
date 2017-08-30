<?php

try{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', 'user');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Permet d'ajouter les erreurs dans le navigateur
}catch(Exception $e){
	// En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}


$resultat = $bdd->query('SELECT DISTINCT bookings.id, bookings.clientId
						 FROM clients, bookings
						 WHERE bookings.clientId = 20 OR bookings.clientId = 21');

$reservation = [];

while($donnees = $resultat->fetch()){
$reservation[] = array('id' => $donnees['id'],   // Reservation's id
					   'clientId' => $donnees['clientId']); 
}

	
$id = $_POST["id"];
$clientId = $_POST["clientId"];
	

foreach ($reservation as $key => $value) {

	$bdd->prepare("DELETE
				   FROM bookings
	               WHERE id =". $value["id"] )->execute();
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

	<?php foreach ($reservation as $key => $value) {
	?>
  		Numéro réservation: <input type="number" name="id" value="<?php echo $value["id"];?>"><br/>
  		Numéro client: <input type="number" name="clientId" value="<?php echo $value["clientId"];?>"><br/> 
  		<br>
  		<hr/>
	<?php
	}?>


  <input type="submit" value="Supprimer">
</form> 


</body>
</html>	
