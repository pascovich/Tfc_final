<?php

include 'config/connect.php';
?>

<?php

if (empty($_SESSION['user'])) {
  header('location:login.php');
}
    
$conne = $db->prepare('SELECT * FROM etudiant WHERE id_etudiant=:idc');
$conne->execute(array(
   'idc' => $_SESSION['user']['id_etudiant']
));  
$ress=$conne->fetchAll(PDO::FETCH_OBJ);


if (isset($_GET['idv'])) {
	$id_vote = $_GET['idv'];

	$pub=$db->query("SELECT * from dashboard WHERE ref_vote=$id_vote ORDER BY voix DESC LIMIT 1");
	// $ress->execute();

	$state=$db->query("SELECT COUNT(*) AS id_etudiant FROM result_vote WHERE ref_vote=$id_vote");
	$percents=$db->query("SELECT COUNT(*) AS id_etudiant FROM result_vote WHERE ref_vote=$id_vote");

	$state1=$db->query("SELECT COUNT(*) AS id_etudiant FROM result_vote where (promotion='G1' OR promotion='G2' OR promotion='G3') AND ref_vote=$id_vote");
	$state2=$db->query("SELECT COUNT(*) AS id_etudiant FROM result_vote where (promotion='L1' OR promotion='L2') AND ref_vote=$id_vote");
	$state3=$db->query("SELECT COUNT(*) AS id_candidat FROM candidat WHERE ref_vote=$id_vote");
	

	$donnee = $db->query("SELECT * FROM dashboard WHERE ref_vote=$id_vote ORDER BY voix DESC");
	

	if (isset($state)) {
		while($eles = $percents->fetch()){
			$nbre=$eles['id_etudiant'];
		}
	}

}
?>



<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title><?php
            if ($_SESSION['user']['nom'] !== array()) {
              $users = $_SESSION['user']['nom'];

              echo "Bienvenue :: $users ";
            } ?>
	</title>
	<style>
		/* .attention{
			background-color: red;
		} */
	</style>
	<?php 
		include('partials/_header.php');
	?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		
