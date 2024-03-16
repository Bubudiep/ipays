<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ipays</title>
	<link href="src/login.css" rel="stylesheet">
	<link href="/electron/assets/lib/fontawesome/css/all.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="/electron/assets/js/app.js"></script>
</head>
<body>
  <div class="login-container">
    <div class="flex f1 flex-e">
      <div class="hint-1">
        <div class="flex-cl">
          <div class="h2">Hiệu quả</div>
          <div class="h3">Nhanh chóng</div>
          <div class="h3">Tập trung</div>
        </div>
        <div class="flex-cl g10">
          <div class="items">
            <name>1</name>
            <content>Quản lý đầu tư, lợi nhuận hiệu quá</content>
          </div>
          <div class="items">
            <name>2</name>
            <content>Tích hợp Cloud lưu trữ thông tin</content>
          </div>
          <div class="items">
            <name>3</name>
            <content>Tối ưu bán hàng</content>
          </div>
          <div class="items">
            <name>4</name>
            <content>Giải pháp đặt hàng trực tuyến</content>
          </div>
          <div class="items">
            <name>5</name>
            <content>Menu realtime, quét mã đặt bàn</content>
          </div>
        </div>
        <div class="flex"><button id="more_details">Tìm hiểu thêm<div class="arrow-wrapper"><div class="arrow"></div></div></button></div>
      </div>
      <div class="form-container">
        <div class="form">
          <div class="login-header">iPays</div>
          <div class="flex-column">
            <label>Tài khoản </label></div>
            <div class="inputForm">
              <i class="fa-solid fa-user"></i>
              <input type="text" id="user" class="input" placeholder="Enter your account...">
            </div>
          <div class="flex-column">
            <label>Mật khẩu </label></div>
            <div class="inputForm">
              <i class="fa-solid fa-lock"></i>
              <input type="password" id="pass" class="input" placeholder="Enter your password...">
              <i class="fa-regular fa-eye"></i>
            </div>
          <div class="flex-row">
            <div>
            <input id="remember" type="checkbox" checked>
            <label>Nhớ mật khẩu </label>
            </div>
            <a href="#" class="span">Quên mật khẩu?</a>
          </div>
          <button id="submit" class="button-submit">Đăng nhập</button>
          <p class="p">Chưa có tài khoản? <a href="#" class="span">Đăng ký</a>
          <t id="exit">Thoát</t>
        </form>
      </div>
    </div>
  </div>	
  <script src="src/login.js"></script>
</body>
</html>