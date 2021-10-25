<?php
include('../config/connect.php');
include('../config/function.php');

// extract($_POST);

// 	$query=$db->prepare("INSERT INTO etudiant(nom,postnom,prenom,promotion,option,lieu,naissance) VALUES(:nom,:postnom,:prenom,:promotion,:option,:lieu,:naissance) ");
// 	$query->execute(array(
// 		':nom'	=>	$_POST["nom"],
// 		':postnom'	=>	$_POST["postnom"],
// 		':prenom'	=>	$_POST["prenom"],
// 		':promotion'	=>	$_POST["promotion"],
// 		':option'	=>	$_POST["option"],
// 		':lieu'	=>	$_POST["lieu"],
// 		':naissance'	=>	$_POST["naissance"],
// 	));
	

if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		// $image = '';
		// if($_FILES["photo"]["name"] != '')
		// {
		// 	$image = upload_image();
		// }
		$ref_etudiant=$_POST["ref_etudiant"];
		$statement = $db->prepare("SELECT * FROM candidat WHERE ref_etudiant='$ref_etudiant'");
		// $out = $statement->execute(
		// 	array(
		// 		':ref_etudiant'	=>	$_POST["ref_etudiant"]
		// 	)
		// );
		$existe_deja=$statement->fetchAll();

		if(count($existe_deja) >=1){
			echo'ce candidat existe deja';
		}
		else{
			$statement = $db->prepare("INSERT INTO candidat(ref_etudiant,numero,slogan,ref_vote) 
			VALUES (:ref_etudiant,:numero,:slogan,:ref_vote)");
			$result = $statement->execute(
				array(
					':ref_etudiant'	=>	$_POST["ref_etudiant"],
					':numero'	=>	$_POST["numero"],
					':slogan'	=>	$_POST["slogan"],
					':ref_vote'	=>	$_POST["ref_vote"]
				)
			);
			if(!empty($result))
			{
				echo 'Data Inserted';
			}else{
				echo 'erreur dans insertion';
			}
		}
		
	}
	if($_POST["operation"] == "Edit")
	{
		// $image = '';
		// if($_FILES["photo"]["name"] != '')
		// {
		// 	$image = upload_image();
		// }
		// else
		// {
		// 	$image = $_POST["hidden_user_image"];
		// }
		$statement = $db->prepare(
			"UPDATE candidat 
			SET ref_etudiant = :ref_etudiant, numero = :numero, slogan = :slogan, ref_vote=:ref_vote  
			WHERE id_candidat = :id_candidat
			"
		);
		$result = $statement->execute(
			array(
				':ref_etudiant'	=>	$_POST["ref_etudiant"],
				':numero'	=>	$_POST["numero"],
				':slogan'	=>	$_POST["slogan"],
				':ref_vote'	=>	$_POST["ref_vote"],
				':id_candidat'	=>	$_POST["id_candidat"]
			)
		);
		if(!empty($result))
		{
			echo 'Data Updated';
		}
	}
}

?>