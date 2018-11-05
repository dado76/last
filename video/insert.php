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
			INSERT INTO carte_sims (codification, balise, sim, telephone, idport, immatriculation, statut, rfid, image) 
			VALUES (:codification, :balise, :sim, :telephone, :idport, :immatriculation, :statut, :rfid, :image,)
		");
		$result = $statement->execute(
			array(
				':codification'	=>	$_POST["codification"],
				':balise'	=>	$_POST["balise"],
				':sim'	=>	$_POST["sim"],
				':telephone'	=>	$_POST["telephone"],
				':idport'	=>	$_POST["idport"],
				':immatriculation'	=>	$_POST["immatriculation"],
	     		':statut'	=>	$_POST["statut"],
				':rfid'	=>	$_POST["rfid"],
														
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
			"UPDATE carte_sims 
			SET codification = :codification, balise = :balise, sim = :sim, telephone = :telephone, idport = :idport, immatriculation = :immatriculation, statut = :statut, rfid = :rfid, image = :image  
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':codification'	=>	$_POST["codification"],
				':balise'	=>	$_POST["balise"],
				':sim'	=>	$_POST["sim"],
				':telephone'	=>	$_POST["telephone"],
				':idport'	=>	$_POST["idport"],
     			':immatriculation'	=>	$_POST["immatriculation"],
				':statut'	=>	$_POST["statut"],
				':rfid'	=>	$_POST["rfid"],	
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