<?php
include('../config/connect.php');
include('../config/function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM profile_candidat ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE NOM LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR POSTNOM LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR PRENOM LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR NOMVOTE LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR SLOGAN LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR PROMOTION LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR OPTIONN LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR NUMVOTE LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY CODE DESC ';
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
	if($row["IMAGE"] != '')
	{
		$image = '<img src="../media/images/'.$row["IMAGE"].'" class="img-thumbnail" width="30" />';
	}
	else
	{
		$image = '';
	}
	$sub_array = array();
	$sub_array[] = $row["CODE"];
	$sub_array[] = $image;
	$sub_array[] = $row["NOM"];
	$sub_array[] = $row["POSTNOM"];
	$sub_array[] = $row["PRENOM"];
	// $sub_array[] = $row["sexe"];
    $sub_array[] = $row["PROMOTION"];
	$sub_array[] = $row["OPTIONN"];
	$sub_array[] = $row["NOMVOTE"];
	$sub_array[] = $row["NUMVOTE"];
	$sub_array[] = $row["SLOGAN"];
	
	$sub_array[] = '<button type="button" name="update" id="'.$row["CODE"].'" class="btn btn-warning btn-xs update"><i class="fa fa-edit"></i></button>';
	$sub_array[] = '<button type="button" name="delete" id="'.$row["CODE"].'" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></button>';
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