<?php
include('../db.php');
include('function.php');
if(isset($_POST["user_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM radio
		WHERE id = '".$_POST["user_id"]."'
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["numero_appel"] = $row["numero_appel"];
		$output["codification"] = $row["codification"];
		$output["numero_serie"] = $row["numero_serie"];
		$output["type"] = $row["type"];
		$output["statut"] = $row["statut"];
		$output["modele"] = $row["modele"];
		if($row["image"] != '')
		{
			$output['user_image'] = '<img src="../upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image" value="'.$row["image"].'" />';

		}
		else
		{
			$output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';
		}
	}
	echo json_encode($output);
}
?>
