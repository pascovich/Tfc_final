<?php
include('../config/connect.php');
include('../config/function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM result_vote ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE nom LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR postnom LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR prenom LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR sexe LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR promotion LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR optionn LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR numero_candidat LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR election LIKE "%'.$_POST["search"]["value"].'%" ';
	// $query .= 'OR date_de_vote LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY date_de_vote DESC ';
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
    // $sub_array[] = $row["id_etudiant"];
    $sub_array[] = $image;
    $sub_array[] = $row["nom"];
	$sub_array[] = $row["postnom"];
	$sub_array[] = $row["prenom"];
    $sub_array[] = $row["promotion"];
	$sub_array[] = $row["optionn"];
    $sub_array[] = $row["sexe"];
    $sub_array[] = $row["election"];
	$sub_array[] = $row["numero_candidat"];
	$sub_array[] = $row["date_de_vote"];
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