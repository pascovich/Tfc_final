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
                            <h4>Utilisateur</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Utilisateur</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <div class="dropdown">
                        <div align="right">
					            <button type="button" id="add_user" data-toggle="modal" data-target="#UserModal" class="btn btn-primary btn-lg">Ajouter</button>
				            </div>
                     
                        </div>
                    </div>
                </div>
            </div>
            
           
            <!-- multiple select row Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Liste des utilisateurs</h4>
                </div>
                <div class="pb-20">
                    <div class="table-responsive">
                    
                    <table id="user_data" class="data-table table hover multiple-select-row nowrap" >
                        <thead>
                            <tr>
                                <!-- <th class="table-plus datatable-nosort">#</th> -->
                                <th>#</th>
                                <th>Avatar</th>
                                <th>Username</th>
                                <th>E-mail</th>
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

<div class="modal fade bs-example-modal-lg" id="UserModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-centered">
					<div class="modal-content">
                    <form action="" method="POST" id="user_form" enctype="multipart/form-data" autocomplete="on">

						<div class="modal-header">
							<h4 class="modal-title" id="myLargeModalLabel">Informations de l'utilisateur</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    Username
                                    <input type="text" class="form-control" name="username" id="username" value="" placeholder="Entrer le username">
                                </div>
                                <div class="col-md-4">
                                    E-Mail
                                    <input type="mail" class="form-control" name="gmail" id="gmail" value="" placeholder="Entrer l'adresse e-mail">
                                </div>
                                <div class="col-md-4" >
                                    Choisir un avatar
                                    <input type="file" name="photo" id="photo" class="form-control" value="">
                                    <span id="user_uploaded_image"></span>
                                </div>
                                
                            </div><br>
                            <div class="row">
                                <div class="col-md-6">
                                    Password
                                    <input type="password" class="form-control" name="password" id="password" value="" placeholder="Entrer le password">
                                </div>
                                <div class="col-md-6">
                                    Password confirm
                                    <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="" placeholder="Entrer le password pour confirmer">
                                </div>
                            </div>
						</div>
						<div class="modal-footer">
                            <input type="hidden" name="id_user" id="id_user" />
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
        $('#add_user').click(function(){
        $('#UserModal').modal('show');
		$('#user_form')[0].reset();
		$('.modal-title').text("Inscription de l'utilisateur");
		$('#action').val("Add");
		$('#operation').val("Add");
		$('#user_uploaded_image').html('');
	});
    var dataTable = $('#user_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"fetch_user.php",
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
    $(document).on('submit', '#user_form', function(event){
        event.preventDefault();
		var username = $('#username').val();
		var gmail = $('#gmail').val();
		var password = $('#password').val();
		var password_confirm = $('#password_confirm').val();
		var extension = $('#photo').val().split('.').pop().toLowerCase();
		if(extension != '')
		{
			if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
			{
				alert("Invalid Image File");
				$('#photo').val('');
				return false;
			}
		}	
		if(username != '' && gmail !='' && password != '' && password_confirm != '')
		{
			$.ajax({
				url:"insert_user.php",
				method:'POST',
				data:new FormData(this),
                contentType:false,
				processData:false,
				success:function(data)
				{
                    
                        alert(data);
                        $('#user_form')[0].reset();
                        $('#UserModal').modal('hide');
					    dataTable.ajax.reload();
                    	
				}
			});
		}
		else
		{
                       
			alert("Both Fields are Required");
            // $('#EtudiantModal').modal('hide');
		}
	});
    $(document).on('click', '.update', function(){
		var id_user = $(this).attr("id");
		$.ajax({
			url:"user_fetch_single.php",
			method:"POST",
			data:{id_user:id_user},
			dataType:"json",
			success:function(data)
			{
				$('#UserModal').modal('show');
				$('#username').val(data.username);
				$('#gmail').val(data.gmail);
                $('#password').val(data.password);
				$('.modal-title').text("Editer les infos de l'utilisateur");
				$('#id_user').val(id_user);
				$('#user_uploaded_image').html(data.photo);
				$('#action').val("Edit");
				$('#operation').val("Edit");
			}
		})
	});
    $(document).on('click', '.delete', function(){
		var id_user = $(this).attr("id");
		if(confirm("Es-tu sure de vouloir supprimer cet utilisateur?"))
		{
			$.ajax({
				url:"user_delete.php",
				method:"POST",
				data:{id_user:id_user},
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