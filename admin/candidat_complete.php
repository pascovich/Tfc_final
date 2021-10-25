<?php
include('../config/connect.php');
include('../config/function.php');
if(isset($_POST["ref_etudiant"]))
{
    $ref_etudiant=$_POST["ref_etudiant"];
	$output = array();
	$statement = $db->prepare(
		"SELECT * FROM etudiant 
		WHERE id_etudiant = ".$ref_etudiant."
		LIMIT 1"
	);
    
    // $query2 = $db->query("SELECT * FROM etudiant where id_etudiant=".$id_etudiant);

	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["id_etudiant"] = $row["id_etudiant"];
		$output["nom"] = $row["nom"];
		$output["postnom"] = $row["postnom"];
		$output["prenom"] = $row["prenom"];
		// $output["photo"] = $row["photo"];
		// $output["optionn"] = $row["option"];
		$output["promotion"] = $row["promotion"];
        if($row["photo"] != '')
		{
			$output['photo'] = '<img src="../media/images/'.$row["photo"].'" class="img-thumbnail" width="100%" height="100%" /><input type="hidden" name="hidden_user_image" value="'.$row["photo"].'" />';
		}
		else
		{
			$output['photo'] = '<input type="hidden" name="hidden_user_image" value="" />';
		}
	}
	echo json_encode($output);
}
?>