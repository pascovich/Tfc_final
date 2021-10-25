<?php
include '../config/connect.php';
include '../config/function.php';

if(isset($_POST["id_vote"]))
{
	
	$statement = $db->prepare(
		"DELETE FROM vote WHERE id_vote = :id_vote"
	);
	$result = $statement->execute(
		array(
			':id_vote'	=>	$_POST["id_vote"]
		)
	);
	
	if(!empty($result))
	{
		echo 'Data Deleted';
	}
}





// if(isset($_GET['del'])){
//     $id_etudiant=$_GET['del'];

//     $image = get_image_name($id_etudiant);
// 	if($image != '')
// 	{
// 		unlink("../media/images/" . $image);
// 	}
// 	$statement = $db->prepare(
// 		"DELETE FROM etudiant WHERE id_etudiant = :id_etudiant"
// 	);
// 	$result = $statement->execute(
// 		array(
// 			':id_etudiant'	=>	$id_etudiant
// 		)
// 	);
	
// 	if(!empty($result))
// 	{
// 		echo 'Data Deleted';
// 	}


//     // $delete=$db->prepare("DELETE FROM etudiant where id_etudiant=:id_etudiant");
//     // $delete->execute(array(
//     //     'id_etudiant'=>$id_etudiant
//     // ));
//     header('Location:etudiant.php');
// }


?>

