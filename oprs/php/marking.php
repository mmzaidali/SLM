<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "svLogin.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "svLogin.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bootstrap</title>
	<meta name="viewreport" content="width=device-width, initial-scale=1.0">

<!-- Bootstrap -->
	<link href="../css/bootstrap-theme.min.css" rel="stylesheet">
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/bootstrap.css" rel="stylesheet">
	<link href="../css/style.css" rel="stylesheet">
</head>


<body>

<!-- Navigation Bar-->
	<div class ="navbar navbar-inverse navbar-static-top">
		<div class ="container">
			<a href ="#" class ="navbar-brand">Online Progress Report System</a>

			<button class ="navbar-toggle" data-toggle="dropdown" data-target=".navHeaderCollapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>	
			</button>
			<div class ="collapse navbar-collapse navHeaderCollapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo $logoutAction ?>">Logout</a></li>
                </ul>
			</div>
		</div>
	</div>

<!-- Header -->
<!-- Content -->
    <!--
User Profile Sidebar by @keenthemes
A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
Licensed under MIT
-->

<div class="container">
    <div class="row profile">
		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<img src="../img/iphone.jpg" class="img-circle" width="240" height="240" alt="">
				</div><br>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						<center><label><?php echo $_SESSION['MM_Username']; ?></label></center>
				  </div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<div class="profile-userbuttons">
				</div><br>
				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="list-group">
						<li class="list-group-item">
							<a href="../php/viewProgress.php">
							<i class="glyphicon glyphicon-home"></i>
							View Progress </a>
						</li>
						<li class="list-group-item">
							<a href="../php/marking.php">
							<i class="glyphicon glyphicon-user"></i>
							Marking </a>
						</li>
                        <li class="list-group-item">
							<a href="../php/academic.php">
							<i class="glyphicon glyphicon-user"></i>
							Academic Performance </a>
						</li>
					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>
		<div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid"></div>
                            <div class="navbar-header">
                                <a class="navbar-brand">Marking Coursework / Thesis</a>
                            </div>
                        </div>
                    </nav>
                </div>
            
                <form role="form">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-4">Name :</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="fname" placeholder="Fullname">
                                </div>
                        </div><br><br>
                        
                        <div class="form-group">
                            <label class="col-md-4">Department :</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="depart" placeholder="Department">
                                </div>
                        </div><br><br>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-4">Staff ID :</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="staffno" placeholder="Staff ID">
                                </div>
                        </div><br><br>
                        
                        <div class="form-group">
                            <label class="col-md-4">Position :</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="position" placeholder="Position">
                                </div>
                        </div><br><br>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-2">Chapter 1 :</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="criteria">
                                        <option selected="Excellent">Excellent</option>
                                        <option selected="Good">Good</option>
                                        <option selected="Fair">Fair</option>
                                        <option selected="Unsatisfactory">Unsatisfactory</option>
                                        <option selected="Poor">Poor</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-4">
                                    <input type="number" class="form-control" name="mark" placeholder="Marking / 100%">
                                </div>
                        </div><br><br>
                        
                        <div class="form-group">
                            <label class="col-md-2">Chapter 2 :</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="criteria">
                                        <option selected="Excellent">Excellent</option>
                                        <option selected="Good">Good</option>
                                        <option selected="Fair">Fair</option>
                                        <option selected="Unsatisfactory">Unsatisfactory</option>
                                        <option selected="Poor">Poor</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-4">
                                    <input type="number" class="form-control" name="mark" placeholder="Marking / 100%">
                                </div>
                        </div><br><br>
                        
                        <div class="form-group">
                            <label class="col-md-2">Chapter 3 :</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="criteria">
                                        <option selected="Excellent">Excellent</option>
                                        <option selected="Good">Good</option>
                                        <option selected="Fair">Fair</option>
                                        <option selected="Unsatisfactory">Unsatisfactory</option>
                                        <option selected="Poor">Poor</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-4">
                                    <input type="number" class="form-control" name="mark" placeholder="Marking / 100%">
                                </div>
                        </div><br><br>
                        
                        <div class="form-group">
                            <label class="col-md-2">Chapter 4 :</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="criteria">
                                        <option selected="Excellent">Excellent</option>
                                        <option selected="Good">Good</option>
                                        <option selected="Fair">Fair</option>
                                        <option selected="Unsatisfactory">Unsatisfactory</option>
                                        <option selected="Poor">Poor</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-4">
                                    <input type="number" class="form-control" name="mark" placeholder="Marking / 100%">
                                </div>
                        </div><br><br>
                        
                        <div class="form-group">
                            <label class="col-md-2">Chapter 5 :</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="criteria">
                                        <option selected="Excellent">Excellent</option>
                                        <option selected="Good">Good</option>
                                        <option selected="Fair">Fair</option>
                                        <option selected="Unsatisfactory">Unsatisfactory</option>
                                        <option selected="Poor">Poor</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-4">
                                    <input type="number" class="form-control" name="mark" placeholder="Marking / 100%">
                                </div>
                        </div><br><br>
                    </div>
                    

                    <div class="col-sm-offset-5 col-sm-2 text-center">
                        <button type="submit" class="btn btn-info btn-block" name="update">Update</button>

                    </div>
                </form>
                
            </div>
		</div>
	</div>
</div>


<!--Footer-->
	<div class="navbar navbar-default navbar-fixed-bottom">
		<div class="container">
			<p class="navbar-text pull-left">Site Built By Zaid Ali</p>
			<a class="navbar-btn btn-warning btn pull-right">Contact Me</a>
		</div>
	</div>



<!--JavaScript file -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<!--script src="js/bootstrap.js"></script>-->

</body>
</html>