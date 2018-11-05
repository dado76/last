<?php

include('../db.php');
include("function.php");

if(isset($_POST["user_id"]))
{
	$image = get_image_name($_POST["user_id"]);
	if($image != '')
	{
		unlink("upload/" . $image);
	}
	$statement = $connection->prepare(
		"delete FROM bom WHERE id = :id"
	);
	$result = $statement->execute(
		array(
			':id'	=>	$_POST["user_id"]
		)
	);

	if(!empty($result))
	{
		echo 'Données supprimer';
	}
}



?>
