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
<?php require_once('../Connections/connect.php'); ?>
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

$colname_data = "-1";

mysql_select_db($database_connect, $connect);

if (isset($_POST['txtSearch']))
{
  $colname_data = $_POST['txtSearch'];
  $query_data = "SELECT * FROM submission WHERE fname LIKE '%".$colname_data."%' OR department LIKE '%".$colname_data."%' OR staffid LIKE '%".$colname_data."%' OR svName LIKE '%".$colname_data."%' "; //only show what is being search
}
else
{
	$query_data = "SELECT * FROM submission";
}

$data = mysql_query($query_data, $connect) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
$totalRows_data = mysql_num_rows($data);
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
							<i class="glyphicon glyphicon-list-alt"></i>
							View Progress </a>
						</li>
                        <li class="list-group-item">
							<a href="../php/academic.php">
							<i class="glyphicon glyphicon-user"></i>
							Academic Performance </a>
						</li
					></ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>
		<div class="col-md-9">
            <div class="profile-content">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a class="navbar-brand">View Progress</a>
                          
                        </div>
                    </div>
                </nav>
            </div>
            
            <form name="form1" method="post" action="">
            
            <div class="col-sm-offset-5 col-sm-2 text-center">

                 <input type="text" class="form-control" name="txtSearch" id="txtSearch">
                 <button type="submit" class="btn btn-default" name="search" id="search" value="Submit"><span class="glyphicon glyphicon-search"></span></button>
                </div>
             </form>
                
            <table class="table table-striped" data-toggle="table">
                    <thead>
                        <tr>
                            <th data-field="id">Staff No</th>
                            <th data-field="name">Name</th>                        
                            <th data-field="department">Department</th>
                            <th data-field="subject1">Subject</th>
                            <th data-field="grade1">Grade</th>
                            <th data-field="subject2">Subject</th>
                            <th data-field="grade2">Grade</th>
                            <th data-field="date">Date Submission</th>
                            <th data-field="sv">Sv Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php do { ?>
                          <tr>
                            <td><?php echo $row_data['staffid']; ?></td>
                            <td><?php echo $row_data['fname']; ?></td>
                            <td><?php echo $row_data['department']; ?></td>
                            <td><?php echo $row_data['subject1']; ?></td>
                            <td><?php echo $row_data['grade1']; ?></td>
                            <td><?php echo $row_data['subject2']; ?></td>
                            <td><?php echo $row_data['grade2']; ?></td>
                            <td><?php echo $row_data['submit_date']; ?></td>
                            <td><?php echo $row_data['svName']; ?></td>
                          </tr>
                          <?php } while ($row_data = mysql_fetch_assoc($data)); ?>
                    </tbody>
                    
                </table>
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
	<script src="../js/bootstrap.js"></script>
</body>
</html>
<?php
mysql_free_result($data);
?>
