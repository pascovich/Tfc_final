<?php 
require('config/connect.php');
require('config/function.php');

$requette=$db->prepare("SELECT * FROM etudiant");
$requette->execute();
$etudiants=$requette->fetchAll();

$requet=$db->prepare("SELECT * FROM vote");
$requet->execute();
$vote=$requet->fetchAll();

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
                            <h4>Candidat</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Candidat</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <div class="dropdown">
                        <!-- <div align="right">
					            <button type="button" id="add_candidat" data-toggle="modal" data-target="#CandidatModal" class="btn btn-primary btn-lg">Ajouter</button>
				            </div> -->
                     
                        </div>
                    </div>
                </div>
            </div>
            

           
            <!-- multiple select row Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Liste des candidatures  </h4>
                    
                </div>
                <div class="pb-20">
                    <div class="table-responsive">
                    
                    <table id="candidat_data" class="data-table table hover multiple-select-row nowrap" >
                        <thead>
                            <tr>
                                <!-- <th class="table-plus datatable-nosort">#</th> -->
                                <th>#</th>
                                <th>Avatar</th>
                                <th>Nom</th>
                                <th>PostNom</th>
                                <th>Prenom</th>
                                <th>Promotion</th>
                                <th>Option</th>
                                <th>Ref_vote</th>
                                <th>Numero</th>
                                <th>Slogan</th>
                                <th>Voir</th>
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

<div class="modal fade bs-example-modal-lg" id="CandidatModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-centered">
					<div class="modal-content">
                    <form action="" method="POST" id="candidat_form" enctype="multipart/form-data" autocomplete="on">

						<div class="modal-header">
							<h4 class="modal-title" id="myLargeModalLabel">Informations du candidat</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    
                                    ID du candidat
                                    <input type="text" name="ref_etudiant" id="ref_etudiant" class="form-control">
                                    
                                    <!-- <select name="ref_etudiant" id="ref_etudiant" class="form-control">
                                    <?php foreach($etudiants as $etudd): ?>
                                        <option value="<?=$etudd['id_etudiant'];?>"><?=$etudd['nom'];?></option>                                        
                                        <?php endforeach; ?>
                                    </select> -->
                                    
                                </div>
                                <div class="col-md-4">
                                    Numero du candidat
                                    <input type="text" name="numero" id="numero" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    Reference du vote
                                    <input type="text" name="ref_vote" id="ref_vote" class="form-control">

                                    <!-- <select name="ref_vote" id="ref_vote" class="form-control">
                                    <?php foreach($vote as $votee): ?>
                                        <option value="<?=$votee['id_vote'];?>"><?=$votee['designation'];?></option>                                        
                                        <?php endforeach; ?>
                                    </select> -->
                                </div>
                            </div>
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
                                <div class="col-md-6">
                                    Promotion
                                    <input type="text" class="form-control" name="promotion" id="promotion" value="" placeholder="Entrer son prenom">

                                   <!-- <select name="promotion" id="promotion" class="form-control">
                                        <option value="G1">G1</option>
                                        <option value="G2">G2</option>
                                        <option value="G3">G3</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        
                                   </select> -->
                                </div>
                                <div class="col-md-6" >
                                    Option
                                    <input type="text" class="form-control" name="option" id="option" value="" placeholder="Entrer son prenom">

                                    <!-- <select name="option" id="option" class="form-control">
                                        <option value="IG">IG</option>
                                        <option value="GD">GD</option>
                                        <option value="SP">SP</option>
                                        <option value="GIMF">GIMF</option>
                                        <option value="RTEL">RTEL</option>
                                        <option value="GRH">GRH</option>
                                        
                                   </select> -->
                                </div>
                                <!-- <div class="col-md-4" >
                                    Sa photo
                                    <input type="file" name="photo" id="photo" class="form-control" value="">
                                    <span id="candidat_uploaded_image"></span>
                                </div> -->
                                
                            </div><br>
                            <div class="row">
                            <div class="col-md-4">
                                photo de profile
                                <span id="photo_candidat" style="display:inline-block;"></span>
                                    
                                </div>
                                <div class="col-md-8">
                                Son slogan   
                                    <textarea class="form-control" id="slogan" name="slogan" placeholder="Enter text a slogan of candidate..."></textarea>

                                </div>
                                
                            </div>
                            
                            <!-- <div class="html-editor pd-20 card-box mb-30">
                                <h4 class="h4 text-blue">bootstrap wysihtml5</h4>
                                <p>Simple, beautiful wysiwyg editors</p>
                                <textarea class="textarea_editor form-control border-radius-0" placeholder="Enter text ..."></textarea>
                            </div> -->

						</div>
						<div class="modal-footer">
                            <input type="hidden" name="id_candidat" id="id_candidat" />
                            <input type="hidden" name="operation" id="operation" />
                            <!-- <input type="submit" name="action" id="action" class="btn btn-success" value="Add" /> -->
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </form>  
					</div>
				</div>
</div>



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
        
    var dataTable = $('#candidat_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"fetch_candidat.php",
			type:"POST"
		},
		"columnDefs":[
			{
				// "targets":[0, 3, 4],
				"targets":[0, 8, 9],
				"orderable":false,
			},
		],
        "bDestroy":true

	});
    
    $(document).on('click', '.view', function(){
		var id_candidat = $(this).attr("id");
		$.ajax({
			url:"candidat_fetch_single.php",
			method:"POST",
			data:{id_candidat:id_candidat},
			dataType:"json",
            // beforeSend: function() {
            //         $('.update').attr('disabled', 'disabled');
            //         $('.update').val('Patientez...');
            //     },
			success:function(data)
			{
				$('#CandidatModal').modal('show');
				$('#ref_etudiant').val(data.CODE);
				$('#numero').val(data.NUMVOTE);
                $('#slogan').val(data.SLOGAN);
                $('#ref_vote').val(data.NOMVOTE);
                $('#nom').val(data.NOM);
                $('#postnom').val(data.POSTNOM);
                $('#prenom').val(data.PRENOM);
                $('#option').val(data.OPTION);
                $('#promotion').val(data.PROMOTION);
				// // $('#sexe').val(data.sexe);
                // $('#promotion').val(data.promotion);
				// $('#option').val(data.option);
				$('.modal-title').text("les infos du candidat");
				$('#id_candidat').val(id_candidat);
				$('#photo_candidat').html(data.IMAGE);
				// $('#action').val("Edit");
				// $('#operation').val("Edit");
			}
		})
	});
    
    
});


</script>