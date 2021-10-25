<?php include('../config/connect.php'); 
     include('../config/function.php');
    extract($_POST);
    $image = '';
		if($_FILES["photo"]["name"] != '')
		{
			$image = upload_image();
		}
		else
		{
			$image = $_POST["hidden_user_image"];
		}
    $id_etudiant=$_POST['id_etudiant'];
	$query=$db->prepare("UPDATE etudiant SET nom=:nom,postnom=:postnom,prenom=:prenom,promotion=:promotion,option=:option,naissance=:naissance,lieu=:lieu,photo=:photo WHERE id_etudiant=:id_etudiant ");
	$query->execute(array(
		':nom' =>$_POST['nom'],
		':postnom' => $_POST['postnom'],
        ':prenom' =>$_POST['prenom'],
		':promotion' => $_POST['promotion'],
		':option' => $_POST['option'],
		':naissance' => $_POST['naissance'],
		':lieu' => $_POST['lieu'],
		':photo' => $image,
        ':id_etudiant'=> $id_etudiant		
	));
    if ($query) {
        header('Location:etudiant.php');
    }
?>