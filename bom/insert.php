<?php
include('../db.php');
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
			INSERT INTO bom (codification, immatriculation, secteur, cubage,  ptac, remplace, marque_lc, statut, image)
			VALUES (:codification, :immatriculation, :secteur, :cubage, :ptac, :remplace, :marque_lc, :statut, :image)
		");
		$result = $statement->execute(
			array(
				':codification'	=>	$_POST["codification"],
				':immatriculation'	=>	$_POST["immatriculation"],
				':secteur'	=>	$_POST["secteur"],
				':cubage'	=>	$_POST["cubage"],

				':ptac'	=>	$_POST["ptac"],
						':remplace'	=>	$_POST["remplace"],
	     		':marque_lc'	=>	$_POST["marque_lc"],
				':statut'	=>	$_POST["statut"],

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
			"UPDATE bom
			SET codification = :codification, immatriculation = :immatriculation, secteur = :secteur, cubage = :cubage, remplace = :remplace, ptac = :ptac, marque_lc = :marque_lc, statut = :statut, image = :image
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':codification'	=>	$_POST["codification"],
				':immatriculation'	=>	$_POST["immatriculation"],
				':secteur'	=>	$_POST["secteur"],
				':cubage'	=>	$_POST["cubage"],
				':remplace'	=>	$_POST["remplace"],
				':ptac'	=>	$_POST["ptac"],
					':marque_lc'	=>	$_POST["marque_lc"],
				':statut'	=>	$_POST["statut"],

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
