<?php 
session_start(); /* Starts the session */

//print_r($_SESSION['UserData']['Username']);
if(!isset($_SESSION['UserData']['Username'])){
header("location:login.php");

exit;
}

?>

<html xmlns="">
<head>
<title>InaTEWS-WRS</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/leaflet.css"/>
<script src="js/leaflet.js"></script>
<script src="js/esri-leaflet.js"></script>
<script src="js/jquery-2.2.4.min.js" ></script>
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/all.min.css"/>
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/L.Icon.Pulse.css"/>
<script src="js/jquery.cookie.js"></script>
<link rel="stylesheet" href="css/melki5.css">
<script src="js/offline.min.js"></script>
<script src="js/d3.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/sidebar_left.css">
<link rel="stylesheet" href="css/stylec.css"/>
<script src="js/chroma.min.js"></script>
<script src="js/moment.min.js"></script>
<script src="js/id.min.js"></script>
<link rel="stylesheet" href="css/gly.min.css">
<script src="js/leaflet-tilelayer-colorfilter.min.js"></script>

</head>
<script>
    $(document).ready(function(){
      $(".preloader").fadeOut();
    })
    </script>
<body>
<div class="preloader">
	<div class="loading">
		<div class="Box">
			<span></span>
			<span></span>
			<span></span>
			<span></span>
			<span></span>
			<span></span>
		</div>
		<h2 style="margin-left:15%">INITIALIZING</h2>
	</div>
</div>



