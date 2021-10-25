<?php 
  include 'config/connect.php';

  if (isset($_POST['id_login']) && isset($_POST['password'])) {

  	  $id_login = htmlspecialchars($_POST['id_login']);
  	  $password = htmlspecialchars($_POST['password']);

  	  $requete = $db->prepare("SELECT * FROM etudiant WHERE id_login=:id_login and password=:password");
  	  $requete->execute(array(
      'id_login' => $id_login,
      'password' => $password
  	  ));
  	  $res = $requete->fetchAll(PDO::FETCH_OBJ);
  	   if ($res) {
  	   	$user->con($res[0]->id_etudiant);
  	   	header('location:before_index.php');
  	   }else{
             $errors="password ou username invalide";
         }


  }
 ?>


<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>VoteApp - Login</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="../admin/vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../admin/vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../admin/vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../admin/vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="../admin/vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="../admin/vendors/styles/style.css">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>
<body class="login-page">
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="login.html">
					<!-- <img src="../admin/vendors/images/deskapp-logo.svg" alt=""> -->
				</a>
			</div>
			<div class="login-menu">
				<!-- <ul>
					<li><a href="register.html">Register</a></li>
				</ul> -->
			</div>
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="../admin/vendors/images/login-page-img.png" alt="">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">Login To VoteApp</h2>
						</div>
						<form id="login_form" method="POST" action="login.php">
							<div class="select-role">
								<div class="btn-group btn-group-toggle" data-toggle="buttons">
									<label class="btn active">
										<input type="radio" name="options" id="admin">
										<div class="icon"><img src="../admin/vendors/images/briefcase.svg" class="svg" alt=""></div>
										<span>I'm</span>
										Student
									</label>
									<!-- <label class="btn">
										<input type="radio" name="options" id="user">
										<div class="icon"><img src="vendors/images/person.svg" class="svg" alt=""></div>
										<span>I'm</span>
										Employee
									</label> -->
								</div>
							</div>
							<?php 
							if (isset($errors)):?>
								<div class="alert alert-danger">
								<p><?=$errors?></p>
								</div>
							
							
							<?php endif; ?>
							<div class="input-group custom">
								<input type="text" name="id_login" id="id_login" class="form-control form-control-lg" placeholder="ID_login">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="**********">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
								</div>
							</div>
							<div class="row pb-30">
								<div class="col-6">
									<div class="custom-control custom-checkbox">
										<!-- <input type="checkbox" class="custom-control-input" id="customCheck1"> -->
										<!-- <label class="custom-control-label" for="customCheck1">Remember</label> -->
									</div>
								</div>
								<div class="col-6">
									<!-- <div class="forgot-password"><a href="forgot-password.html">Forgot Password</a></div> -->
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
										
											<!-- use code for form submit -->
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
										
										
										<!-- <a class="btn btn-primary btn-lg btn-block" href="index.html">Sign In</a> -->
									</div>
									<!-- <div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">OR</div>
									<div class="input-group mb-0">
										<a class="btn btn-outline-primary btn-lg btn-block" href="register.html">Register To Create Account</a>
									</div> -->
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="../admin/vendors/scripts/core.js"></script>
	<script src="../admin/vendors/scripts/script.min.js"></script>
	<script src="../admin/vendors/scripts/process.js"></script>
	<script src="../admin/vendors/scripts/layout-settings.js"></script>
</body>
</html>