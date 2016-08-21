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
	
  $logoutGoTo = "adminLogin.php";
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO offers (staffNo, name, `position`, department) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['staff'], "text"),
                       GetSQLValueString($_POST['fname'], "text"),
                       GetSQLValueString($_POST['poss'], "text"),
                       GetSQLValueString($_POST['depart'], "text"));

  mysql_select_db($database_connect, $connect);
  $Result1 = mysql_query($insertSQL, $connect) or die(mysql_error());

  $insertGoTo = "selectOffer.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_connect, $connect);
$query_fakulti = "SELECT name, id_No, department, `position` FROM profile WHERE department = 'fptt'";
$fakulti = mysql_query($query_fakulti, $connect) or die(mysql_error());
$row_fakulti = mysql_fetch_assoc($fakulti);
$totalRows_fakulti = mysql_num_rows($fakulti);
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
                <center>
					<button type="button" class="btn btn-info btn-sm">Upload</button>
					<button type="button" class="btn btn-success btn-sm">Save</button>
                    </center>
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
                                <a class="navbar-brand">Fakulti Pengurusan Teknologi dan Teknousahawan</a>
                            </div>
                        </div>
                    </nav>
                </div>
                
                <div class="col-md-12">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="../php/adOfferFTMK.php">FTMK</a></li>
                        <li><a href="../php/adOfferFKP.php">FKP</a></li>
                        <li><a href="../php/adOfferFKM.php">FKM</a></li>
                        <li class="active"><a href="../php/adOfferFPTT.php">FPTT</a></li>
                        <li><a href="../php/adOfferFKE.php">FKE</a></li>
                        <li><a href="../php/adOfferFKEKK.php">FKEKK</a></li>
                        <li><a href="../php/adOfferFTK.php">FTK</a></li>
                    </ul><br>
                </div>
                
                
                    <div class="col-md-12">
                        <table class="table table-striped" data-toggle="table">
                            <thead>
                              <tr>
                                <th data-field="id">Staff No</th>
                                <th data-field="name">Name</th>
                                <th data-field="Department">Department</th>
                                <th data-field="position">Position</th>
                                <th data-field="offer">Offers</th>
                                </tr>
                              </thead>
                            <tbody>
                            <?php do { ?>
                              <tr>
                                <td><?php echo $row_fakulti['id_No']; ?></td>
                                <td><?php echo $row_fakulti['name']; ?></td>
                                <td><?php echo $row_fakulti['department']; ?></td>
                                <td><?php echo $row_fakulti['position']; ?></td>
                                <td><form method="POST" action="<?php echo $editFormAction; ?>" name="form" role="form">
                                <input value="<?php echo $row_fakulti['name']; ?>" type="hidden" name="fname">
                                    <input value="<?php echo $row_fakulti['id_No']; ?>" type="hidden" name="staff">
                                    <input value="<?php echo $row_fakulti['department']; ?>" type="hidden" name="depart">
                                    <input value="<?php echo $row_fakulti['position']; ?>" type="hidden" name="poss">
                                <button type="submit" class="btn btn-default">Select</button>
                                <input type="hidden" name="MM_insert" value="form">
                                </form>
                                <?php } while ($row_fakulti = mysql_fetch_assoc($fakulti)); ?></td>
                                </tr>
                              </tbody>
                            
                          </table>

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
<?php
mysql_free_result($fakulti);
?>
