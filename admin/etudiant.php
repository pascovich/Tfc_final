<?php

include '../config/connect.php';

// $username = 'root';
// $password = '';
// $db = new PDO( 'mysql:host=localhost;dbname=pascovichtfc', $username, $password );
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
                                <li class="breadcrumb-item active" aria-current="page">Etudiant</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <div class="dropdown">
                        <div align="right">
					            <button type="button" id="add_etudiant" data-toggle="modal" data-target="#EtudiantModal" class="btn btn-primary btn-lg">Ajouter</button>
				            </div>
                     
                        </div>
                    </div>
                </div>
            </div>
            
           
            <!-- multiple select row Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Liste des etudiants inscrits</h4>
                    <a href="print_etudiant.php" target="_blank" class="btn btn-primary float-right"><i class="fa fa-print"></i></a>
                </div>
                <div class="pb-20">
                    <div class="table-responsive">
                    
                    <table id="etudiant_data" class="data-table table hover multiple-select-row nowrap" >
                        <thead>
                            <tr>
                                <!-- <th class="table-plus datatable-nosort">#</th> -->
                                <th>#</th>
                                <th>ID_login</th>
                                <th>Avatar</th>
                                <th>Nom</th>
                                <th>PostNom</th>
                                <th>Prenom</th>
                                <th>Sexe</th>
                                <th>Promotion</th>
                                <th>Option</th>
                                <th>Lieu</th>
                                <th>Naissance</th>
                                <th>Telephone</th>
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

<div class="modal fade bs-example-modal-lg" id="EtudiantModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-centered">
					<div class="modal-content">
                    <form action="" method="POST" id="etudiant_form" enctype="multipart/form-data" autocomplete="on">
                        
						<div class="modal-header">
							<h4 class="modal-title" id="myLargeModalLabel">Informations de l'etudiant</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    Nom
                                    <input type="text" class="form-control" name="nom" id="nom" value="" placeholder="Entrer le nom">
                                </div>
                                <div class="col-md-4">
                                    Post-nom
                                    <input type="text" class="form-control" name="postnom" id="postnom" value="" placeholder="Entrer son postnom">
                                </div>
                                <div class="col-md-4">
                                    Prenom
                                    <input type="text" class="form-control" name="prenom" id="prenom" value="" placeholder="Entrer son prenom">
                                </div>
                            </div><br>
                            <div class="row">
                                
                                <div class="col-md-4">
                                    Password
                                    <input type="password" class="form-control" name="password" id="password" value="" placeholder="Entrer son password">
                                </div>
                                <div class="col-md-4">
                                    confirme password
                                    <input type="password" class="form-control" name="confirm" id="confirm" value="" placeholder="confirm ton password">
                                </div>
                                <div class="col-md-4">
                                    Telephone
                                    <input type="text" class="form-control" name="telephone" id="telephone" value="" placeholder="entrer le numero telephone">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    Sexe
                                    <select name="sexe" id="sexe" class="form-control">
                                        <option value="m">Masculin</option>
                                        <option value="f">feminin</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    Date Naissance
                                    <input type="date" class="form-control" name="naissance" id="naissance" value="" placeholder="Entrer la date de birthday">
                                </div>
                                <div class="col-md-4">
                                    Lieu de Naissance
                                    <input type="text" class="form-control" name="lieu" id="lieu" value="" placeholder="lieu">
                                </div>
                                
                            </div><br>
                            <div class="row">
                                <div class="col-md-4">
                                    Promotion
                                   <select name="promotion" id="promotion" class="form-control">
                                        <option value="G1">G1</option>
                                        <option value="G2">G2</option>
                                        <option value="G3">G3</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        
                                   </select>
                                </div>
                                <div class="col-md-4" >
                                    Option
                                    <select name="optionn" id="optionn" class="form-control">
                                        <option value="IG">IG</option>
                                        <option value="GD">GD</option>
                                        <option value="SP">SP</option>
                                        <option value="GIMF">GIMF</option>
                                        <option value="RTEL">RTEL</option>
                                        <option value="GRH">GRH</option>
                                        
                                   </select>
                                </div>
                                <div class="col-md-4" >
                                    Choisir un avatar
                                    <input type="file" name="photo" id="photo" class="form-control" value="">
                                    <span id="etudiant_uploaded_image"></span>
                                </div>
                                
                            </div>

						</div>
						<div class="modal-footer">
                            <input type="hidden" name="id_etudiant" id="id_etudiant" />
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
        $('#add_etudiant').click(function(){
        $('#EtudiantModal').modal('show');
		$('#etudiant_form')[0].reset();
		$('.modal-title').text("Incription de l'etudiant");
		$('#action').val("Add");
		$('#operation').val("Add");
		$('#etudiant_uploaded_image').html('');
	});
    var dataTable = $('#etudiant_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"fetch_etudiant.php",
			type:"POST"
		},
		"columnDefs":[
			{
				// "targets":[0, 3, 4],
				"targets":[0, 9, 10],
				"orderable":false,
			},
		],
        "bDestroy":true

	});
    $(document).on('submit', '#etudiant_form', function(event){
        event.preventDefault();
		var nom = $('#nom').val();
		var postnom = $('#postnom').val();
		var prenom = $('#prenom').val();
		var sexe = $('#sexe').val();
		var lieu = $('#lieu').val();
		var confirm = $('#confirm').val();
		var password = $('#password').val();
		var telephone = $('#telephone').val();
		var naissance = $('#naissance').val();
		var promotion = $('#promotion').val();
		var optionn = $('#optionn').val();
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
		if(nom != '' && postnom !='' && prenom != '' && sexe != '' && lieu !='' && naissance != '' && promotion !='' && optionn!='' && password !='' && confirm!='' && telephone !='')
		{
			$.ajax({
				url:"insert_etudiant.php",
				method:'POST',
				data:new FormData(this),
                contentType:false,
				processData:false,
				success:function(data)
				{
                    
                        alert(data);
                        $('#etudiant_form')[0].reset();
                        $('#EtudiantModal').modal('hide');
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
		var id_etudiant = $(this).attr("id");
		$.ajax({
			url:"etudiant_fetch_single.php",
			method:"POST",
			data:{id_etudiant:id_etudiant},
			dataType:"json",
			success:function(data)
			{
				$('#EtudiantModal').modal('show');
				$('#nom').val(data.nom);
				$('#postnom').val(data.postnom);
                $('#prenom').val(data.prenom);
				$('#sexe').val(data.sexe);
                $('#promotion').val(data.promotion);
				$('#optionn').val(data.optionn);
                $('#naissance').val(data.naissance);
				$('#lieu').val(data.lieu);
				$('#telephone').val(data.telephone);
				$('#password').val(data.password);
				$('.modal-title').text("Editer les infos de l'etudiant");
				$('#id_etudiant').val(id_etudiant);
				$('#etudiant_uploaded_image').html(data.photo);
				$('#action').val("Edit");
				$('#operation').val("Edit");
			}
		})
	});
    $(document).on('click', '.delete', function(){
		var id_etudiant = $(this).attr("id");
		if(confirm("Es-tu sure de vouloir supprimer cet etudiant?"))
		{
			$.ajax({
				url:"etudiant_delete.php",
				method:"POST",
				data:{id_etudiant:id_etudiant},
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
<!-- 
//generate voters id
		$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$voter = substr(str_shuffle($set), 0, 15); -->