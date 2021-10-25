<?php

include '../config/connect.php';
?>
<?php

if (empty($_SESSION['user'])) {
  header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etudiant</title>
    <?php 
		include('../partials/_header.php');
	?>
    <!-- <link rel="stylesheet" href="jssss/bootstrap.min.css"> -->
</head>
<body>

<?php include('../partials/_topbar.php'); ?>

<?php include('../partials/_sidebar.php'); ?>

<?php include('../partials/_navigation.php'); ?>
<div class="mobile-menu-overlay"></div>

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Etudiant</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Details elections</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <div class="dropdown">
                        <!-- <div align="right">
					            <button type="button" id="add_etudiant" data-toggle="modal" data-target="#EtudiantModal" class="btn btn-primary btn-lg">Ajouter</button>
				            </div> -->
                     
                        </div>
                    </div>
                </div>
            </div>
            
           
            <!-- multiple select row Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 style="display: inline-block;" class="text-blue h4">details des elections</h4>
                    <a href="print_presence.php" target="_blank" class="btn btn-primary float-right"><i class="fa fa-print"></i></a>
                </div>
                <div class="pb-20">
                    <div class="table-responsive">
                    
                    <table id="details_vote_data" class="data-table table hover multiple-select-row nowrap" >
                        <thead>
                            <tr>
                                <!-- <th class="table-plus datatable-nosort">#</th> -->
                                <!-- <th>#</th> -->
                                <th>Avatar</th>
                                <th>nom</th>
                                <th>postnom</th>
                                <th>prenom</th>
                                <th width="10%">promotion</th>
                                <th>option</th>
                                <th>sexe</th>
                                <th>nom du vote</th>
                                <th width="10%">candidat vote</th>
                                <th>date vote</th>
                            </tr>
                        </thead> 
                    </table>                      
					</div>
				</div>
			</div>
                    
                <!-- </div> -->
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

<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
      <!-- ajout -->
    <script src="bundles/libscripts.bundle.js"></script>    
    <script src="bundles/vendorscripts.bundle.js"></script>
    <!-- end ajout -->
	<script src="vendors/scripts/layout-settings.js"></script>
	<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<!-- buttons for Export datatable -->
	<script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.print.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.flash.min.js"></script>
	<script src="src/plugins/datatables/js/pdfmake.min.js"></script>
	<script src="src/plugins/datatables/js/vfs_fonts.js"></script>
	<!-- Datatable Setting js -->
	<script src="vendors/scripts/datatable-setting.js"></script>

<script>

$(document).ready(function(){
    //     $('#add_etudiant').click(function(){
    //     $('#EtudiantModal').modal('show');
	// 	$('#etudiant_form')[0].reset();
	// 	$('.modal-title').text("Incription de l'etudiant");
	// 	$('#action').val("Add");
	// 	$('#operation').val("Add");
	// 	$('#etudiant_uploaded_image').html('');
	// });
    var dataTable = $('#details_vote_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"fetch_details_vote.php",
			type:"POST"
		},
		"columnDefs":[
			{
				"targets":[0, 8, 9],
				// "targets":[0, 2, 3],
				// "targets":[0, 12, 13],
				// "targets":[0, 7, 8],
				"orderable":false,
			},
		],
        "bDestroy":true

	});
    
});


</script>