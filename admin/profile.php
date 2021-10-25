<?php 
  include '../config/connect.php';
 
  
  if (empty($_SESSION['user'])) {
    header('location:login.php');
  }
  $req=$db->prepare("SELECT * FROM users WHERE id_user=:idc");
?>

<?php 

if (isset($_POST['submitInfoUser'])) {
	$username=htmlspecialchars($_POST['username']);
	$email=htmlspecialchars($_POST['email']);
	if (!empty($username) && !empty($email)) {
		$modif=$db->prepare("UPDATE users SET username=:username,gmail=:email WHERE id_user=:idc");
		$modif->execute(array(
			':username' =>$username,
			':email' => $email,
			':idc' => $_SESSION['user']['id_user']
		));
		header('location:profile.php');
      
	}
}
if (isset($_POST['submitpwd'])) {
	$pass=$_POST['password'];
	$confirm=$_POST['confirm'];
	if (!empty($pass) && !empty($confirm)) {
		if ( $pass==$confirm) {
			$mod=$db->prepare("UPDATE users SET password=:password WHERE id_user=:idc");
			$mod->execute(array(
			':password' => $pass,
			':idc' => $_SESSION['user']['id_user']
		));
		header('location:profile.php');
		}else{
			$errors="les 2 passwords doivent coincider";
		}
	}else{
		$errors = 'remplit tous les champs';
	}
	

}


?>


<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="src/plugins/cropperjs/dist/cropper.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>
<body>
	