</head>
<body>
	<?php include('partials/_animation.php'); ?>

	<?php include('partials/_topbar.php'); ?>

	<?php include('partials/_sidebar.php'); ?>

	<?php include('partials/_navigation.php'); ?>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20">
			<div class="card-box pd-20 height-100-p mb-30">
				<div class="row align-items-center">
				<?php foreach($ress as $connecte):  ?>
					<div class="col-md-4">
						<!-- <img src="vendors/images/banner-img.png" alt="nnn"> -->
						<img src="../media/images/<?=$connecte->photo?>" class="avatar-photo" width="50%" alt="imagee">
					</div>
				<?php endforeach;?>
					<div class="col-md-8">
						<h4 class="font-20 weight-500 mb-10 text-capitalize">
						Welcome camarade <div class="weight-600 font-30 text-blue">
								
								<?php if($_SESSION['user']['nom'] && $_SESSION['user']['postnom']){
									$userss=$_SESSION['user']['nom'];
									$usersss=$_SESSION['user']['postnom'];
									echo($userss .' '.$usersss);
								} ?> 
							</div> etudiant en 
							<?php if($_SESSION['user']['promotion'] && $_SESSION['user']['option']){
									$use=$_SESSION['user']['promotion'];
									$uses=$_SESSION['user']['option'];
									echo($use .'-'. $uses);
								} ?> a ISIG-Goma A/C 2020-2021
						</h4>
						<div class="alert alert-warning"><h5 id="rebour_compte"></h5></div>
						<?php while($pubresult = $pub->fetch()): ?>
							<?php $voix=$pubresult['voix']; 
							 if($voix<=0){
								$percent=0;
							}else{
								$percent=($voix * 100)/$nbre;
							}
								
						?>
						<p class="font-18 max-width-600">Jusque-la le premier est <strong>le candidat N°<?=$pubresult['numero'];?></strong>  dont le nom est <strong><?=$pubresult['nom'];?> <?=$pubresult['postnom'];?> <?=$pubresult['prenom'];?></strong> avec <span class="text-blue"><?=$pubresult['voix'];?></span> voix, soit <span class="text-blue"><?=$percent;?>%</span> ...pour plus de details descendez a la fin de cette page</p>
						<?php endwhile; ?> 
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="progress-data">
								<div id=""></div>
							</div>
							<div class="widget-data">
							<?php while($ele = $state->fetch()): ?>
								<div class="h4 mb-0"><?=$ele['id_etudiant'];?></div>
								<div class="weight-600 font-14">Total electeur</div>
							</div>
							<?php endwhile; ?>
						</div>
					</div>
				</div>
				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="progress-data">
								<div id=""></div>
							</div>
							<div class="widget-data">
							<?php while($ele1 = $state1->fetch()): ?>
								<div class="h4 mb-0"><?=$ele1['id_etudiant'];?></div>
								<div class="weight-600 font-14">Electeur en grade</div>
							<?php endwhile; ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="progress-data">
								<div id=""></div>
							</div>
							<div class="widget-data">
							<?php while($ele2 = $state2->fetch()): ?>
								<div class="h4 mb-0"><?=$ele2['id_etudiant'];?></div>
								<div class="weight-600 font-14">Electeur en license</div>
							<?php endwhile; ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="progress-data">
							<div id=""></div>
								<!-- <div id="chart4"></div> -->
							</div>
							<div class="widget-data">
							<?php while($ele3 = $state3->fetch()): ?>
								<div class="h4 mb-0"><?=$ele3['id_candidat'];?></div>
								<div class="weight-600 font-14">nombre candidats</div>
							<?php endwhile; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<h4 style="text-align: center;">Resultats detaillés de vote</h4>
			<div class="table-responsive">


				
                            


                <table id="result_data" class="data-table table hover multiple-select-row nowrap" >
                    <thead>
                        <tr>
                            <!-- <th class="table-plus datatable-nosort">#</th> -->
                            <th width="10%">NUMERO</th>		
                            <th>NOM</th>
                            <th>POSTNOM</th>
                            <th>PRENOM</th>
							<th width="10%">IMAGE</th>
                            <th>Nbre voix</th>
							<th>buton</th>
                        </tr>
                    </thead> 
					<tbody>
						<?php while($tables=$donnee->fetch()):?>
							<tr>
								<td><?=$tables['numero'];?></td>
								<td><?=$tables['nom'];?></td>
								<td><?=$tables['postnom'];?></td>
								<td><?=$tables['prenom'];?></td>
								<td><img src="../media/images/<?=$tables['photo'];?>" width="50%"></td>
								<td><?=$tables['voix'];?></td>
								<td>bb</td>
							</tr>
						<?php endwhile;?>
					</tbody>
                </table>                      
            </div>
			<!-- <div class="row">
				<div class="col-xl-8 mb-30">
					<div class="card-box height-100-p pd-20">
						<h2 class="h4 mb-20">Activity</h2>
						<div id="chart5"></div>
					</div>
				</div>
				<div class="col-xl-4 mb-30">
					<div class="card-box height-100-p pd-20">
						<h2 class="h4 mb-20">Lead Target</h2>
						<div id="chart6"></div>
					</div>
				</div>
			</div> -->
			<div class="card-box mb-30">
				
			</div>
			<div class="footer-wrap pd-20 mb-20 card-box">
				DeskApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="../admin/vendors/scripts/core.js"></script>
	<script src="../admin/vendors/scripts/script.min.js"></script>
	<script src="../admin/vendors/scripts/process.js"></script>
	<script src="../admin/vendors/scripts/layout-settings.js"></script>
	<script src="../admin/src/plugins/apexcharts/apexcharts.min.js"></script>
	<script src="../admin/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="../admin/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="../admin/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="../admin/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<script src="../admin/vendors/scripts/dashboard.js"></script>
</body>
</html>

<script type="text/javascript">


const texte = document.getElementById('rebour_compte');

function getchrono(){
		const now = new Date().getTime();

		var d = new Date();
		var to = d.getDate()+" "+d.getMonth()+" "+d.getFullYear();
		console.log(to);

		const countdownDate = new Date('05 november 2021').getTime();

		const distanceBase=countdownDate-now;
		const days = Math.floor(distanceBase / (1000*60*60*24));
		// console.log(days);
		const hours = Math.floor((distanceBase % (1000*60*60*24)) / (1000*60*60));
		// console.log(hours);
		const minutes = Math.floor((distanceBase %(1000*60*60)) / (1000*60));

		const secondes = Math.floor((distanceBase %(1000*60)) / 1000);

		//console.log(days, hours, minutes, secondes);

		
		if(days>=0){
			texte.innerText= `attention cette election prendra fin dans ${days}j ${hours}h ${minutes}min ${secondes}sec`;
		}else{
			texte.innerText=`attention cette election a deja pris fin,pour plus des detailles descendez en bas de cette page`;

		}
	}
	
	getchrono();

	const setcountdowninterval=setInterval(() => {

			getchrono();

	}, 1000);



</script>