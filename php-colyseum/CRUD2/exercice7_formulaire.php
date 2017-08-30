<?php

try{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', 'user');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Permet d'ajouter les erreurs dans le navigateur
}catch(Exception $e){
	// En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}


$ligne24 = $bdd->query('SELECT * FROM clients WHERE id = 24');
$client24 = $ligne24->fetch();

$ligne25 = $bdd->query('SELECT * FROM clients WHERE id = 25');
$client25 = $ligne25->fetch();



/*$tableauClient[] = array('id' => $donnees['id'],
						'lastName' => $donnees['lastName'],
						 'firstName' => $donnees['firstName'],
						 'birthDate' => $donnees['birthDate'],
						 'card' => $donnees['card'],
						 'cardNumber' => $donnees['cardNumber']); 
}*/


/*echo "test:".$_POST["startTime"];
if(isset($_POST["title"]) && isset($_POST["performer"]) && isset($_POST["date"]) && isset($_POST["showTypesId"]) &&isset($_POST["firstGenresId"]) &&
   isset($_POST["secondGenreId"]) && isset($_POST["duration"]) && isset($_POST["startTime"]) ){ */
	
	$lastName = $_POST["lastName"];
	$firstName = $_POST["firstName"];
	$birthDate = $_POST["birthDate"];
	$card = $_POST["card"];
	$cardNumber = $_POST["cardNumber"];


	$bdd->prepare("DELETE FROM clients where id between 24 AND 25")->execute();

	//$d=$bdd->prepare("UPDATE clients SET lastName = '$lastName', firstName = '$firstName'
	//			      WHERE id = 5 ")->execute();

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
  Numéro client: <input type="number" name="id" value="<?php echo $client24["id"];?>"><br/>
  Nom:<input type="text" name="lastName" value="<?php echo $client24["lastName"];?>"> <br/> <!-- Nom -->	
  Prénom: <input type="text" name="firstName" value="<?php echo $client24["firstName"];?>"><br><!-- Prénom -->
  Date de naissance:<input type="date" name="birthDate" value="<?php echo $client24["birthDate"];?>"> <br/> 
  Carte de fidélite:  
	<?php 
		if ($client24["card"] == 1) {
			echo '<input type="checkbox" name="cardNumber" value="" checked><br>';
		}else{
			echo '<input type="checkbox" name="cardNumber" value=""><br>';	
		}
  		
  	?>
  Numéro de carte de fidélité<input type="text" name="card" size="3" value="<?php echo $client24["cardNumber"];?>"> <br>
  <br>
  <hr/>

  Numéro client: <input type="number" name="id" value="<?php echo $client25["id"];?>"> <br/>
  Nom:<input type="text" name="lastName" value="<?php echo $client25["lastName"];?>"> <br/> <!-- Nom -->	
  Prénom: <input type="text" name="firstName" value="<?php echo $client25["firstName"];?>"><br><!-- Prénom -->
  Date de naissance:<input type="date" name="birthDate" value="<?php echo $client25["birthDate"];?>"> <br/> 
  Carte de fidélite:  
	<?php 
		if ($client25["card"] == 1) {
			echo '<input type="checkbox" name="cardNumber" value="" checked><br>';
		}else{
			echo '<input type="checkbox" name="cardNumber" value=""><br>';	
		}
  		
  	?>
  Numéro de carte de fidélité<input type="text" name="card" size="3" value="<?php echo $client25["cardNumber"];?>"> <br>
  <br>

  <input type="submit" value="Supprimer">
</form> 


</body>
</html>	
