<?php


include '../config/connect.php';
?>
<?php

if (empty($_SESSION['user'])) {
  header('location:login.php');
}

$elire=$db->prepare("SELECT * FROM etudiant");
$elire->execute();
$date=date('Y-m-d');

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Vote | etudiants inscrits</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="AdminLTE-master/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="AdminLTE-master/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="AdminLTE-master/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="AdminLTE-master/dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> ISIG-GOMA, DRC.
          <small class="pull-right">Date: <?=$date;?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        <!-- From -->
        <!-- <address>
          <strong>Admin, Inc.</strong><br>
          795 Folsom Ave, Suite 600<br>
          San Francisco, CA 94107<br>
          Phone: (804) 123-5432<br>
          Email: info@almasaeedstudio.com
        </address> -->
        <img src="../media/images/isig.jpg" alt="" width="50%">
      </div>
     
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        
        <address>
         INSTITUT SUPERIEUR D'INFORMATIQUE ET DE GESTION <br>ISIG <br> B.P. 841 GOMA
          <!-- L’ISIG est agréé définitivement par Décret 
présidentiel N° 06/0106 du 12 Juin 2006
portant agrément de quelques
 Etablissements d’Enseignement Sup et Univ -->
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        
        <img src="../media/images/isig.jpg" alt="" width="50%">
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <hr>
    <h4 style="text-align: center;">BUREAU DE COORDINATION DE VOTE 2020-2021</h4>
    <hr>
    <h4 style="text-align: center;">Liste des étudiants</h4>
    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
                <th width="15%">Avatar</th>
                <th>nom</th>
               <th>postnom</th>
                <th>prenom</th>
                <th>sexe</th>
                <th>promotion</th>
                <th>option</th>
                <th>telephone</th>
          </tr>
          </thead>
          <tbody>
          <?php while($etud=$elire->fetch()): ?>
          <tr>
            <td><img src="../media/images/<?= $etud['photo']; ?>" width="25%"></td>
            <td><?=$etud['nom'];?></td>
            <td><?=$etud['postnom'];?></td>
            <td><?=$etud['prenom'];?></td>
            <td><?=$etud['promotion'];?></td>
            <td><?=$etud['optionn'];?></td>
            <td><?=$etud['sexe'];?></td>
            <td><?=$etud['telephone'];?></td>
          </tr>
          <?php endwhile; ?>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    
    <div class="row">
      
      <div class="col-xs-2"></div>
      <div class="col-xs-6">
        
      </div>
      <div class="col-xs-4">
        <p class="lead">Fait à Goma,<?=$date;?></p>
        <p>   President de vote <br><br><br><b>  Irenge balolage</b></p> 
      </div>

      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
