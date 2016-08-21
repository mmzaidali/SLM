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
    
    <!--<style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: auto;
      margin: auto;
  }
  </style>-->
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
				<ul class ="nav navbar-nav navbar-right">
					<li><a href="../php/index.php">Home</a></li>
					<li><a href="../php/about.php">About</a></li>
                    <li><a href="../php/adminLogin.php"><span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;Administrator</a></li>
				</ul>
			</div>
		</div>
	</div>

<!-- Header -->
	<div class="container">
        <div class="col-md-8">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
        <ol class="carousel-indicators" style="visibility: hidden">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

  <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
              <img src="../img/2aero.jpg" alt="#">
              <div class="carousel-caption">
              </div>
            </div>
      
            <div class="item">
              <img src="../img/iot-2.jpg" alt="#">
              <div class="carousel-caption">
              </div>
            </div>

            <div class="item">
              <img src="../img/iot.jpg" alt="#">
              <div class="carousel-caption">
              </div>
            </div>

            <div class="item">
              <img src="../img/mou.jpg" alt="#">
              <div class="carousel-caption">
              </div>
            </div>
            
            <div class="item">
              <img src="../img/student.jpg" alt="#">
              <div class="carousel-caption">
              </div>
            </div>
        </div>

  <!-- Controls -->
          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
            
          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        </div>
        
        <div class="col-md-4">
            <img src="../img/logoUTeMPNG.png" width="350" height="200" alt="">
        </div>
        
        <div  class="col-md-4"><br>
            <div class="panel-group" id="accordion">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Staff</a>
                        </h3>
                    </div>

                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body"><br>
                            <center>
                            <p>Leave Application</p>
                            <p>Submission Report</p>
                            <p><a href="../php/login.php" class="btn btn-default"><span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;Login</a></p>
                            </center>
                        </div>

                    </div>
                </div>
                
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Supervisor</a>
                        </h3>
                    </div>

                    <div id="collapse2" class="panel-collapse collapse">
                        <div class="panel-body"><br>
                            <center>
                            <p>View Progress</p>
                            <p>Academic Performance</p>
                            <p><a href="../php/svLogin.php" class="btn btn-default"><span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;Login</a></p>
                            </center>
                        </div>

                    </div>
                </div>
                
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Dean</a>
                        </h3>
                    </div>

                    <div id="collapse3" class="panel-collapse collapse">
                        <div class="panel-body"><br>
                            <center>
                            <p>View Report</p>
                            <p>Approval</p>
                            <div class="btn-group">
                                <a href="../php/dean.php" class="btn btn-default">FTMK</a>
                                <a href="../php/deanFKP.php" class="btn btn-default">FKP</a>
                                <a href="../php/deanFKE.php" class="btn btn-default">FKE</a>
                                <a href="../php/deanFKEKK.php" class="btn btn-default">FKEKK</a><br><br>
                            </div>
                            <div class="btn-group">
                                <a href="../php/deanFPTT.php" class="btn btn-default">FPTT</a>
                                <a href="../php/deanFKM.php" class="btn btn-default">FKM</a>
                                <a href="../php/deanFTK.php" class="btn btn-default">FTK</a>
                            </div>
                            </center>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
        
	</div>

<!-- Column -->
	<div class="container">
		<div class="row">
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