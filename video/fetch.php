<?php
include('../db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM carte_sims ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE codification LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR statut LIKE "%'.$_POST["search"]["value"].'%" ';
}







if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY codification ';
}
if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
	$image = '';
	if($row["image"] != '')
	{
		$image = '<a href="../upload/'.$row["image"].'" "><img src="../test.jpg" height="30" width="30"> <a/>';
	}
	else
	{
		$image = '';
	}

	if($row["statut"] == "EN SERVICE")
	{
		$statut = '<p style="color:green;">EN SERVICE</p>';
	}

		elseif($row["statut"] == "EN STOCK")
	{
		$statut = '<p style="color:orange;">EN STOCK</p>';

	}
		elseif($row["statut"] == "REFORME")
	{
		$statut = '<p style="color:red;">REFORME</p>';
	}
	else
	{
		$statut = $row["statut"];
	}
	$sub_array = array();
	$sub_array[] = $image;
	$sub_array[] = $row["codification"];
	$sub_array[] = $row["balise"];
	$sub_array[] = $row["sim"];
	$sub_array[] = $row["telephone"];
	$sub_array[] = $row["idport"];
	$sub_array[] = $row["immatriculation"];
	$sub_array[] = $statut;
	$sub_array[] = $row["rfid"];

	$sub_array[] = '<a type="button" name="Modifier" id="'.$row["id"].'" class="btn btn-success btn Modifier"><i class="fa fa-edit"></i> </a>';
	$sub_array[] = '<a type="button" name="Supprimer" id="'.$row["id"].'" class="btn btn-danger btn Supprimer"><i class="fa fa-close"></i> </a>';
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records(),
	"data"				=>	$data
);
echo json_encode($output);
?>
