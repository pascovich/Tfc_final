<?php
include('../config/connect.php');
include('../config/function.php');
if(isset($_POST["id_vote"]))
{
    $id_etudiant=$_POST["id_vote"];
	$output = array();
	$statement = $db->prepare(
		"SELECT * FROM candidat 
		WHERE ref_vote = '".$_POST["id_vote"]."' 
		LIMIT 1"
	);
    
    // $query2 = $db->query("SELECT * FROM etudiant where id_etudiant=".$id_etudiant);

	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["numero"] = $row["numero"];
		$output["slogan"] = $row["slogan"];
		$output["id_candidat"] = $row["id_candidat"];
		$output["ref_vote"] = $row["ref_vote"];
		// if($row["photo"] != '')
		// {
		// 	$output['photo'] = '<img src="../media/images/'.$row["photo"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image" value="'.$row["photo"].'" />';
		// }
		// else
		// {
		// 	$output['photo'] = '<input type="hidden" name="hidden_user_image" value="" />';
		// }
	}
	echo json_encode($output);
}
?>