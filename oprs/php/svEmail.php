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
    <div class="row profile">
		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<img src="../php/img/iphone.jpg" class="img-circle" width="240" height="240" alt="">
				</div><br>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						Marcus Doe
					</div>
					<div class="profile-usertitle-job">
						Developer
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<div class="profile-userbuttons">
					<button type="button" class="btn btn-success btn-sm">Follow</button>
					<button type="button" class="btn btn-danger btn-sm">Message</button>
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
							<a href="#">
							<i class="glyphicon glyphicon-user"></i>
							Marking </a>
						</li>
                        <li class="list-group-item">
							<a href="../php/academic.php">
							<i class="glyphicon glyphicon-user"></i>
							Academic Performance </a>
						</li>
						<li class="list-group-item">
							<a href="#">
							<i class="glyphicon glyphicon-flag"></i>
							Email </a>
						</li>
					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>
		<div class="col-md-9">
            <div class="profile-content">
                <nav class="navbar navbar-default">
                    <div class="container-fluid"></div>
                        <div class="navbar-header">
                            <a class="navbar-brand">Email</a>
                        </div>
                    </div>
                </nav>
                
                <form class="form-horizontal">
                        <div class="form-group">
                            <label for="from" class="col-lg-2 control-label">From:</label>
                            <div class="col-lg-8">
                                <input type="email" class="form-control" id="form" placeholder="you@example.com">
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label for="txtTo" class="col-lg-2 control-label">To:</label>
                            <div class="col-lg-8">
                                <input type="email" class="form-control" id="txtTo" placeholder="you@example.com">
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label for="subject" class="col-lg-2 control-label">Subject:</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="txtTo" placeholder="Subject">
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label for="message" class="col-lg-2 control-label">Message:</label>
                            <div class="col-lg-8">
                                <textarea class="form-control" row="10" id="message" placeholder="Type here"></textarea>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-info">SEND</button>
                            </div>
                        </div>
                </form><br>
                
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