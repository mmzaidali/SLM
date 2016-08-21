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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "academic")) {
  $insertSQL = sprintf("INSERT INTO academic (fname, programme, `comment`, coursework, completion_d, commitment, integrity, discipline, work_q, ability, attendance, e_write, e_speak, overall, svName, date_submit, status) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['fname'], "text"),
                       GetSQLValueString($_POST['proStudy'], "text"),
                       GetSQLValueString($_POST['comment'], "text"),
                       GetSQLValueString($_POST['coursework'], "text"),
                       GetSQLValueString($_POST['d_completion'], "date"),
                       GetSQLValueString($_POST['commitment'], "text"),
                       GetSQLValueString($_POST['integrity'], "text"),
                       GetSQLValueString($_POST['interest'], "text"),
                       GetSQLValueString($_POST['workQuality'], "text"),
                       GetSQLValueString($_POST['ability'], "text"),
                       GetSQLValueString($_POST['attendance'], "text"),
                       GetSQLValueString($_POST['written'], "text"),
                       GetSQLValueString($_POST['spoken'], "text"),
                       GetSQLValueString($_POST['overall'], "text"),
                       GetSQLValueString($_POST['svName'], "text"),
                       GetSQLValueString($_POST['date_a'], "date"),
                       GetSQLValueString($_POST['status'], "text"));

  mysql_select_db($database_connect, $connect);
  $Result1 = mysql_query($insertSQL, $connect) or die(mysql_error());

  $insertGoTo = "svpage.php";
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

			<button class ="navbar-toggle" data-toggle="dropdown" data-target=".sidebar-collapse">
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
							<a href="academic.php">
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
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <a class="navbar-brand">Academic Performance</a>
                            </div>
                        </div>
                    </nav>
                </div>
            
                <form method="POST" action="<?php echo $editFormAction; ?>" name="academic">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Staff Name</label>
                                    <input type="text" class="form-control" name="fname" placeholder="Fullname">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Department</label>
                                    <input type="text" class="form-control" name="depart" placeholder="Department">
                            </div>
                        </div>
                    
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Programme of Study</label>
                                    <input type="text" class="form-control" name="proStudy" placeholder="Programme of Study">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-3">Comment</label><br>
                                <textarea class="form-control" row="50" name="comment" placeholder="Comment Here"></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-5">Stage of Thesis / Coursework</label><br>
                                <textarea class="form-control" row="50" name="coursework" placeholder="Write Here"></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-5">Expected of Completion</label>
                                <div class="col-md-7">
                                    <input type="date" class="form-control" name="d_completion">
                                </div>
                        </div><br><br><br>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-6">Commitment</label><br>
                                <select class="form-control" name="commitment">
                                    <option selected="Excellent">Excellent</option>
                                    <option selected="Good">Good</option>
                                    <option selected="Fair">Fair</option>
                                    <option selected="Unsatisfactory">Unsatisfactory</option>
                                    <option selected="Poor">Poor</option>
                                </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-6">Interest / Discipline</label><br>
                                <select class="form-control" name="interest">
                                    <option selected="Excellent">Excellent</option>
                                    <option selected="Good">Good</option>
                                    <option selected="Fair">Fair</option>
                                    <option selected="Unsatisfactory">Unsatisfactory</option>
                                    <option selected="Poor">Poor</option>
                                </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-6">Ability</label><br>
                                <select class="form-control" name="ability">
                                    <option selected="Excellent">Excellent</option>
                                    <option selected="Good">Good</option>
                                    <option selected="Fair">Fair</option>
                                    <option selected="Unsatisfactory">Unsatisfactory</option>
                                    <option selected="Poor">Poor</option>
                                </select>
                        </div><br>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-6">Integrity</label><br>
                                <select class="form-control" name="integrity">
                                    <option selected="Excellent">Excellent</option>
                                    <option selected="Good">Good</option>
                                    <option selected="Fair">Fair</option>
                                    <option selected="Unsatisfactory">Unsatisfactory</option>
                                    <option selected="Poor">Poor</option>
                                </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-6">Work Quality</label><br>
                                <select class="form-control" name="workQuality">
                                    <option selected="Excellent">Excellent</option>
                                    <option selected="Good">Good</option>
                                    <option selected="Fair">Fair</option>
                                    <option selected="Unsatisfactory">Unsatisfactory</option>
                                    <option selected="Poor">Poor</option>
                                </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-6">Attendance</label><br>
                                <select class="form-control" name="attendance">
                                    <option selected="Excellent">Excellent</option>
                                    <option selected="Good">Good</option>
                                    <option selected="Fair">Fair</option>
                                    <option selected="Unsatisfactory">Unsatisfactory</option>
                                    <option selected="Poor">Poor</option>
                                </select>
                        </div><br>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-4">English (Proficiency)</label>
                                <div class="col-md-4">
                                    <select class="form-control" name="written">
                                        <option selected="Excellent">Excellent</option>
                                        <option selected="Good">Good</option>
                                        <option selected="Fair">Fair</option>
                                        <option selected="Unsatisfactory">Unsatisfactory</option>
                                        <option selected="Poor">Poor</option>
                                    </select>
                                </div>
                            
                                <div class="col-md-4">
                                    <select class="form-control" name="spoken">
                                        <option selected="Excellent">Excellent</option>
                                        <option selected="Good">Good</option>
                                        <option selected="Fair">Fair</option>
                                        <option selected="Unsatisfactory">Unsatisfactory</option>
                                        <option selected="Poor">Poor</option>
                                    </select>
                                </div>
                        </div><br><br>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-8">Overall Performance</label>
                                <div class="col-md-4">
                                    <select class="form-control" name="overall">
                                        <option selected="Excellent">Excellent</option>
                                        <option selected="Good">Good</option>
                                        <option selected="Fair">Fair</option>
                                        <option selected="Unsatisfactory">Unsatisfactory</option>
                                        <option selected="Poor">Poor</option>
                                </select>
                                </div>
                        </div><br><br>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Supervisor Name</label>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="svName" placeholder="Supervisor Name">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-2">Date</label>
                                    <div class="col-md-10">
                                        <input type="date" class="form-control" name="date_a"><br>
                                    </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-2">Status</label>
                                    <div class="col-md-10">
                                        <select class="form-control" name="status">
                                            <option selected="PASS">PASS</option>
                                            <option selected="FAIL">FAIL</option>
                                        </select><br>
                                    </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-offset-5 col-sm-2 text-center">
                        <button type="submit" class="btn btn-info btn-block" name="update">Submit</button>
                    </div>
                    <input type="hidden" name="MM_insert" value="academic">
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