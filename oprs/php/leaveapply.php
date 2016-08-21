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

// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="leaveapply.php";
  $loginUsername = $_POST['staffno'];
  $LoginRS__query = sprintf("SELECT staffid FROM cuti WHERE staffid=%s", GetSQLValueString($loginUsername, "text"));
  mysql_select_db($database_connect, $connect);
  $LoginRS=mysql_query($LoginRS__query, $connect) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO cuti (fname, letterNo, staffid, department, `position`, `level`, fee, course, country, college, r_date, s_date, e_date) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['fname'], "text"),
                       GetSQLValueString($_POST['letterNo'], "text"),
                       GetSQLValueString($_POST['staffno'], "text"),
                       GetSQLValueString($_POST['depart'], "text"),
                       GetSQLValueString($_POST['position'], "text"),
                       GetSQLValueString($_POST['level'], "text"),
                       GetSQLValueString($_POST['fee'], "text"),
                       GetSQLValueString($_POST['course'], "text"),
                       GetSQLValueString($_POST['country'], "text"),
                       GetSQLValueString($_POST['institute'], "text"),
                       GetSQLValueString($_POST['register'], "date"),
                       GetSQLValueString($_POST['start'], "date"),
                       GetSQLValueString($_POST['end'], "date"));

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
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head> 


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
                    <li><a href="../php/index.php">Logout</a></li>
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
    <div class="row">
    <div class="col-lg-3">
      <div class="profile-sidebar">
        <!-- SIDEBAR USERPIC -->
        <div class="profile-userpic"> <img src="../img/oneplus2.png" class="img-circle" width="240" height="240" alt=""> </div>
        <br>
        <!-- END SIDEBAR USERPIC -->
        <!-- SIDEBAR USER TITLE -->
        <div class="profile-usertitle">
          <div class="profile-usertitle-name">
            <center>
            </center>
          </div>
        </div>
        <br>
        <!-- END SIDEBAR USER TITLE -->
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
                               <li class="list-group-item">
                                    <a href="#">Research</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
        <!-- END MENU -->
      </div>
    </div>
    <div class="col-lg-9">
		<div class="row">
            <div class="col-lg-12">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="nav-bar header"> <a class="navbar-brand">Leave Application &amp; Details Programme</a> </div>
                    </div>
                </nav>
            </div>
    
          <formPOSThod="POST"<?php echo $editFormAction; ?> action=formame="form">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="col-lg-4">Fullname:</label>
                <div class="col-lg-8">
                  <input type="text" class="form-control" name="fname" placeholder="Fullname" required>
                </div>
              </div>
              <br>
              <br>
              <div class="form-group">
                <label class="col-lg-4">Staff No:</label>
                <div class="col-lg-8">
                  <input type="text" class="form-control" name="staffno" placeholder="Staff ID" required >
                </div>
              </div>
              <br>
              <br>
              <div class="form-group">
                <label class="col-lg-4">Letter No:</label>
                <div class="col-lg-8">
                  <input type="text" class="form-control" name="letterNo" placeholder="Letter No" required >
                </div>
              </div>
              <br>
              <br>
              <div class="form-group">
                <label class="col-lg-4">Register:</label>
                <div class="col-lg-8">
                  <input type="date" class="form-control" name="register" required>
                </div>
              </div>
              <br>
              <br>
              <div class="form-group">
                <label class="col-lg-4">Institute:</label>
                <div class="col-lg-8">
                  <input type="text" class="form-control" name="institute" placeholder="Institute Name" required >
                </div>
              </div>
              <br>
              <br>
              <div class="form-group">
                <label class="col-lg-4">Fee:</label>
                <div class="col-lg-8">
                  <input type="number" class="form-control" name="fee" placeholder="RM" required>
                </div>
              </div>
              <br>
              <br>
              <div class="form-group">
                <label class="col-lg-4">Country:</label>
                <div class="col-lg-8">
                  <input type="text" class="form-control" name="country" placeholder="Country" required >
                </div>
              </div>
              <br>
              <br>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="col-lg-4">Department:</label>
                <div class="col-lg-8">
                  <input type="text" class="form-control" name="depart" placeholder="Department" required >
                </div>
              </div>
              <br>
              <br>
              <div class="form-group">
                <label class="col-lg-4">Position:</label>
                <div class="col-lg-8">
                  <input type="text" class="form-control" name="position" placeholder="Position" required >
                </div>
              </div>
              <br>
              <br>
              <div class="form-group">
                <label class="col-lg-4">Course:</label>
                <div class="col-lg-8">
                  <input type="text" class="form-control" name="course" placeholder="Course Name" required >
                </div>
              </div>
              <br>
              <br>
              <div class="form-group">
                <label class="col-lg-4">Start:</label>
                <div class="col-lg-8">
                  <input type="date" class="form-control" name="start" required>
                </div>
              </div>
              <br>
              <br>
              <div class="form-group">
                <label class="col-lg-4">End:</label>
                <div class="col-lg-8">
                  <input type="date" class="form-control" name="end" required>
                </div>
              </div>
              <br>
              <br>
              <div class="form-group">
                <label class="col-lg-4">Level of Study:</label>
                <div class="col-lg-8">
                  <select class="form-control" name="level" required>
                    <option selected="PhD">PhD</option>
                    <option selected="Degree">Degree</option>
                    <option selected="Master">Master</option>
                  </select>
                </div>
              </div>
              <br>
              <br>
            </div>
              <div action="<?php echo $editFormAction; ?>" class="col-sm-offset-5 col-sm-2 text-center">
            <button type="submit" name="submit" value="Submit" class="btn btn-info btn-md btn-block">Submit
            <input type="hidden" name="MM_insert" value="form">
            </button>
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
    <!--<script src="../js/bootstrap.js"></script>-->

</body>
</html>