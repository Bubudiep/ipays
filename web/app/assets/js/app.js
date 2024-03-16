var config=parseINIString(getapi("web/app.ini").responseText);
const app={};
$(document).ready(async function() {
    // Kiểm tra người dùng đã đăng nhập trước đó chưa
    // var guestID=getLocal("guestID");
    // if(!guestID||guestID==""){
    //     await sleep(3000);
    //     loginForm();
    // }
    $(".btn-login").click(async function(e) {
        loginForm();
    });
    $(".recommend-menu-item").click(async function(e) {
        const matches = document.querySelectorAll("div.recommend-menu-item");
        for (let i = 0; i < matches.length; i++) {
            matches[i].classList.remove("active");
        }
        this.classList.add("active");
    });
});
app.genQRCode=(data="panship",id="qrcode",option={
        image:"web//app/assets/img/web/icon.png",
        color:"#8563C5",
        type:"svg",
        dottype:"dots",
        startColor:"blue",
        endColor:"red",
        rotation:"45"
    },size=200) => {
    var config={
        width: size,height: size,type: "svg",
        data: data,
        image: option.image,
        dotsOptions: {
          color: option.color,
          type: option.dottype,
          gradient: {
              rotation:option.rotation,
              colorStops:[{ 
                  offset: 0, color: option.startColor 
              }, {  
                  offset: 1, color: option.endColor 
              }]
          }
        },
        cornersSquareOptions:{
            type: "extra-rounded"
        },
        cornersDotOptions:{
            type: "extra-rounded"
        },
        backgroundOptions: {
          color: "transparent",
        },
        imageOptions: {
          crossOrigin: "anonymous",
          margin: 5
        }
      }
    const qrCode = new QRCodeStyling(config);
    var iddiv=document.getElementById(id).childNodes;
    if(iddiv.length>0&&iddiv[0].nodeName=="svg"){
        qrCode.append(document.getElementById(id));
        qrCode.update(config);
    } else {
        qrCode.append(document.getElementById(id));
    }
}
async function loginForm(){
    var loginForm=`
    <div class="login-BG">
        <div class="flex" style="height: fit-content;">
            <div class="login-box">
                <div class="login-logo"><img src=`+config["APP_ICON"]+` title="logo" width="100px"><lg-name>PANSHIP</lg-name></div>
                <div class="login-hello">Chào mừng bạn trở lại!</div>
                <div class="login-box-head">Nhập số điện thoại để bắt đầu</div>
                <div class="login-box-item">
                    <input type="text" id="userPhone" name="userPhone" placeholder="Số điện thoại...">
                </div>
                <div class="login-box-item">
                    <button class="login-btn" >Bắt đầu <i class="fa-solid fa-angle-right"></i></button>
                    <button class="later-btn">Để sau</button>
                </div>
            </div>
        </div>
    </div>`;
    $("body").append(loginForm);
    await sleep(1200);
    $("#userPhone").focus();
    $(".login-btn").click(async function(){
        var createGuest=postapi("/api/user/guest.php",{
            userPhone:$("#userPhone").val()
        });
        popups(createGuest);
        // setLocal("guestID", $("#userPhone").val());
    });
    $(".later-btn").click(async function(){
        $(".login-BG").fadeOut(500);
        await sleep(500);
        $(".login-BG").remove();
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
function popups(response) {
    if (response&&response.status) {
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'No have response from server!'
        })
    }
    console.log(response);
};

function postapi(link,data) {
    var start = new Date().getTime(); // note getTime()
    return data=$.ajax({
        type: 'POST',
        url: link,
        async: false,
        dataType: "json",
        data: data,
        success: function (data) {
            return data;
        }, // prevent caching response
        complete: function(){
            var end = new Date().getTime();
            console.log(link+ " : "+(end - start)+"ms" );
        }
    });
}
function gets(link){
    var start = new Date().getTime();
    return data=$.ajax({
        type: 'GET',
        url: link,
        async: true,
        dataType: "json",
        data: "",
        success: function (data) {
            return data;
        }, // prevent caching response
        complete: function(){
            var end = new Date().getTime();
            console.log(link+ " : "+(end - start)+"ms" );
        }
    });
}
function getapi(link){
    var start = new Date().getTime();
    return data=$.ajax({
        type: 'GET',
        url: link,
        async: false,
        dataType: "json",
        data: "",
        success: function (data) {
            return data;
        }, // prevent caching response
        complete: function(){
            var end = new Date().getTime();
            console.log(link+ " : "+(end - start)+"ms" );
        }
    });
}
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}
function setLocal(name,data){
    localStorage.setItem(name,data);
}
function saveLocal(name,data){
    localStorage.setItem(name,data);
}
function getLocal(name) {
    return localStorage.getItem(name);
}
function parseINIString(data){
    var regex = {
        section: /^\s*\[\s*([^\]]*)\s*\]\s*$/,
        param: /^\s*([^=]+?)\s*=\s*(.*?)\s*$/,
        comment: /^\s*;.*$/
    };
    var value = {};
    var lines = data.split(/[\r\n]+/);
    var section = null;
    lines.forEach(function(line){
        if(regex.comment.test(line)){
            return;
        }else if(regex.param.test(line)){
            var match = line.match(regex.param);
            if(section){
                value[section][match[1]] = match[2];
            }else{
                value[match[1]] = match[2];
            }
        }else if(regex.section.test(line)){
            var match = line.match(regex.section);
            value[match[1]] = {};
            section = match[1];
        }else if(line.length == 0 && section){
            section = null;
        };
    });
    return value;
}