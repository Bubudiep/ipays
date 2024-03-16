<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $app["APP_TITLE"]." | ".$app["APP_NAME"];?></title>
    <link rel="icon" type="image/png" sizes="76x76" href="<?php echo $app['APP_ICON'];?>" title="icon">
    <link rel="stylesheet" href="app/lib/animate.min.css">
    <link rel="stylesheet" href="app/lib/font/css/all.min.css">
    <script src="app/lib/sweetalert2.js"></script>
    <script src="app/lib/jquery-3.6.1.min.js"></script>
    <link rel="stylesheet" href="app/assets/css/app.css">
    <script src="app/assets/js/app.js"></script>
</head>
<body>
    <div class="login-BG">
        <div class="flex" style="height: fit-content;">
            <div class="login-box">
                <div class="login-logo"><img src="<?php echo $app['APP_ICON'];?>" title="logo" width="100px"><lg-name>PANSHIP</lg-name></div>
                <div class="login-hello">Chào mừng bạn trở lại!</div>
                <div class="login-box-head">Nhập số điện thoại để bắt đầu</div>
                <div class="login-box-item">
                    <input type="text" id="userPhone" name="userPhone" placeholder="Số điện thoại...">
                </div>
                <div class="login-box-item">
                    <button class="login-btn">Bắt đầu <i class="fa-solid fa-angle-right"></i></button>
                    <button class="later-btn">Để sau</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>