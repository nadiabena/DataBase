<?php
try{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=weatherapp;charset=utf8', 'root', 'user');
}catch(Exception $e){
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}


if( isset($_GET["ville"]) && isset($_GET["haut"]) && isset($_GET["bas"]) ) {
	$bdd->prepare('INSERT INTO Météo (ville, haut, bas) VALUES (' . $bdd->quote($_GET["ville"]) .', ' . $_GET["haut"] . ', ' . $_GET["bas"] .')')->execute();
}


$resultat = $bdd->query('SELECT * FROM Météo');

$tableDimension2 = [];

while ($donnees = $resultat->fetch()){
	$tableDimension2[$donnees['ville']] = array('haut' => $donnees['haut'], 'bas' => $donnees['bas'] ); //array($donnees['haut'], $donnees['bas'] );
	//echo $donnees['ville'].$donnees['haut'].$donnees['bas']."<br/>";
}

echo "<hr/>";


//Delete a row if this element is checked
if(isset($_GET['checked'])){   //renvoie un tableau des checkbox séléctionné
	print_r($_GET['checked']);

	foreach ($_GET['checked'] as $key => $value) {
		//echo "val: ".$value."<br/	>";
			$bdd->prepare('DELETE FROM Météo WHERE ville='. $bdd->quote($value))->execute();
	}
}

?>




<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Tableau Data base</title>
</head>
<body>
  	<h1>Villes - Température haute et basse</h1>

<form action="index.php" method="get">
	<table border>
			<?php
				foreach ($tableDimension2 as $key => $value) {
					echo "<tr>";
						echo "<td>"."<input type=checkbox name=checked[] value=".$key.">".$key."</td>";
						echo "<td>".$value['haut']."</td>";  //$value[0]
						echo "<td>".$value['bas']."</td>";   //$value[1]
					echo "</tr>";
				}
			?>
	</table>

<!-- Ajoute un formulaire avec 3 champs (ville, haut, bas) permettant d'ajouter d'autres villes -->
<br/><br/><br/>
  <label>Ville: </label>
  <input type="text" name="ville" placeholder="Ville">&nbsp;&nbsp;

  <label>Haut: </label>
  <input type="text" name="haut" placeholder="Temperature haute">&nbsp;&nbsp;

  <label>Bas: </label>
  <input type="text" name="bas" placeholder="Temperature basse">&nbsp;&nbsp;

  <br><br>
  <input type="submit" value="Send">
</form>

<!-- <script src="jquery-2.2.4.js"></script>
<script>
	$(document).ready(function(){
			$('#idVille').is(":checked");
	});

</script> -->

</body>
</html>
