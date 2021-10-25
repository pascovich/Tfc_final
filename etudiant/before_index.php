<?php

include 'config/connect.php';
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
                                <li class="breadcrumb-item active" aria-current="page">Vote dashboard</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- <div class="col-md-6 col-sm-12 text-right">
                        <div class="dropdown">
                        <div align="right">
					            <button type="button" id="add_vote" data-toggle="modal" data-target="#VoteModal" class="btn btn-primary btn-lg">Ajouter</button>
				            </div>
                     
                        </div>
                    </div> -->
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
                                <th>Details</th>
                                <!-- <th>Supprimer</th> -->
                            </tr>
                        </thead> 
                        <tbody>
                        <?php $re=$db->prepare("SELECT * FROM vote");
                              $re->execute();
                              $ree=$re->fetchAll();
                              foreach($ree as $rr):
                        ?>
                            <tr>
                                <td><?=$rr['id_vote'];?></td>
                                <td><?=$rr['designation'];?></td>
                                <td><?=$rr['date_vote'];?></td>
                                <td><a href="index.php?idv=<?=$rr['id_vote'];?>" class="btn btn-warning"><i class="fa fa-eye"></i></a></td>
                            </tr> 
                            <?php endforeach; ?>                       
                        </tbody>
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
    // var dataTable = $('#vote_data').DataTable({
	// 	"processing":true,
	// 	"serverSide":true,
	// 	"order":[],
	// 	"ajax":{
	// 		url:"fetch_before_index.php",
	// 		type:"POST"
	// 	},
	// 	"columnDefs":[
	// 		{
	// 			"targets":[0, 3, 4],
	// 			// "targets":[0, 8, 9],
	// 			"orderable":false,
	// 		},
	// 	],
    //     "bDestroy":true

	// });
    $(document).on('submit', '#vote_form', function(event){
        event.preventDefault();
		var designation = $('#designation').val();
		var date_vote = $('#date_vote').val();
			
		if(designation != '' && date_vote !='')
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