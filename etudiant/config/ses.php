<?php 
// require '_header.php';
if(class_exists('USER')){

}else{
	class USER{
		private $db;
	
		public function __construct($db){
	
			if (!isset($_SESSION)) {
		session_start();
				}
	
			if (!isset($_SESSION['user'])) {
	
				$_SESSION['user']=array();
				
			}
				
	
	$this->DB=$db;
	
	}
	
	
	public function con($user_id){
	
		$_SESSION['user'][$user_id]= $user_id;	
		$connexion=$this->DB->prepare('SELECT * FROM etudiant WHERE id_etudiant=:id_etudiant');
	 $connexion->execute(array(
	'id_etudiant' => $user_id
	));
	$con=$connexion->fetchAll(PDO::FETCH_OBJ);
	foreach ($con as $user ) {
	
		$_SESSION['user']['id_etudiant']= $user->id_etudiant;
		// $_SESSION['user']['id_user']= $user->id;
		$_SESSION['user']['nom']= $user->nom;
		$_SESSION['user']['password']= $user->password;
		$_SESSION['user']['postnom']= $user->postnom;
		$_SESSION['user']['prenom']= $user->prenom;
		$_SESSION['user']['photo']= $user->photo;
		$_SESSION['user']['promotion']= $user->promotion;
		$_SESSION['user']['option']= $user->optionn;
		
	
	}
	
	
	return true;
	
	
	}
	
	 public function decon($user_id){
		unset($_SESSION['user']);
		session_destroy();
		header('location:login.php');
	
	}
	
	
	}
}

 


 ?>