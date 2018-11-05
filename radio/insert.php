<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Ajouter")
	{
		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			$image = upload_image();
		}
		$statement = $connection->prepare("
			INSERT INTO radio (numero_appel, codification, numero_serie, type, statut, modele, image)
			VALUES (:numero_appel, :codification, :numero_serie, :type, :statut, :modele, :image,)
		");
		$result = $statement->execute(
			array(
				':numero_appel'	=>	$_POST["numero_appel"],
				':codification'	=>	$_POST["codification"],
				':numero_serie'	=>	$_POST["numero_serie"],
				':type'	=>	$_POST["type"],
				':statut'	=>	$_POST["statut"],
				':modele'	=>	$_POST["modele"],


				':image'		=>	$image
			)
		);
		if(!empty($result))
		{
			echo 'Données Ajoutées';
		}
	}
	if($_POST["operation"] == "Modifier")
	{
		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			$image = upload_image();
		}
		else
		{
			$image = '';
		}

		$statement = $connection->prepare(
			"UPDATE radio
			SET numero_appel = :numero_appel, codification = :codification, numero_serie = :numero_serie, type = :type, statut = :statut, modele = :modele, image = :image
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':numero_appel'	=>	$_POST["numero_appel"],
				':codification'	=>	$_POST["codification"],
				':numero_serie'	=>	$_POST["numero_serie"],
				':type'	=>	$_POST["type"],
				':statut'	=>	$_POST["statut"],
				':modele'	=>	$_POST["modele"],
				':image'		=>	$image,
				':id'			=>	$_POST["user_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Données Sauvegardée';
		}
	}
}

?>
