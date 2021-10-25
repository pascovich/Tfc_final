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
                                   <select name="promotion" class="form-control">
                                        <option value="G1">G1</option>
                                        <option value="G2">G2</option>
                                        <option value="G3">G3</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        
                                   </select>
                                </div>
                                <div class="col-md-4" >
                                    Option
                                    <select name="option" class="form-control">
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
							<!-- <input type="submit" name="submit" id="submit"> -->
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<!-- <button type="button" class="btn btn-primary">Save</button> -->
						</div>
                      </form>  
					</div>
				</div>
			</div>
           
            <!-- multiple select row Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Liste des etudiants inscrits</h4>
                </div>
                <div class="pb-20">
                    <table id="etudiant_data" class="data-table table hover multiple-select-row nowrap" >
                        <thead>
                            <tr>
                                <!-- <th class="table-plus datatable-nosort">#</th> -->
                                <th>#</th>
                                <th>Avatar</th>
                                <th>Nom</th>
                                <!-- <th>PostNom</th> -->
                                <th>Prenom</th>
                                <th>Promotion</th>
                                <th>Option</th>
                                <th>Lieu</th>
                                <th>Naissance</th>
                                <th>options</th>
                                <!-- <th>edit</th>
                                <th>delete</th> -->
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        require('../config/connect.php');
                        $req=$db->prepare("SELECT * FROM etudiant ORDER BY id_etudiant DESC");
                        $req->execute();
                        $res=$req->fetchAll();
                        
                        foreach($res as $etud):
                        ?>
                            <tr>
                            <!-- edit modal begin -->

                            <div class="modal fade bs-example-modal-lg" id="editModal<?=$etud['id_etudiant'];?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-centered">
					<div class="modal-content">
                    <form action="update_etudiant.php" method="POST" id="" enctype="multipart/form-data" autocomplete="on">

						<div class="modal-header">
							<h4 class="modal-title" id="myLargeModalLabel">Informations de l'etudiant</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
                        <input type="hidden" name="id_etudiant" id="id_etudiant" value="<?=$etud['id_etudiant'];?>">
                            <div class="row">
                                <div class="col-md-4">
                                    Nom
                                    <input type="text" class="form-control" name="nom" id="nom" value="<?=$etud['nom'];?>">
                                </div>
                                <div class="col-md-4">
                                    Post-nom
                                    <input type="text" class="form-control" name="postnom" id="postnom" value="<?=$etud['postnom'];?>">
                                </div>
                                <div class="col-md-4">
                                    Prenom
                                    <input type="text" class="form-control" name="prenom" id="prenom" value="<?=$etud['prenom'];?>">
                                </div>
                            </div><br>
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
                                    <input type="date" class="form-control" name="naissance" id="naissance" value="<?=$etud['naissance'];?>" placeholder="Entrer la date de birthday">
                                </div>
                                <div class="col-md-4">
                                    Lieu de Naissance
                                    <input type="text" class="form-control" name="lieu" id="lieu" value="<?=$etud['lieu'];?>">
                                </div>
                                
                            </div><br>
                            <div class="row">
                                <div class="col-md-4">
                                    Promotion
                                   <select name="promotion" class="form-control">
                                        <option value="G1">G1</option>
                                        <option value="G2">G2</option>
                                        <option value="G3">G3</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        
                                   </select>
                                </div>
                                <div class="col-md-4" >
                                    Option
                                    <select name="option" class="form-control">
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
                                   
                                    <!-- <span id="etudiant_uploaded_image"></span> -->
                                </div>
                                
                            </div>
                            <img src="../media/images/<?=$etud['photo'];?>" width="60">
                            
						    
						</div>
						<div class="modal-footer">
                            <input type="submit" class="btn btn-success" value="Update">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
                      </form>  
					</div>
				</div>
			</div>


                            <!-- edit modal finish -->
                                <!-- <td class="table-plus">Gloria F. Mead</td> -->
                                <td><?=$etud['id_etudiant'];?></td>
                                <td ><img src="../media/images/<?=$etud['photo'];?>" width="30"></td>
                                <td><?=$etud['nom'];?></td>
                                <!-- <td><?=$etud['postnom'];?></td> -->
                                <td><?=$etud['prenom'];?></td>
                                <td><?=$etud['promotion'];?></td>
                                <td><?=$etud['option'];?></td>
                                <td><?=$etud['lieu'];?></td>
                                <td><?=$etud['naissance'];?></td>
                                <!-- <td><button type="button" name="update" id="<?=$etud['id_etudiant'];?>" class="btn btn-warning btn-xs update"><i class="fa fa-edit"></i></button></td>
                                <td><button type="button" name="delete" id="<?=$etud['id_etudiant'];?>" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></button></td> -->
                                <td>
                                        
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal<?=$etud['id_etudiant'];?>">
                                        <i class="fa fa-edit"></i>
                                        </button>
                                        <a href="etudiant_delete.php?del=<?=$etud['id_etudiant']; ?>" onclick="return(confirm('voulez-vous supprimer cet etudiant?'))" id="deleteuser" class="btn btn-danger deleteuser"><i class="fa fa-trash"></i></a>
                                        
                                    </td>
                           </tr>
                         <?php endforeach; ?>   
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- multiple select row Datatable End -->
            
            
        </div>
        <div class="footer-wrap pd-20 mb-20 card-box">
            VoteApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Kaluzipascovich@gmail.com</a>
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
        $('#etudiantModal').modal('show');
		$('#etudiant_form')[0].reset();
		// $('.modal-title').text("Add User");
		$('#action').val("Add");
		$('#operation').val("Add");
		$('#etudiant_uploaded_image').html('');
	});
    // var dataTable = $('#etudiant_data').DataTable({
	// 	"processing":true,
	// 	"serverSide":true,
	// 	"order":[],
	// 	"ajax":{
	// 		url:"fetch_etudiant.php",
	// 		type:"POST"
	// 	},
	// 	"columnDefs":[
	// 		{
	// 			// "targets":[0, 3, 4],
	// 			"targets":[0, 8, 9],
	// 			"orderable":false,
	// 		},
	// 	],

	// });
    $(document).on('submit', '#etudiant_form', function(event){
        event.preventDefault();
		var nom = $('#nom').val();
		var postnom = $('#postnom').val();
		var prenom = $('#prenom').val();
		var sexe = $('#sexe').val();
		var lieu = $('#lieu').val();
		var naissance = $('#naissance').val();
		var promotion = $('#promotion').val();
		var option = $('#option').val();
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
		if(nom != '' && postnom !='' && prenom != '' && sexe != '' && lieu !='' && naissance != '' && promotion !='' && option!='')
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
                        $('#etudiantModal').modal('hide');
					    dataTable.ajax.reload();
                    	
				}
			});
		}
		else
		{
                       
			alert("Both Fields are Required");
            $('#etudiantModal').modal('hide');
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
				$('#etudiantModal').modal('show');
				$('#nom').val(data.nom);
				$('#postnom').val(data.postnom);
                $('#prenom').val(data.prenom);
				$('#sexe').val(data.sexe);
                $('#promotion').val(data.promotion);
				$('#option').val(data.option);
                $('#naissance').val(data.naissance);
				$('#lieu').val(data.lieu);
				$('.modal-title').text("Editer les infos de l'etudiant");
				$('#id_etudiant').val(id_etudiant);
				$('#etudiant_uploaded_image').html(data.photo);
				$('#action').val("Edit");
				$('#operation').val("Edit");
			}
		})
	});
});


</script>

</body>
</html>