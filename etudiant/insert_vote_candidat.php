<?php
include('config/connect.php');
include('config/function.php');

if(isset($_POST["numero_candidat"]))
{
	
	
	$state = $db->prepare(
		"SELECT * FROM details_vote 
		WHERE ref_etudiant = '".$_SESSION['user']['id_etudiant']."' AND ref_vote = '".$_POST["ref_vote"]."' 
		LIMIT 1"
	);
    

	$state->execute();
	$result = $state->fetchAll();
	$existe=$state->rowCount();
	
	if($existe >=1){
		echo 'desole cher '.$_SESSION['user']['nom'].' '.$_SESSION['user']['postnom'].' '.$_SESSION['user']['prenom'].' vous avez deja voté pour cette election,choisissez une autre election disponible SVP!!!';
	}else{
		$statement = $db->prepare(
			"INSERT INTO details_vote(numero_candidat,ref_etudiant,ref_vote,date_de_vote) VALUES(:numero_candidat,:ref_etudiant,:ref_vote,now())"
		);
		$result = $statement->execute(
			array(
				':numero_candidat'	=>	$_POST["numero_candidat"],
				':ref_etudiant'	=>	$_SESSION['user']['id_etudiant'],
				':ref_vote'	=>	$_POST["ref_vote"]
			)
		);
		$statement1 = $db->prepare("UPDATE candidat SET voix=voix+1 WHERE numero='".$_POST['numero_candidat']."'");
		$statement1->execute();
		if(!empty($result))
		{
			echo 'wowwww!!! vous avez vote le candidat numero '.$_POST["numero_candidat"].'';
		}else{
			echo 'erreur dans l election';
		}
	}
	
}


?>


