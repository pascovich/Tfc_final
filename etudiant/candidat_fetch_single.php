<?php
include('config/connect.php');
include('config/function.php');
if(isset($_POST["id_candidat"]))
{
    $id_etudiant=$_POST["id_candidat"];
	$output = array();
	$statement = $db->prepare(
		"SELECT * FROM profile_candidat 
		WHERE CODE = '".$_POST["id_candidat"]."' 
		LIMIT 1"
	);
    
    // $query2 = $db->query("SELECT * FROM etudiant where id_etudiant=".$id_etudiant);

	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["CODE"] = $row["CODE"];
		$output["NOM"] = $row["NOM"];
		$output["POSTNOM"] = $row["POSTNOM"];
		$output["PRENOM"] = $row["PRENOM"];
		$output["NUMVOTE"] = $row["NUMVOTE"];
		$output["SLOGAN"] = $row["SLOGAN"];
		$output["NOMVOTE"] = $row["NOMVOTE"];
		$output["OPTION"] = $row["OPTIONN"];
		$output["PROMOTION"] = $row["PROMOTION"];
		if($row["IMAGE"] != '')
		{
			$output['IMAGE'] = '<img src="../media/images/'.$row["IMAGE"].'" class="img-thumbnail" width="50%" height="35" /><input type="hidden" name="hidden_user_image" value="'.$row["IMAGE"].'" />';
		}
		else
		{
			$output['IMAGE'] = '<input type="hidden" name="hidden_user_image" value="" />';
		}
	}
	echo json_encode($output);
}
?>