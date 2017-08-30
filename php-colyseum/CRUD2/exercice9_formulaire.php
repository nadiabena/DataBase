<?php

try{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', 'user');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Permet d'ajouter les erreurs dans le navigateur
}catch(Exception $e){
	// En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}


$resultat = $bdd->query('SELECT tickets.id, tickets.price, tickets.bookingsId
						 FROM tickets
						 WHERE tickets.bookingsId = 24 AND tickets.bookingsId = 25');

$billets = [];

while($donnees = $resultat->fetch()){
$billets[] = array('id' => $donnees['id'],
				   'price' => $donnees['price'],
				   'bookingsId' => $donnees['bookingsId']); 
}


if(isset($_POST["id"]) && isset($_POST["price"]) && isset($_POST["reservation"]) ){	
	$id = $_POST["id"];
	$price = $_POST["price"];
	$bookingsId = $_POST["reservation"];	
}

foreach ($billets as $key => $value) {

	$bdd->prepare("DELETE
				   FROM tickets
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

	<?php foreach ($billets as $key => $value) {
	?>

	Numéro billets: <input name="id" type="number" value="<?php echo $value["id"];?>"><br/>
	Prix: <input type="number" name="price" value="<?php echo $value["price"];?>"><br/> 
	Numéro réservation: <input name="reservation" type="number" value="<?php echo $value["bookingsId"];?>"><br/> 
  	<br>

	<?php } ?>

  <input type="submit" value="Supprimer">
</form>


</body>
</html>	
