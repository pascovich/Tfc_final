<?php
include('../config/connect.php');
include('../config/function.php');
if(isset($_POST["id_vote"]))
{
    $id_etudiant=$_POST["id_vote"];
	$output = array();
	$statement = $db->prepare(
		"SELECT * FROM vote 
		WHERE id_vote = '".$_POST["id_vote"]."' 
		LIMIT 1"
	);
    
    // $query2 = $db->query("SELECT * FROM etudiant where id_etudiant=".$id_etudiant);

	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["designation"] = $row["designation"];
		$output["date_vote"] = $row["date_vote"];
		$output["expired_vote"] = $row["expired_vote"];
		
	}
	echo json_encode($output);
}
?>