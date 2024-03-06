<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>iPays</title>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="assets/js/app.js"></script>
  <link href="assets/css/app.css" rel="stylesheet">
	<link href="assets/lib/fontawesome/css/all.css" rel="stylesheet">
</head>
<body>
<div class="body-container">
	<div class="top-container">
		<div class="left">
			<div class="logo">iPays</div>
		</div>
		<div class="mid"><input type="text" placeholder="Notifications..."></div>
		<div class="right">
			<div class="UI-btn"><button id="win-miniminze"><i class="fa-solid fa-minus"></i></button></div>
			<div class="UI-btn"><button id="win-min"><i class="fa-solid fa-expand"></i></button></div>
			<div class="UI-btn"><button id="win-close" class="close"><i class="fa-solid fa-xmark"></i></button></div>
		</div>
	</div>
	<div class="main-container"></div>
</div>
<div class="loadbox" id="firstload"><span class="loader"><content>iPays</content></span></div>
<script src="assets/js/index.js"></script>
</body>
</html