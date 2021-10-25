<?php
include('config/connect.php');
include('config/function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM vote ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE nom LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR postnom LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR prenom LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR sexe LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR promotion LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR optionn LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR lieu LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR naissance LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id_etudiant DESC ';
}
if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $db->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
	$image = '';
	if($row["photo"] != '')
	{
		$image = '<img src="../media/images/'.$row["photo"].'" class="img-thumbnail" width="30" />';
	}
	else
	{
		$image = '';
	}
	$sub_array = array();
	$sub_array[] = $row["id_etudiant"];
	$sub_array[] = $row["id_login"];
	$sub_array[] = $image;
	$sub_array[] = $row["nom"];
	$sub_array[] = $row["postnom"];
	$sub_array[] = $row["prenom"];
	$sub_array[] = $row["sexe"];
    $sub_array[] = $row["promotion"];
	$sub_array[] = $row["optionn"];
	$sub_array[] = $row["lieu"];
	$sub_array[] = $row["naissance"];
	
	$sub_array[] = '<button type="button" name="update" id="'.$row["id_etudiant"].'" class="btn btn-warning btn-xs update"><i class="fa fa-edit"></button>';
	$sub_array[] = '<button type="button" name="delete" id="'.$row["id_etudiant"].'" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></button>';
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