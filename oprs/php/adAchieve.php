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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "pass")) {
  $insertSQL = sprintf("INSERT INTO achievement (name, staffNo, department, `position`) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['staffno'], "text"),
                       GetSQLValueString($_POST['depart'], "text"),
                       GetSQLValueString($_POST['poss'], "text"));

  mysql_select_db($database_connect, $connect);
  $Result1 = mysql_query($insertSQL, $connect) or die(mysql_error());

  $insertGoTo = "adAchieve.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "formUpdate")) {
  $updateSQL = sprintf("UPDATE achievement SET `level`=%s, major_course=%s, college=%s, country=%s, `language`=%s, d_start=%s, d_end=%s, results=%s, cgpa=%s, duration=%s, name=%s, department=%s, `position`=%s WHERE staffNo=%s",
                       GetSQLValueString($_POST['level'], "text"),
                       GetSQLValueString($_POST['course'], "text"),
                       GetSQLValueString($_POST['college'], "text"),
                       GetSQLValueString($_POST['country'], "text"),
                       GetSQLValueString($_POST['language'], "text"),
                       GetSQLValueString($_POST['s_date'], "text"),
                       GetSQLValueString($_POST['e_date'], "text"),
                       GetSQLValueString($_POST['result'], "text"),
                       GetSQLValueString($_POST['cgpa'], "text"),
                       GetSQLValueString($_POST['duration'], "int"),
                       GetSQLValueString($_POST['fname'], "text"),
                       GetSQLValueString($_POST['depart'], "text"),
                       GetSQLValueString($_POST['position'], "text"),
                       GetSQLValueString($_POST['id_no'], "text"));

  mysql_select_db($database_connect, $connect);
  $Result1 = mysql_query($updateSQL, $connect) or die(mysql_error());

  $updateGoTo = "adminPage.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_connect, $connect);
$query_achieve = "SELECT * FROM achievement ORDER BY idachievement DESC";
$achieve = mysql_query($query_achieve, $connect) or die(mysql_error());
$row_achieve = mysql_fetch_assoc($achieve);
$totalRows_achieve = mysql_num_rows($achieve);

$colname_rsAchieve = "-1";
mysql_select_db($database_connect, $connect);

if (isset($_POST['carian']))
{
  $colname_rsAchieve = $_POST['carian'];
  $query_rsAchieve = "SELECT * FROM profile WHERE name LIKE '%".$colname_rsAchieve."%' OR department LIKE '%".$colname_rsAchieve."%' OR id_No LIKE '%".$colname_rsAchieve."%' ";
}
else
{
	$query_rsAchieve = "SELECT * FROM profile";
}
$rsAchieve = mysql_query($query_rsAchieve, $connect) or die(mysql_error());
$row_rsAchieve = mysql_fetch_assoc($rsAchieve);
$totalRows_rsAchieve = mysql_num_rows($rsAchieve);
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
                                <a class="navbar-brand">Achievement</a>
                            </div>
                        </div>
                    </nav>
                </div>
                
                
                
                <div class="col-sm-offset-5 col-sm-2 text-center">
                    <button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#myModal">Search</button><br>
                </div>
                
               
                
              <form method="POST" action="<?php echo $editFormAction; ?>" name="formUpdate">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-4">Name</label><br>
                                <input value="<?php echo $row_achieve['name']; ?>" type="text" class="form-control" name="fname" placeholder="Fullname">
                        </div>

                        <div class="form-group">
                            <label class="col-md-4">Department</label><br>
                                <input value="<?php echo $row_achieve['department']; ?>" type="text" class="form-control" name="depart" placeholder="Department">
                        </div>

                        <div class="form-group">
                            <label class="col-md-4">Level</label><br>
                                <select class="form-control" name="level" placeholder="Level">
                                    <option selected="PhD">PhD</option>
                                    <option selected="Master">Master</option>
                                    <option selected="Degree">Degree</option>
                                </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4">Course</label><br>
                                <input value="<?php echo $row_achieve['major_course']; ?>" type="text" class="form-control" name="course" placeholder="Course Name">
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4">University</label><br>
                                <input value="<?php echo $row_achieve['college']; ?>" type="text" class="form-control" name="college" placeholder="University Name">
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4">Country</label><br>
                                <input value="<?php echo $row_achieve['country']; ?>" type="text" class="form-control" name="country" placeholder="CountryName">
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4">Language</label><br>
                                <input value="<?php echo $row_achieve['language']; ?>" type="text" class="form-control" name="language" placeholder="Language">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-4">Staff ID</label><br>
                                <input value="<?php echo $row_achieve['staffNo']; ?>" type="text" class="form-control" name="id_no" placeholder="Staff ID">
                        </div>

                        <div class="form-group">
                            <label class="col-md-4">Position</label><br>
                                <input value="<?php echo $row_achieve['position']; ?>" type="text" class="form-control" name="position" placeholder="Position">
                        </div>

                        <div class="form-group">
                            <label class="col-md-4">Start</label><br>
                                <input type="date" class="form-control" name="s_date">
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4">End</label><br>
                                <input type="date" class="form-control" name="e_date">
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4">Result</label><br>
                                <select class="form-control" name="result">
                                    <option selected="Passed">Passed</option>
                                    <option selected="Failed">Failed</option>
                                </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4">CGPA</label><br>
                                <input value="<?php echo $row_achieve['cgpa']; ?>" type="text" class="form-control" name="cgpa" placeholder="CGPA">
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4">Duration</label><br>
                                <input value="<?php echo $row_achieve['duration']; ?>" type="number" class="form-control" name="duration" placeholder="Duration Study">
                        </div>
                    </div>
                    
                    <div class="col-sm-offset-5 col-sm-2 text-center">
                        <button type="submit" class="btn btn-warning btn-block" name="delete">Update</button>
                    </div>
                    <input type="hidden" name="MM_update" value="formUpdate">
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
              <td><?php echo $row_rsAchieve['idprofile']; ?></td>
              <td><?php echo $row_rsAchieve['name']; ?></td>
              <td><?php echo $row_rsAchieve['position']; ?></td>
              <td><?php echo $row_rsAchieve['id_No']; ?></td>
              <td><?php echo $row_rsAchieve['department']; ?></td>
              <td><form method="POST" action="<?php echo $editFormAction; ?>" name="pass">
              <input type="hidden" name="name" value="<?php echo $row_rsAchieve['name']; ?>">
              <input type="hidden" name="poss" value="<?php echo $row_rsAchieve['position']; ?>">
              <input type="hidden" name="staffno" value="<?php echo $row_rsAchieve['id_No']; ?>">
              <input type="hidden" name="depart" value="<?php echo $row_rsAchieve['department']; ?>">
              <button type="submit" class="btn btn-default">Select</button>
              <input type="hidden" name="MM_insert" value="pass">
              </form></td>
            </tr>
            <?php } while ($row_rsAchieve = mysql_fetch_assoc($rsAchieve)) ?>
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
mysql_free_result($achieve);

mysql_free_result($rsAchieve);
?>
