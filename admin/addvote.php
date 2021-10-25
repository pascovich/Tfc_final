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
    <title>Vote</title>
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
                        <div align="right">
					            <button type="button" id="add_vote" data-toggle="modal" data-target="#VoteModal" class="btn btn-primary btn-lg">Ajouter</button>
				            </div>
                     
                        </div>
                    </div>
                </div>
            </div>
            
           
            <!-- multiple select row Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Liste des votes organisés</h4>
                </div>
                <div class="pb-20">
                    <div class="table-responsive">
                    
                    <table id="vote_data" class="data-table table hover multiple-select-row nowrap" >
                        <thead>
                            <tr>
                                <!-- <th class="table-plus datatable-nosort">#</th> -->
                                <th>#</th>
                                <th>Designation</th>
                                <th>Date du vote</th>
                                <th>Expired vote</th>
                                <th>Modifier</th>
                                <th>Supprimer</th>
                            </tr>
                        </thead> 
                    </table>                      
					</div>
				</div>
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

<div class="modal fade bs-example-modal-lg" id="VoteModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-centered">
					<div class="modal-content">
                    <form action="" method="POST" id="vote_form" enctype="multipart/form-data" autocomplete="on">

						<div class="modal-header">
							<h4 class="modal-title" id="myLargeModalLabel">Informations du votet</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
                            <div class="">
                                    Designation
                                    <input type="text" class="form-control" name="designation" id="designation" value="" placeholder="Entrer la designation du vote">
                                    <br>
                                
                                    Date du vote
                                    <input type="date" class="form-control" name="date_vote" id="date_vote" value="" placeholder="Entrer la date du vote">
									<br>
									Date expired vote
                                    <input type="date" class="form-control" name="expired_vote" id="expired_vote" value="" placeholder="Entrer la date d'expiration de vote">
                                
                                
                            </div>
                            

						</div>
						<div class="modal-footer">
                            <input type="hidden" name="id_vote" id="id_vote" />
                            <input type="hidden" name="operation" id="operation" />
                            <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </form>  
					</div>
				</div>
</div>



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
        $('#add_vote').click(function(){
        $('#VoteModal').modal('show');
		$('#vote_form')[0].reset();
		$('.modal-title').text("organisation du vote");
		$('#action').val("Add");
		$('#operation').val("Add");
	});
    var dataTable = $('#vote_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"fetch_vote.php",
			type:"POST"
		},
		"columnDefs":[
			{
				"targets":[0, 3, 4],
				// "targets":[0, 8, 9],
				"orderable":false,
			},
		],
        "bDestroy":true

	});
    $(document).on('submit', '#vote_form', function(event){
        event.preventDefault();
		var designation = $('#designation').val();
		var date_vote = $('#date_vote').val();
		var expired_vote = $('#expired_vote').val();
			
		if(designation != '' && date_vote !='' && expired_vote !='')
		{
			$.ajax({
				url:"insert_vote.php",
				method:'POST',
				data:new FormData(this),
                contentType:false,
				processData:false,
				success:function(data)
				{
                    
                        alert(data);
                        $('#vote_form')[0].reset();
                        $('#VoteModal').modal('hide');
					    dataTable.ajax.reload();
                    	
				}
			});
		}
		else
		{
                       
			alert("Both Fields are Required");
            // $('#VoteModal').modal('hide');
		}
	});
    $(document).on('click', '.update', function(){
		var id_vote = $(this).attr("id");
		$.ajax({
			url:"vote_fetch_single.php",
			method:"POST",
			data:{id_vote:id_vote},
			dataType:"json",
			success:function(data)
			{
				$('#VoteModal').modal('show');
				$('#designation').val(data.designation);
				$('#date_vote').val(data.date_vote);
				$('#expired_vote').val(data.expired_vote);
				$('.modal-title').text("Editer les infos concernant ce vote");
				$('#id_vote').val(id_vote);
				$('#action').val("Edit");
				$('#operation').val("Edit");
			}
		})
	});
    $(document).on('click', '.delete', function(){
		var id_vote = $(this).attr("id");
		if(confirm("Es-tu sure de vouloir supprimer ce vote?"))
		{
			$.ajax({
				url:"vote_delete.php",
				method:"POST",
				data:{id_vote:id_vote},
				success:function(data)
				{
					alert(data);
					dataTable.ajax.reload();
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