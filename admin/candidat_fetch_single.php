<?php
include('../config/connect.php');
include('../config/function.php');
if(isset($_POST["id_candidat"]))
{
    $id_etudiant=$_POST["id_candidat"];
	$output = array();
	$statement = $db->prepare(
		"SELECT * FROM candidat 
		WHERE id_candidat = '".$_POST["id_candidat"]."' 
		LIMIT 1"
	);
    
    // $query2 = $db->query("SELECT * FROM etudiant where id_etudiant=".$id_etudiant);

	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["ref_etudiant"] = $row["ref_etudiant"];
		$output["numero"] = $row["numero"];
		$output["slogan"] = $row["slogan"];
		$output["ref_vote"] = $row["ref_vote"];
	}
	echo json_encode($output);
}
?>