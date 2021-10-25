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
		
		$statement = $db->prepare("INSERT INTO vote(designation,date_vote,expired_vote) 
			VALUES (:designation,:date_vote,:expired_vote)");
		$result = $statement->execute(
			array(
				':designation'	=>	$_POST["designation"],
				':date_vote'	=>	$_POST["date_vote"],
				':expired_vote'	=>	$_POST["expired_vote"]
			)
		);
		if(!empty($result))
		{
			echo 'Data Inserted';
		}else{
            echo 'erreur dans insertion';
        }
	}
	if($_POST["operation"] == "Edit")
	{
		
		$statement = $db->prepare(
			"UPDATE vote 
			SET designation = :designation, date_vote = :date_vote, expired_vote=:expired_vote 
			WHERE id_vote = :id_vote
			"
		);
		$result = $statement->execute(
			array(
				':designation'	=>	$_POST["designation"],
				':date_vote'	=>	$_POST["date_vote"],
				':expired_vote'	=>	$_POST["expired_vote"],
				':id_vote'			=>	$_POST["id_vote"]
			)
		);
		if(!empty($result))
		{
			echo 'Data Updated';
		}
	}
}

?>