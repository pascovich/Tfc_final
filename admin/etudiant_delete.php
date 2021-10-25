<?php
include '../config/connect.php';
include '../config/function.php';

if(isset($_POST["id_etudiant"]))
{
	$image = get_image_name($_POST["id_etudiant"]);
	if($image != '')
	{
		unlink("../media/images/" . $image);
	}
	$statement = $db->prepare(
		"DELETE FROM etudiant WHERE id_etudiant = :id_etudiant"
	);
	$result = $statement->execute(
		array(
			':id_etudiant'	=>	$_POST["id_etudiant"]
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

