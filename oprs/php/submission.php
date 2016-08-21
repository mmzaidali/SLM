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
	
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "course")) {
  $insertSQL = sprintf("INSERT INTO submission (fname, staffid, department, program_c, date_c, sem_year, svName, subject1, subject2, subject3, code1, code2, code3, credit1, credit2, credit3, grade1, grade2, grade3, submit_date) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['fname'], "text"),
                       GetSQLValueString($_POST['staffid'], "text"),
                       GetSQLValueString($_POST['depart'], "text"),
                       GetSQLValueString($_POST['credit'], "int"),
                       GetSQLValueString($_POST['accumulated'], "int"),
                       GetSQLValueString($_POST['semester'], "text"),
                       GetSQLValueString($_POST['svName'], "text"),
                       GetSQLValueString($_POST['subject1'], "text"),
                       GetSQLValueString($_POST['subject2'], "text"),
                       GetSQLValueString($_POST['subject3'], "text"),
                       GetSQLValueString($_POST['code1'], "text"),
                       GetSQLValueString($_POST['code2'], "text"),
                       GetSQLValueString($_POST['code3'], "text"),
                       GetSQLValueString($_POST['credit1'], "int"),
                       GetSQLValueString($_POST['credit2'], "int"),
                       GetSQLValueString($_POST['credit3'], "int"),
                       GetSQLValueString($_POST['grade1'], "text"),
                       GetSQLValueString($_POST['grade2'], "text"),
                       GetSQLValueString($_POST['grade3'], "text"),
                       GetSQLValueString($_POST['submit_date'], "date"));

  mysql_select_db($database_connect, $connect);
  $Result1 = mysql_query($insertSQL, $connect) or die(mysql_error());

  $insertGoTo = "userprofile.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
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
					<img src="../img/logo_deezer.png" class="img-circle" width="240" height="240" alt="">
				</div><br>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
			  <div class="profile-usertitle">
					<div class="profile-usertitle-name">
						<center></center>
					</div>
			  </div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<div class="profile-userbuttons">
                    <!--<center>
					<button type="button" class="btn btn-info btn-sm">Upload</button>
					<button type="button" class="btn btn-success btn-sm">Save</button>
                    </center>-->
			  </div><br>
				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				<div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseInfo"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Leave</a>
                            </h4>
                        </div>
                        
                        <div id="collapseInfo" class="panel-collapse collapse out">
					       <ul class="list-group">
						      <li class="list-group-item">
                                  <a href="../php/leaveapply.php">New Application</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOff"><span class="glyphicon glyphicon-folder-close"></span>&nbsp;&nbsp;Submission Report</a>
                            </h4>
                        </div>
                        
                        <div id="collapseOff" class="panel-collapse collapse out">
					       <ul class="list-group">
                               <li class="list-group-item">
                                    <a href="../php/submission.php">Coursework</a></li>
                               <!--<li class="list-group-item">
                                    <a href="#">Research</a></li>-->
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
                            <div class="nav-bar header"> <a class="navbar-brand">Coursework Only&nbsp;<small>&#40;If Applicable&#41;</small></a> </div>
                        </div>
                    </nav>
                </div>
                
                <form action="<?php echo $editFormAction; ?>" method="POST" name="course" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control" name="fname" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Department</label>
                                <input type="text" class="form-control" name="depart" required>
                            </div><br>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Staff ID</label>
                                <input type="text" class="form-control" name="staffid" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Supervisor Name</label>
                                <input type="text" class="form-control" name="svName" required>
                            </div><br>
                        </div>
                    </div>
                    
                    <div class="col-md-1">
                    
                    </div>
                    
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Total credits/subjects required to complete the programme&nbsp;:</label>
                            
                        </div>

                        <div class="form-group">
                            <label>Total credits/subjects accumulated to date&nbsp;:</label>
                            
                        </div>

                        <div class="form-group">
                            <label>Subjects/examination results for this semester/year&nbsp;:</label>
                            
                        </div><br>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="number" class="form-control" name="credit" required>
                            <input type="number" class="form-control" name="accumulated" required>
                            <input type="text" class="form-control" name="semester" placeholder="Eg. 1/2015" required><br>
                            
                        </div>
                    </div>
                    
                    <div class="col-md-1">
                    
                    </div>
                    
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Subject(s)</label>
                            </div>
                            
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject1">
                            </div>
                            
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject2">
                            </div>
                            
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject3">
                            </div><br>
                        </div>
                        
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Code</label>
                            </div>
                            
                            <div class="form-group">
                                <input type="text" class="form-control" name="code1">
                            </div>
                            
                            <div class="form-group">
                                <input type="text" class="form-control" name="code2">
                            </div>
                            
                            <div class="form-group">
                                <input type="text" class="form-control" name="code3">
                            </div><br>
                        </div>
                        
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Credit</label>
                            </div>
                            
                            <div class="form-group">
                                <input type="number" class="form-control" name="credit1">
                            </div>
                            
                            <div class="form-group">
                                <input type="number" class="form-control" name="credit2">
                            </div>
                            
                            <div class="form-group">
                                <input type="number" class="form-control" name="credit3">
                            </div><br>
                        </div>
                        
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Grade</label>
                            </div>
                            
                            <div class="form-group">
                                <input type="text" class="form-control" name="grade1">
                            </div>
                            
                            <div class="form-group">
                                <input type="text" class="form-control" name="grade2">
                            </div>
                            
                            <div class="form-group">
                                <input type="text" class="form-control" name="grade3">
                            </div><br>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="col-md-2"></div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date of submission</label>
                            </div><br>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="date" class="form-control" name="submit_date">
                            </div><br>
                        </div>
                        
                        <div class="col-md-2"></div>
                    </div>
                    
                    <div class="col-sm-offset-5 col-sm-2 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <input type="hidden" name="MM_insert" value="course">
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