<!-- <?php include('../partials/_animation.php'); ?> -->

	<?php include('../partials/_topbar.php'); ?>

	<?php include('../partials/_sidebar.php'); ?>

	<?php include('../partials/_navigation.php'); ?>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="title">
								<h4>Profile</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Profile</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
						<div class="pd-20 card-box height-100-p">
							<div class="profile-photo">
							<?php
                            $req->execute(array(
                            'idc' => $_SESSION['user']['id_user']
                            ));  
                            $don=$req->fetchAll(PDO::FETCH_OBJ);
                            foreach($don as $s):  
                        ?>
								<a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i class="fa fa-pencil"></i></a>
								<!-- <img src="vendors/images/photo1.jpg" alt="" class="avatar-photo"> -->
							<img src="../media/images/<?=$connecte->photo;?>" class="avatar-photo" width="70%" alt="image">
								<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-body pd-5">
												<div class="img-container">
													<img id="image" src="../media/images/<?=$connecte->photo;?>" width="" alt="image">
													<!-- <img id="image" src="vendors/images/photo2.jpg" alt="Picture"> -->
												</div>
											</div>
											<div class="modal-footer">
												<input type="submit" value="Update" class="btn btn-primary">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
								<?php endforeach; ?>
							</div>
							<h5 class="text-center h5 mb-0">
							<?php 
                                    if ($_SESSION['user']['username'] !== array()) {
                                       $users = $_SESSION['user']['username'];
                                    echo "$users";
                                    }
                                ?>


							</h5>
							<p class="text-center text-muted font-14">
							<?php     
                                $req->execute(array(
                                'idc' => $_SESSION['user']['id_user']
                                ));  
                                $don=$req->fetchAll(PDO::FETCH_OBJ);
                                foreach($don as $s):  
                                ?>
                            <p><?=$s->username;?> <span style="color:greenYellow;">on line</span></p>

							</p>
							<div class="profile-info">
								<h5 class="mb-20 h5 text-blue">Contact Information</h5>
								<ul>
								<li>
										<span>Username:</span>
										<?=$s->username;?>
								</li>
								<li>
										<span>Email Address:</span>
										<?=$s->gmail;?>
								</li>
								
								</ul>
							</div>
							<div class="profile-social">
								<h5 class="mb-20 h5 text-blue">Social Links</h5>
								<ul class="clearfix">
									<li><a href="#" class="btn" data-bgcolor="#3b5998" data-color="#ffffff"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#007bb5" data-color="#ffffff"><i class="fa fa-linkedin"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#f46f30" data-color="#ffffff"><i class="fa fa-instagram"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#c32361" data-color="#ffffff"><i class="fa fa-dribbble"></i></a></li>
									
								</ul>
							</div>
							
							<?php endforeach ?>
						</div>
					</div>
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
						<div class="card-box height-100-p overflow-hidden">
							<div class="profile-tab height-100-p">
								<div class="tab height-100-p">
									<ul class="nav nav-tabs customtab" role="tablist">
									<li class="nav-item">
											<a class="nav-link " data-toggle="tab" href="#timeline" role="tab">Password</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#setting" role="tab">Autres</a>
										</li>
									</ul>
									<div class="tab-content">
										<!-- Timeline Tab start -->
										<div class="tab-pane fade show active" id="timeline" role="tabpanel">
											<div class="pd-20">
											<?php if(isset($errors)): ?>
												<div class="alert alert-danger">
													<p><?=$errors;?></p>
												</div>
											<?php endif;?>
												<div class="profile-timeline">
													<div class="timeline-month">
														<h5>Information sur la securite</h5>
													</div>
													<?php     
												$req->execute(array(
												'idc' => $_SESSION['user']['id_user']
												));  
												$secret=$req->fetchAll(PDO::FETCH_OBJ);
												foreach($secret as $secrets):  
												?>
													<form action="profilee.php" method="POST">
															<div class="form-group">
																<label for="password">Enter your secret number</label>
																<input class="form-control form-control-lg" type="text" name="password" value="<?=$secrets->password;?>">
															</div>
															<div class="form-group">
																<label for="confirm">confirm your secret number</label>
																<input class="form-control form-control-lg" type="text" name="confirm" value="">
															</div>
															<div class="form-group mb-0">
																<input type="submit" class="btn btn-primary" name="submitpwd" value="Update Password">
															</div>
														</form>
														<?php endforeach; ?>
												</div>
											</div>
										</div>
										<!-- Timeline Tab End -->
										
										<!-- Setting Tab start -->
										<div class="tab-pane fade height-100-p" id="setting" role="tabpanel">
											<div class="profile-setting">
												<form>

													<ul class="profile-edit-list row">
														<li class="weight-500 col-md-6">
														<h4 class="text-blue h5 mb-20">Edit Your Personal Information</h4>
														<form action="profilee.php" method="post">
														<?php     
													$req->execute(array(
													'idc' => $_SESSION['user']['id_user']
													));  
													$info=$req->fetchAll(PDO::FETCH_OBJ);
													foreach($info as $infos):  
													?>
															<div class="form-group">
																<label>UserName</label>
																<input class="form-control form-control-lg" name="username" id="username" value="<?=$infos->username;?>" type="text">
															</div>
															<div class="form-group">
																<label>Email</label>
																<input class="form-control form-control-lg" name="email" id="email" type="email" value="<?=$infos->gmail;?>">
															</div>
															<div class="form-group">
																<div class="custom-control custom-checkbox mb-5">
																	<input type="checkbox" class="custom-control-input" id="customCheck1-1">
																	<label class="custom-control-label weight-400" for="customCheck1-1">I agree to receive notification emails</label>
																</div>
															</div>
															<div class="form-group mb-0">
																<input type="submit"  name="submitInfoUser" class="btn btn-primary" value="Update Information">
															</div>
														</form>
														</li>
														<li class="weight-500 col-md-6">
															<h4 class="text-blue h5 mb-20">Edit Social Media links</h4>
															<div class="form-group">
																<label>Facebook URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group">
																<label>Twitter URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group">
																<label>Linkedin URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group">
																<label>Instagram URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															
															<div class="form-group">
																<label>Google-plus URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															
															<div class="form-group mb-0">
																<input type="submit" class="btn btn-primary" value="Save & Update">
															</div>
														</li>
													</ul>
													<?php endforeach;?>
												</form>
											</div>
										</div>
										<!-- Setting Tab End -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-wrap pd-20 mb-20 card-box">
				DeskApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
	<script src="src/plugins/cropperjs/dist/cropper.js"></script>
	<script>
		window.addEventListener('DOMContentLoaded', function () {
			var image = document.getElementById('image');
			var cropBoxData;
			var canvasData;
			var cropper;

			$('#modal').on('shown.bs.modal', function () {
				cropper = new Cropper(image, {
					autoCropArea: 0.5,
					dragMode: 'move',
					aspectRatio: 3 / 3,
					restore: false,
					guides: false,
					center: false,
					highlight: false,
					cropBoxMovable: false,
					cropBoxResizable: false,
					toggleDragModeOnDblclick: false,
					ready: function () {
						cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
					}
				});
			}).on('hidden.bs.modal', function () {
				cropBoxData = cropper.getCropBoxData();
				canvasData = cropper.getCanvasData();
				cropper.destroy();
			});
		});
	</script>
</body>
</html>