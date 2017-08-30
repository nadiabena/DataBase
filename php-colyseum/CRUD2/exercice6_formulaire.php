<?php

try{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', 'user');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Permet d'ajouter les erreurs dans le navigateur
}catch(Exception $e){
	// En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}


$resultat = $bdd->query('SELECT * FROM clients WHERE id = 5');

$tableauClient = [];

$donnees = $resultat->fetch();


/*echo "test:".$_POST["startTime"];
if(isset($_POST["title"]) && isset($_POST["performer"]) && isset($_POST["date"]) && isset($_POST["showTypesId"]) &&isset($_POST["firstGenresId"]) &&
   isset($_POST["secondGenreId"]) && isset($_POST["duration"]) && isset($_POST["startTime"]) ){ */
	
	$lastName = $_POST["lastName"];
	$firstName = $_POST["firstName"];
	$birthDate = $_POST["birthDate"];
	$card = $_POST["card"];
	$cardNumber = $_POST["cardNumber"];

	$d=$bdd->prepare("UPDATE clients SET lastName = '$lastName', firstName = '$firstName'
				      WHERE id = 5 ")->execute();

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
  Nom:<input type="text" name="lastName" value="<?php echo $donnees["lastName"];?>"> <br/> <!-- Nom -->	
  Prénom: <input type="text" name="firstName" value="<?php echo $donnees["firstName"];?>"><br><!-- Prénom -->
  Date de naissance:<input type="date" name="birthDate" value="<?php echo $donnees["birthDate"];?>"> <br/> 
  Numéro de carte de fidélite:  
	<?php 
		if ($donnees["card"] == 1) {
			echo '<input type="checkbox" name="cardNumber" value="" checked><br>';
		}else{
			echo '<input type="checkbox" name="cardNumber" value=""><br>';	
		}
  		
  	?>
  Carte de fidélité<input type="text" name="card" size="3" value="<?php echo $donnees["cardNumber"];?>"> <br>

  <br><br>
  <input type="submit" value="Mettre à jour">
</form> 


</body>
</html>	
