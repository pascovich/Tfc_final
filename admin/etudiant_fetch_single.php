<?php
include('../config/connect.php');
include('../config/function.php');
if(isset($_POST["id_etudiant"]))
{
    $id_etudiant=$_POST["id_etudiant"];
	$output = array();
	$statement = $db->prepare(
		"SELECT * FROM etudiant 
		WHERE id_etudiant = '".$_POST["id_etudiant"]."' 
		LIMIT 1"
	);
    
    // $query2 = $db->query("SELECT * FROM etudiant where id_etudiant=".$id_etudiant);

	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["nom"] = $row["nom"];
		$output["postnom"] = $row["postnom"];
		$output["prenom"] = $row["prenom"];
        $output["sexe"] = $row["sexe"];
		$output["promotion"] = $row["promotion"];
        $output["optionn"] = $row["optionn"];
		$output["naissance"] = $row["naissance"];
        $output["lieu"] = $row["lieu"];
        $output["telephone"] = $row["telephone"];
		if($row["photo"] != '')
		{
			$output['photo'] = '<img src="../media/images/'.$row["photo"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image" value="'.$row["photo"].'" />';
		}
		else
		{
			$output['photo'] = '<input type="hidden" name="hidden_user_image" value="" />';
		}
	}
	echo json_encode($output);
}
?>