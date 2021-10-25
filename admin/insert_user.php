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
		$image = '';
		if($_FILES["photo"]["name"] != '')
		{
			$image = upload_image();
		}
		$statement = $db->prepare("INSERT INTO users(username,gmail,password,photo) 
			VALUES (:username,:gmail,:password,:photo)");
		$result = $statement->execute(
			array(
				':username'	=>	$_POST["username"],
				':gmail'	=>	$_POST["gmail"],
				':password'	=>	$_POST["password"],
				':photo'		=>	$image
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
			"UPDATE users 
			SET username = :username, gmail = :gmail, password = :password,photo=:photo  
			WHERE id_user = :id_user
			"
		);
		$result = $statement->execute(
			array(
				':username'	=>	$_POST["username"],
				':gmail'	=>	$_POST["gmail"],
				':password'	=>	$_POST["password"],
				':photo'		=>	$image,
				':id_user'			=>	$_POST["id_user"]
			)
		);
		if(!empty($result))
		{
			echo 'Data Updated';
		}
	}
}

?>