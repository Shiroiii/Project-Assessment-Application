<?php
include_once('php/controllers/ExaminerController.php');
session_start();
if(!isset($_SESSION['examiner_id'])) header('location: Examiner_login.php');

$examCtrl = new ExaminerController;

$projects = $examCtrl->view_projects($_SESSION['examiner_id']);

if(isset($_POST['show'])){

    $_SESSION['project_id'] = $_POST['projectId'];

    header('Location: gradedproject.php');
    
}

if(isset($_POST['grade'])){

    $_SESSION['project_id'] = $_POST['projectId'];

    header('Location: project2.php');
    
}


?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Assigned Projects</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
 
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <style>
    .bg-dark{
      background-color: #020550 !important;
    }
    table a{
      text-decoration: none !important;
    }
  </style>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">Project Assessment Application</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="profile.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Profile</span>
          </a>
        </li>
        
        <li class="nav-item" class="active" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="tables.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Assigned Projects</span>
          </a>
        </li>
        
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-gear"></i>
            <span class="nav-link-text">Settings</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePages">
            <li>
              <a href="change-password.php"> Change Password</a>
            </li>
            <li>
              <a href="Examiner_login.php">Log out</a>
            </li>
          </ul>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
     
      <div style="margin-left:80%;color:antiquewhite;">
        <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
          <i class="fa fa-fw fa-sign-out"></i>Logout</a>
    </div>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
      <?php if((!is_array($projects)) || ($projects == null)){ ?>
      <p>No project assigned yet</p>
        <?php } else{ ?>
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Graded Projects</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              
               
              <thead>
                <tr>
                  <th>Project Title</th>
                  <th></th>
                </tr>
              </thead>
  
              <tbody>
                <?php foreach($projects as $project){ if($project['graded'] === true){ ?>
                <tr>
                  <td><?php echo ($project['title'])?></td>
                  <td>
                  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
                    <input type="hidden" name="projectId" value="<?php echo ($project['id'])?>">
                    <input type="submit" name="show" value="VIEW">
                  </form>
                </td>
                </tr>
                 <?php } }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-table"></i> Ungraded Projects</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Project Title</th>
                    <th></th>
                  </tr>
                </thead>
    
                <tbody>
                <?php foreach($projects as $project){ if($project['graded'] === false){ ?>
                <tr>
                  <td> <?php echo ($project['title'])?></td>
                  <td>
                  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
                    <input type="hidden" name="projectId" value="<?php echo ($project['id'])?>">
                    <input type="submit" name="grade" value="GRADE">
                  </form>
                </td>
                </tr>
                 <?php } } }?>
              </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  
    </div>

    



    
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->

    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="Examiner_login.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
  </div>
</body>

</html>
