<?php

include 'config/connect.php';
?>
<?php

if (empty($_SESSION['user'])) {
  header('location:login.php');
}


if (isset($_GET['idv'])) {
	$id_vote=$_GET['idv'];
	$req= $db->prepare("SELECT * FROM profile_candidat WHERE ID_VOTE=:ID_VOTE");
	$req->execute(
		array(
			':ID_VOTE' => $id_vote
		)
		);
	$can=$req->fetchAll();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote</title>
    <?php 
		include('partials/_header.php');
	?>
    <!-- <link rel="stylesheet" href="jssss/bootstrap.min.css"> -->
</head>
<body>

<?php include('partials/_topbar.php'); ?>

<?php include('partials/_sidebar.php'); ?>

<?php include('partials/_navigation.php'); ?>
<div class="mobile-menu-overlay"></div>

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Vote</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Vote</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <div class="dropdown">
                        <!-- <div align="right">
					            <button type="button" id="add_vote" data-toggle="modal" data-target="#VoteModal" class="btn btn-primary btn-lg">Ajouter</button>
				            </div> -->
                     
                        </div>
                    </div>
                </div>
            </div>
            <!-- multiple select row Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Passation du vote</h4>
                </div>
                <form action="" method="POST" id="vote_form" enctype="multipart/form-data" autocomplete="on">

						<div class="modal-body">
						<?php foreach($can as $ca):?>
                            
                             <input type="hidden" name="ref_vote" id="ref_vote" value="<?=$ca['ID_VOTE'];?>" class="form-control">
						<?php endforeach;?>
                           <!-- <input type="text" name="ref_etudiant" id="ref_etudiant" class="form-control">
                            <input type="text" name="ref_candidat" id="ref_candidat" class="form-control"> -->
                            <div class="pb-20">
                            <div class="table-responsive">
                            
                            <table id="vote_data_modal" class="data-table table hover multiple-select-row nowrap" >
                                <thead>
                                    <tr>
                                        <!-- <th class="table-plus datatable-nosort">#</th> -->
                                        <th>CODE</th>
                                        <th>NOM</th>
                                        <th>POSTNOM</th>
                                        <th>PRENOM</th>
                                        <th>NUMERO CANDIDAT</th>
										<!-- <th>NOM VOTE</th> -->
                                        <th width="10%">IMAGE</th>
                                        <th>voter</th>
                                    </tr>
                                </thead> 
								<tbody>
								<?php foreach($can as $cans): ?>
									<tr>
										<td><?=$cans['CODE'];?></td>
										<td><?=$cans['NOM'];?></td>
										<td><?=$cans['POSTNOM'];?></td>
										<td><?=$cans['PRENOM'];?></td>
										<td><?=$cans['NUMVOTE'];?></td>
										<td><img width="50%" src="../media/images/<?=$cans['IMAGE'];?>"></td>
										<td><button class="btn btn-warning voter" id="<?=$cans['NUMVOTE'];?>"><i class="fa fa-pencil"></i></button></td>
									</tr>
								<?php endforeach; ?>
								</tbody>
                            </table>                      
                            </div>
				</div>
						</div>
						
                      </form> 
			</div>
                    
                </div>
            </div>
            <!-- multiple select row Datatable End -->
           
            
            
        </div>
        <div class="footer-wrap pd-20 mb-20 card-box">
            VoteApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Kaluzipascovich@gmail.com</a>
        </div>
    </div>
</div>



</body>
</html>

<!-- js -->

<script src="../admin/vendors/scripts/core.js"></script>
	<script src="../admin/vendors/scripts/script.min.js"></script>
	<script src="../admin/vendors/scripts/process.js"></script>
      <!-- ajout -->
    <script src="../admin/bundles/libscripts.bundle.js"></script>    
    <script src="../admin/bundles/vendorscripts.bundle.js"></script>
    <!-- end ajout -->
	<script src="../admin/vendors/scripts/layout-settings.js"></script>
	<script src="../admin/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="../admin/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="../admin/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="../admin/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<!-- buttons for Export datatable -->
	<script src="../admin/src/plugins/datatables/js/dataTables.buttons.min.js"></script>
	<script src="../admin/src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
	<script src="../admin/src/plugins/datatables/js/buttons.print.min.js"></script>
	<script src="../admin/src/plugins/datatables/js/buttons.html5.min.js"></script>
	<script src="../admin/src/plugins/datatables/js/buttons.flash.min.js"></script>
	<script src="../admin/src/plugins/datatables/js/pdfmake.min.js"></script>
	<script src="../admin/src/plugins/datatables/js/vfs_fonts.js"></script>
	<!-- Datatable Setting js -->
	<script src="../admin/vendors/scripts/datatable-setting.js"></script>

<script>

$(document).ready(function(){
  
   
    $(document).on('click', '.voter', function(){
		var numero_candidat = $(this).attr("id");
		var ref_vote = $('#ref_vote').val();
		if(confirm("Es-tu sure de vouloir voter ce candidat numero " +numero_candidat+ "?"))
		{
			$.ajax({
				url:"insert_vote_candidat.php",
				method:"POST",
				data:{numero_candidat:numero_candidat,ref_vote:ref_vote},
				success:function(data)
				{
					alert(data);
					// dataTable.ajax.reload();
                    // $('#ElectionModal').modal('hide');

				}
			});
		}
		else
		{
			return false;	
		}
	});
   
});


</script>