<?php
include('config/connect.php');
include('config/function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM profile_candidat ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE NOM LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR POSTNOM LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR PRENOM LIKE "%'.$_POST["search"]["value"].'%" ';
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
	$sub_array[] = $row["NOM"];
	$sub_array[] = $row["POSTNOM"];
	$sub_array[] = $row["PRENOM"];
	$sub_array[] = $row["NUMVOTE"];
	// $sub_array[] = $row["NOMVOTE"];
	$sub_array[] = $image;
	
	// $sub_array[] = '<a href="passation_vote.php?idv="'.$row["id_vote"].'"" name="participer" id="'.$row["id_vote"].'" class="btn btn-warning btn-xs participer">participer</a>';
	$sub_array[] = '<button type="button" name="voter" id="'.$row["NUMVOTE"].'" class="btn btn-primary btn-xs voter"><i class="fa fa-pencil"></button>';
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