<?php require_once('../Connections/connect.php'); ?>
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
	
  $logoutGoTo = "index.php";
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

$MM_restrictGoTo = "adminLogin.php";
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
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_profile = "-1";
mysql_select_db($database_connect, $connect);

if (isset($_POST['carian']))
{
  $colname_profile = $_POST['carian'];
  $query_profile = "SELECT * FROM profile WHERE name LIKE '%".$colname_profile."%' OR department LIKE '%".$colname_profile."%' OR id_No LIKE '%".$colname_profile."%'";
}
else
{
$query_profile = "SELECT * FROM profile";
}

$profile = mysql_query($query_profile, $connect) or die(mysql_error());
$row_profile = mysql_fetch_assoc($profile);
$totalRows_profile = mysql_num_rows($profile);
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
					<!--<button type="button" class="btn btn-success btn-sm">Upload</button>
					<button type="button" class="btn btn-danger btn-sm">Save</button>-->
				</div><br>
				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				<div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseInfo"><span class="glyphicon glyphicon-folder-close"></span>&nbsp;&nbsp;Information</a>
                            </h4>
                        </div>
                        
                        <div id="collapseInfo" class="panel-collapse collapse out">
					       <ul class="list-group">
						      <li class="list-group-item">
                                  <a href="../php/adProfile.php">Profile</a></li>
                               <li class="list-group-item">
                                    <a href="../php/adAchieve.php">Achivement</a></li>
                               <li class="list-group-item">
                                    <a href="../php/adWorking.php">Working History</a></li>
                               <li class="list-group-item">
                                    <a href="#">Children</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOff"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Offers</a>
                            </h4>
                        </div>
                        
                        <div id="collapseOff" class="panel-collapse collapse out">
					       <ul class="list-group">
                               <li class="list-group-item">
                                    <a href="../php/adOfferFTMK.php">View</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
				<!-- END MENU -->
			</div>
		</div>
		<div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <a class="navbar-brand">Profile</a>
                            </div>
                        </div>
                    </nav>
                </div>
                
                <div class="col-sm-offset-5 col-sm-2 text-center">
                    <button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#myModal">Search</button><br>
                </div>
        
                
                <form id="update">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-4">Name</label><br>
                                <input type="text" class="form-control" name="fname" placeholder="Fullname">
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4">IC No</label><br>
                                <input type="text" class="form-control" name="ic_no" placeholder="IC No">
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4">Department</label><br>
                                <input type="text" class="form-control" name="depart" placeholder="Department">
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4">DOB</label><br>
                                <input type="date" class="form-control" name="DOB">
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4">Race</label><br>
                                <select class="form-control" name="race" placeholder="Race">
                                    <option selected="Malay">Malay</option>
                                    <option selected="Chinese">Chinese</option>
                                    <option selected="Indian">Indian</option>
                                </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4">Gender</label><br>
                                <select class="form-control" name="gender" placeholder="Gender">
                                    <option selected="Male">Male</option>
                                    <option selected="Female">Female</option>
                                </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4">Email</label><br>
                                <input type="email" class="form-control" name="email" placeholder="Email">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-4">Staff ID</label><br>
                                <input type="text" class="form-control" name="id_no" placeholder="Staff ID">
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4">Title</label><br>
                                <input type="text" class="form-control" name="title" placeholder="Title">
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4">Position</label><br>
                                <input type="text" class="form-control" name="position" placeholder="Position">
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4">Birth Place</label><br>
                                <input type="text" class="form-control" name="b_place" placeholder="Birth of Place">
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4">Religion</label><br>
                                <select class="form-control" name="religion" placeholder="Religion">
                                    <option selected="Islam">Islam</option>
                                    <option selected="Buddha">Buddha</option>
                                    <option selected="Hindhu">Hindhu</option>
                                    <option selected="Christian">Christian</option>
                                </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4">Status</label><br>
                                <select class="form-control" name="status" placeholder="status">
                                    <option selected="Single">Single</option>
                                    <option selected="Married">Married</option>
                                </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4">Level of User</label><br>
                                <input type="text" class="form-control" name="level" placeholder="Level of User">
                        </div>
                    </div>
                    
                    <div class="col-sm-offset-5 col-sm-2 text-center">
                        <button type="submit" class="btn btn-warning btn-block" name="delete">Update</button>
                    </div>
                </form>

      </div>
  </div>
</div>
</div>
    
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
          <form name="search" method="post" action="">
              <div class="form-group">
            <input type="text" class="form-control-sm" name="carian" id="carian">
            <button type="submit" class="btn btn-default" name="search" id="search" value="Submit"><span class="glyphicon glyphicon-search"></span></button>
              </div>
          </form> 
      </div>
    
      <div class="modal-body">
          <table class="table table-striped" data-toggle="table">
            <tr>
              <td><b>ID</b></td>
              <td><b>Name</b></td>
              <td><b>Position</b></td>
              <td><b>Staff ID</b></td>
              <td><b>Department</b></td>
              <td></td>
            </tr>
            <?php do { ?>
              <tr>
                <td><?php echo $row_profile['idprofile']; ?></td>
                <td><?php echo $row_profile['name']; ?></td>
                <td><?php echo $row_profile['position']; ?></td>
                <td><?php echo $row_profile['id_No']; ?></td>
                <td><?php echo $row_profile['department']; ?></td>
                <td><button type="submit" class="btn btn-default">Select</button></td>
                </tr>
              <?php } while ($row_profile = mysql_fetch_assoc($profile)); ?>
          </table>
      </div>
        
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
<?php
mysql_free_result($profile);
?>
