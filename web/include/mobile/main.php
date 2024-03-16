<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $app["APP_TITLE"]." | ".$app["APP_NAME"];?></title>
    <link rel="icon" type="image/png" sizes="76x76" href="<?php echo $app['APP_ICON'];?>" title="icon">
    <link rel="stylesheet" href="web/app/lib/animate.min.css">
    <link rel="stylesheet" href="web/app/lib/font/css/all.min.css">
    <link rel="stylesheet" href="web/app/lib/select2.min.css">
    <link rel="stylesheet" href="web/app/assets/css/mobile.css">
    <script src="web/app/lib/jquery-3.6.1.min.js"></script>
    <script src="web/app/lib/jquery-ui.js"></script>
    <script src="web/app/lib/sweetalert2.js"></script>
    <script src="web/app/lib/qrcode.min.js"></script>
    <script src="web/app/lib/select2.min.js"></script>
    <script src="web/app/assets/js/app.js"></script>
    <link rel="stylesheet" href="web/node_modules/keen-slider/keen-slider.min.css"/>
    <script src="web/node_modules/keen-slider/keen-slider.js"></script>
    <script src="web/node_modules/qr-code-styling/lib/qr-code-styling.js"></script>
</head>
<body>
  <div class="app-body">
    <div class="app-top">
      <div class="top-container">
        <div class="flex-c flex1">
          <div class="t1">Xin chào, <name>Hùng a</name></div>
        </div>
        <div class="flex gap5">
          <div class="top-item carot"><i class="fa-solid fa-carrot"></i><coin>99</coin></div>
          <div class="top-item"><i class="fa-solid fa-cart-shopping"></i><coin>99</coin></div>
        </div>
      </div>
    </div>
    <div class="tab-panel"></div>
    <div class="app-bottom">
      <div class="bot-container">
        <div class="bot-item" id="home-tab">
          <logo><i class="fa-solid fa-house"></i></logo>
          <name>Trang chủ</name>
        </div>
        <div class="bot-item" id="ads-tab">
          <logo><i class="fa-solid fa-comments-dollar"></i></logo>
          <name>Rao vặt</name>
        </div>
        <div class="bot-item" id="item-bag-tab">
          <logo><i class="fa-solid fa-bag-shopping"></i></logo>
          <name>Tạp hóa</name>
        </div>
        <div class="bot-item" id="bookmark-tab">
          <logo><i class="fa-regular fa-bookmark"></i></logo>
          <name>Đã lưu</name>
        </div>
        <div class="bot-item" id="account-tab">
          <logo><i class="fa-solid fa-user"></i></logo>
          <name>Tài khoản</name>
        </div>
      </div>
    </div>
  </div>
<script type="text/javascript">
$(document).ready(async()=>{
  var QRcode=await findGetParameter("QR");
  if (QRcode){
    loadTab("qr");
  } else {
    loadTab("home");
  }
  $("#home-tab").click(async()=>{ loadTab("home",false); })
  $("#bookmark-tab").click(async()=>{ loadTab("bookmark",true); })
  $("#item-bag-tab").click(async()=>{ loadTab("item-bag",true); })
  $("#account-tab").click(async()=>{ loadTab("account",true); })
  $("#ads-tab").click(async()=>{ loadTab("ads",true); })
});
async function findGetParameter(parameterName) {
  var result = null, tmp = [];
  location.search
      .substr(1)
      .split("&")
      .forEach(function (item) {
        tmp = item.split("=");
        if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
      });
  return result;
}
async function loadTab(name,reload){
  var aTab=document.getElementsByClassName("tab-panel")[0].childNodes;
  if(aTab.length>0){
    var match=0;
    for(var i=0; i<aTab.length;i++){
      if (aTab[i].id==name){
        match++;
      }
    }
    if(match>0){
      for(var i=0; i<aTab.length;i++){
        aTab[i].classList.remove("active");
      }
      document.getElementById(name).classList.add("active");
      if(reload){
        $("#"+name).load("web/include/mobile/layout/"+name+".php");
      }
    } else {
      for(var i=0; i<aTab.length;i++){
        aTab[i].classList.remove("active");
      }
      $(".tab-panel").append(`<div class="app-main active" id="${name}"></div>`);
      $("#"+name).load("web/include/mobile/layout/"+name+".php");
    }
  } else {
    $(".tab-panel").append(`<div class="app-main active" id="${name}"></div>`);
    $("#"+name).load("web/include/mobile/layout/"+name+".php");
  }
}
</script>
</body>
</html>