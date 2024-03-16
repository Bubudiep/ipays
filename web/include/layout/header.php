<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $app["APP_TITLE"]." | ".$app["APP_NAME"];?></title>
    <link rel="icon" type="image/png" sizes="76x76" href="<?php echo $app['APP_ICON'];?>" title="icon">
    <link rel="stylesheet" href="app/lib/animate.min.css">
    <link rel="stylesheet" href="app/lib/font/css/all.min.css">
    <link rel="stylesheet" href="app/lib/select2.min.css">
    <link rel="stylesheet" href="app/assets/css/app.css">
    <script src="app/lib/jquery-3.6.1.min.js"></script>
    <script src="app/lib/sweetalert2.js"></script>
    <script src="app/lib/select2.min.js"></script>
    <script src="app/assets/js/app.js"></script>
    <script src="app/lib/socket.io.js"></script>
    <script>
      var socket = io.connect('ws://localhost:3210');// clent khởi tạo kết nối socket đến server
      socket.on('news', function (data) { // lắng nghe event 'news' được server gửi đến
        console.log(data); // log data để kiểm tra
      });
      $(document).ready(function () {
        $('#send_private').click(function(){
          socket.emit('private',  $('#data').val()); // gửi event 'private'
        });
        $('#send_broadcast').click(function(){
          console.log("send_broadcast");
          socket.emit('broadcast',  $('#data').val()); // gửi event 'broadcast'
        });
        $('#send_all_client').click(function(){
          socket.emit('all client',  $('#data').val()); // gửi event 'all client'
        });
      });
    </script>
</head>
<body>