<div id="map" style="width:100%;"></div>
<div id="" style="background: none;">
	<div id="newwrs" style="margin-top:0px; margin-bottom:10px;">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="card" style="margin-bottom:0px; padding-bottom:0px;">
						<div class="card-block" style =" background-color:#ebe236;">
							<div class="col-md-12" style="margin-left:0px; padding-left:0px;">
								<div class="row" style="margin-left:0px; padding-left:0px;">
									<div class="col-md-3" style="margin-left:0px; background-color:#bd2109;">
										<h1 class="card-text good-review-score float-left" id="mag" style="margin: 0 10px 0px -15px; font-size:290%; font-weight: bold;"></h1>
									</div>
									<div class="col-md-9" style="margin-left:0px;">
										<h5 class="card-title" style="margin-bottom:0px; font-size:90%; background-color:#ebe236; padding: 5px 0 5px 0;">INFO RESMI BMKG</h5>
										<h4 class="card-title" style="margin-bottom:0px; font-size:110%; background-color:#ebe236; text-transform: uppercase;" id="judul"></h4>
										<p class="card-text" id="timelapse" style="font-size:75%; color:green; margin-bottom:0px;"></p>
										<p class="card-text" id="elapse" style="font-size:75%; color:red; margin-bottom:0px;"></p>
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer" style="padding: 0px 0px 0px 0px;">
							<div id="mapshake" style="width:100%; height:240px;"></div>
						</div>
						<div class="card-block" style="">
							<div class="col-md-12" style="height:9%; background:#f0faaf; padding-bottom:0px; padding-top:5px;">
								<div class="row">
									<div class="col-md-4">
										<div id="" style="margin-bottom:0px; padding-bottom:0px;">
											<p style="font-size:70%; color:black; margin-bottom:0px;">Waktu Gempa</p>
										</div>
										<div  style="font-size:80%;">
											<p id="tanggal" align="center" style=" margin-bottom:0px;"></p>
										</div>
									</div>
									<div class="col-md-4">
										<div id="" style="margin-bottom:0px; padding-bottom:0px;">
											<p align="center"style="font-size:80%; color:black; margin-bottom:0px;">Lokasi</p>
										</div>
										<div  style="font-size:80%;">
											<p id="point" align="center"></p>
										</div>
									</div>
									<div class="col-md-4">
										<div id="" style="margin-bottom:0px; padding-bottom:0px;">
											<p style="font-size:80%; color:black; margin-bottom:0px;">Kedalaman</p>
										</div>
										<div  id="depth" style="font-size:90%;"></div>
									</div>
								</div>
							</div>
						</div>
						<a data-toggle="modal" href="#myModal" class="manual">
						<div class="card-block">
							<div class="col-md-12" style="background:#eb8817;">
								<p id="deskripsi" style="font-size:80%; color:black; margin-bottom:0px; padding: 2 2 2 2 ;"></p>
							</div>
						</div>
						<div class="card-block" style="">
							<div class="col-md-12" style="background:#f03d3a; padding-bottom:0px;">
								<div class="row">
									<div class="col-md-12 square alert" style="margin-bottom:0px; background-color:; ">
										<div >
											<span style="color: white; "><i class="fas fa-exclamation-triangle "></i></span>
										</div>
										<div class="blink">
											<span style="animation: blink 1.5s linear infinite;">
											<p style="color:black; margin-bottom:0px;" id="potential"></p>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="card-block" style="">
							<div class="col-md-12" style="background:#e8ed47; padding-bottom:0px;">
								<div class="row">
									<div class="col-md-12 square alert" style="margin-bottom:0px; background-color:;">
										<div >
											<span style="color: green; "><i class="fa fa-bullhorn"></i></span>
										</div>
										<div>
											<p style="color:black; margin-bottom:0px;" id="instruction"></p>
										</div>
									</div>
								</div>
							</div>
						</div>
						</a>
						<div class="card-block" style="">
							<div class="col-md-12" style="background:; padding-bottom:0px; padding-top:10px;">
								<div class="row">
									<div class="col-md-5" style="background-color:; margin-bottom:0px; padding-bottom:0px; height:20px;">
										<a data-toggle="modal" href="#modal4" class="manual"><p style="font-size:100%; color:black; margin-bottom:0px;">WRS Website</p></a>
									</div>
									<div class="col-md-4" style="background-color:; margin-bottom:0px; padding-bottom:0px; height:auto;">
										<a data-toggle="modal" href="#modal5" class="manual"><p style="font-size:100%; color:black;">Skala MMI</p></a>
									</div>
									<div class="col-md-3" style="background-color:; margin-top:0px; padding-bottom:0px; height:auto;">
										<a data-toggle="modal" href="#modal3" class="manual">
										<p style="font-size:100%; color:black;">
											Glosary
											<p></a>
											</div>
										</div>
										<p style="font-size:80%; color:black; margin:0 0 0px 0; padding:0 0 0 0;">
											&copy; 2020 BMKG	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp; 	&nbsp;<a href="ceklogin.php">Logout</a>
											<p></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="" style="background: none;">
					<div id="sidebar_left" style="margin-top:0px; margin-bottom:10px;"></div>
				</div>
				</body>
				<script src="js/leaflet-providers.js"></script>
				<script src="js/leaflet-realtime.js"></script>
				<script src="js/earthquakes.js"></script>
				<script src="js/L.Icon.Pulse.js"></script>
				<!-- Modal PERINGATAN DINI TSUNAMi -->
				<div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<link rel="stylesheet" href="css/modalwrs.css">
						<div id="pd1" class="modal-content" style="background-color:none; padding: 0 0 0 0; margin: 0 0 0 0; height:600px"></div>
					</div>
				</div>
				<!-- Modal PERINGATAN DINI TSUNAMi 2-->
				<div id="modal2" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<link rel="stylesheet" href="css/modalwrs.css">
						<div id="isi2" class="modal-content" style="background-color:none; padding: 0 0 0 0; margin: 0 0 0 0; height:600px"></div>
					</div>
				</div>
				<!-- Modal Glosary-->
				<div id="modal3" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<link rel="stylesheet" href="css/modalwrs.css">
						<div id="isi3" class="modal-content" style="background-color:none; padding: 0 0 0 0; margin: 0 0 0 0; height:600px"></div>
					</div>
				</div>
				<!-- Modal MENULINK-->
				<div id="modal4" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<link rel="stylesheet" href="css/modalwrs.css">
						<div id="isi4" class="modal-content" style="background-color:none; padding: 0 0 0 0; margin: 0 0 0 0; height:700px"></div>
					</div>
				</div>
				<!-- Modal MMI-->
				<div id="modal5" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<link rel="stylesheet" href="css/modalwrs.css">
						<div id="isi5" class="modal-content" style="background-color:none; padding: 0 0 0 0; margin: 0 0 0 0; height:750px"></div>
					</div>
				</div>
	<script src="js/jquery.home.js"></script> 
</html>

