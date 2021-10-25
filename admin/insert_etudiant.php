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
		$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$id_login = substr(str_shuffle($set), 0, 15);
		$image = '';
		if($_FILES["photo"]["name"] != '')
		{
			$image = upload_image();
		}
		$statement = $db->prepare("INSERT INTO etudiant(id_login,nom,postnom,prenom,sexe,promotion,optionn,lieu,naissance,photo,password,telephone) 
			VALUES (:id_login,:nom,:postnom,:prenom,:sexe,:promotion,:optionn,:lieu,:naissance,:photo,:password,:telephone)");
		$result = $statement->execute(
			array(
				':id_login'	=>	$id_login,
				':nom'	=>	$_POST["nom"],
				':postnom'	=>	$_POST["postnom"],
				':prenom'	=>	$_POST["prenom"],
				':sexe'	=>	$_POST["sexe"],
				':promotion'	=>	$_POST["promotion"],
				':optionn'	=>	$_POST["optionn"],
				':lieu'	=>	$_POST["lieu"],
				':naissance'	=>	$_POST["naissance"],
				':photo'		=>	$image,
				':password'	=>	$_POST["password"],
				':telephone'	=>	$_POST["telephone"],
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
		$image = '';
		if($_FILES["photo"]["name"] != '')
		{
			$image = upload_image();
		}
		else
		{
			$image = $_POST["hidden_user_image"];
		}
		$statement = $db->prepare(
			"UPDATE etudiant 
			SET nom = :nom, postnom = :postnom, prenom = :prenom, sexe= :sexe, promotion=:promotion,optionn=:optionn,naissance=:naissance,lieu=:lieu,photo=:photo,password=:password,telephone=:telephone  
			WHERE id_etudiant = :id_etudiant
			"
		);
		$result = $statement->execute(
			array(
				':nom'	=>	$_POST["nom"],
				':postnom'	=>	$_POST["postnom"],
				':prenom'	=>	$_POST["prenom"],
				':sexe'	=>	$_POST["sexe"],
				':promotion'	=>	$_POST["promotion"],
				':optionn'	=>	$_POST["optionn"],
				':naissance'	=>	$_POST["naissance"],
				':lieu'	=>	$_POST["lieu"],
				':photo'		=>	$image,
				':password'			=>	$_POST["password"],
				':telephone'			=>	$_POST["telephone"],
				':id_etudiant'			=>	$_POST["id_etudiant"]
			)
		);
		if(!empty($result))
		{
			echo 'Data Updated';
		}
	}
}

?>