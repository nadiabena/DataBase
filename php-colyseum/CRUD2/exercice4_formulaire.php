<?php



try{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', 'user');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Permet d'ajouter les erreurs dans le navigateur
}catch(Exception $e){
	// En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}


$resultat = $bdd->query('SELECT * FROM clients WHERE firstName = "Gabriel" AND lastName = "Perry"');

$tableauClient = [];

while ($donnees = $resultat->fetch()){
	$tableauClient[] = array('lastName' => $donnees['lastName'],
							 'firstName' => $donnees['firstName'],
							 'birthDate' => $donnees['birthDate'],
							 'card' => $donnees['card'],
							 'cardNumber' => $donnees['cardNumber']);
}


//if(isset($lastName) && isset($firstName) && isset($birthDate) && isset($card) && isset($cardNumber) ){//ici je n'ai pas besoin de isset
	//$lastName = $_POST["lastName"];
//$firstName = $_POST["firstName"];

if(isset($_POST["birthDate"])){
	$birthDate = $_POST["birthDate"];

	/*$date = explode("/", $birthDate);
	$jour = $date[0];
	$mois = $date[1];
	$annee = $date[2]; 


	$birthDate = $annee.$mois.$jour;*/

	echo "test: ".$birthDate;

	$bdd->prepare("UPDATE clients SET birthDate = ".$bdd->quote($birthDate)."
				   WHERE firstName = 'Gabriel' AND lastName = 'Perry' ")->execute(); //->execute()

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
  Nom:<input type="text" name="lastName" value="<?php echo $tableauClient[0]["lastName"];?>"> <br/> <!-- Nom -->	
  Prénom: <input type="text" name="firstName" value="<?php echo $tableauClient[0]["firstName"];?>"><br><!-- Prénom -->
  Date de naissance:<input type="date" name="birthDate" value="<?php echo $tableauClient[0]["birthDate"];?>"> <br/> 
  Numéro de carte de fidélite:  
	<?php 
		if ($tableauClient[0]["card"] == 1) {
			echo '<input type="checkbox" name="cardNumber" value="" checked><br>';
		}else{
			echo '<input type="checkbox" name="cardNumber" value=""><br>';	
		}
  		
  	?>
  Carte de fidélité<input type="text" name="card" size="3" value="<?php echo $tableauClient[0]["cardNumber"];?>"> <br>

  <br><br>
  <input type="submit" value="Mettre à jour">
</form> 


</body>
</html>	


