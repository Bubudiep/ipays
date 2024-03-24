const app={};
const ipc = window.ipc;
const api_port = 8001;
const protocal="http:";
const list_services=[];

app.getcookie=function(name){
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(';').shift();
}
const token=app.getcookie('token');
app.user= async function(){
  var user= await app.get("i/users/");
  return user;
};
app.post=async function(uri,data,headers={Authorization: token,}){
  var start = new Date().getTime(); // note getTime()
  return ($.ajax({
    type: "POST",
    url: `${protocal}//${location.hostname}:${api_port}/${uri}`,
    async: true,
    headers: headers,
    dataType: "json",
    data: data,
    success: function (data) {
      return data;
    }, // prevent caching response
    complete: function () {
      var end = new Date().getTime();
      console.log(uri + " : " + (end - start) + "ms");
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(jqXHR)
    }
  }));
}
app.patch=async function(uri,data){
  var start = new Date().getTime(); // note getTime()
  return await $.ajax({
    type: "PATCH",
    url: `${protocal}//${location.hostname}:${api_port}/${uri}`,
    async: true,
    headers: {
      Authorization: token,
    },
    dataType: "json",
    data: data,
    success: function (data) {
      return data;
    }, // prevent caching response
    complete: function () {
      var end = new Date().getTime();
      console.log(uri + " : " + (end - start) + "ms");
    },
  });
}
app.get=async function(uri){
  var fixuri=uri;
  if(uri[0]!='h'){
    var fixuri=`${protocal}//${location.hostname}:${api_port}/${uri}`;
  }
  var start = new Date().getTime(); // note getTime()
  return await $.ajax({
    type: "GET",
    url: fixuri,
    async: true,
    dataType: "json",
    headers: {
      Authorization: token,
    },
    success: function (data) {
      return data;
    }, // prevent caching response
    complete: function (data) {
      var end = new Date().getTime();
      console.log(`${fixuri}` + (end - start) + "ms");
      return data;
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(jqXHR)
    }
  });
}
app.addService= async function(svcs){
  switch(svcs){
    case 'restaurant':
      var view=`<div class='white-box'>
      <div class='content_all'>
        <div class='head'>Đăng ký nhà hàng / quán ăn mới</div>
        <div class='form'>
          <div class="items center">
            <div class='avatar'>
              <label for='avatar_img' id='avt-preview'>Chọn ảnh đại diện</label>
              <input type='file' name='avatar_img' id='avatar_img' accept="image/*">
            </div>
          </div>
          <div class='items'>
            <div class='items_name'>Tên quán</div>
            <div class='items_input'><input id='store_name' type="text" placeholder="tên quán của bạn"></div>
            <div class='items_input'><input id='store_sologan' type="text" placeholder="sologan của quán (vd: ngon hết nước chấm,...)"></div>
            <div class='items_name'>Địa chỉ quán</div>
            <div class='items_select'>
              <select id='addr-tinh'><option value="">-- Tỉnh --</option></select>
              <select id='addr-huyen'><option value="">-- Huyện/ Thành phố --</option></select>
              <select id='addr-xa'><option value="">-- Xã/Phưởng --</option></select>
              <select id='addr-thon'><option value="">-- Thôn/Đường --</option></select>
              <input id='addr-details' type="text" placeholder="vị trí chính xác">
            </div>
            <div class='items_name'>Kho</div>
            <div class='items_select'>
              <input type="checkbox" checked> Tạo kho mới hoặc chọn 
              <select disabled><option>-- Kho đang sở hữu --</option></select>
            </div>
            <div class='items_name'>SĐT đặt hàng</div>
            <div class='items_input'>+84 <input id='store_phone' type="text" placeholder="343123123" maxlength=10></div>
            <div class='items_name'>Zalo</div>
            <div class='items_input'>+84 <input id='store_zalo' type="text" placeholder="343123123" maxlength=10></div>
            <div class='items_name'>Facebook link</div>
            <div class='items_input'>fb.com/<input id='store_facebook' type="text" placeholder="myprofile"></div>
            <div class='items_name'>Mô tả</div>
            <div class='items_input'><textarea id="store_des" spellcheck=false placeholder="mô tả quán ăn của bạn"></textarea></div>
          </div>
        </div>
        <div class='flex acenter mg10'>
          <div class='flex' id='rs_message'></div>
          <div class='right'>
            <button id="create_Store" class="next">Tiếp tục <div class="arrow-wrapper"><div class="arrow"></div></div></button>
          </div>
        </div>
      </div></div>`;
      app.view(view);
      $("#avatar_img").change(async function(){
        console.log(this.files[0])
        var img_data=await app.compressIMAGE(this.files[0],"avt-preview");
      });
      var tryCreate=0;
      $("#create_Store").click(async function(){
        var rd="ELT-ER-"+app.random(10);
        try {
          this.innerHTML = `Chờ chút <div class="inloader"></div><div class="onloader"></div>`;
          // Kiểm tra dữ liệu nhập vào
          var img=$("#avatar_img").prop('files')[0];
          var checkInput=true;
          if (checkInput){
            if (img==""||img==null){
              $("#rs_message").html(`<red>Avatar bạn không được để trống</red>`);
              tryCreate++;
              this.innerHTML = `Thử lại (${tryCreate}) <div class="arrow-wrapper"><div class="arrow"></div></div>`;
              return false;
            }
            if (img.type.split("/")[0]!="image"){
              $("#rs_message").html(`<red>Avatar bạn chọn không phải ảnh</red>`);
              tryCreate++;
              this.innerHTML = `Thử lại (${tryCreate}) <div class="arrow-wrapper"><div class="arrow"></div></div>`;
              return false;
            }
            if ($("#store_name").val()==""){
              $("#rs_message").html(`<red>Tên cửa hàng không được để trống!</red>`);
              $("#store_name").focus();
              tryCreate++;
              this.innerHTML = `Thử lại (${tryCreate}) <div class="arrow-wrapper"><div class="arrow"></div></div>`;
              return false;
            }
            if ($("#addr-tinh").val()==""||$("#addr-huyen").val()==""||$("#addr-xa").val()==""||$("#addr-thon").val()==""||$("#addr-details").val()==""){
              $("#rs_message").html(`<red>Vui lòng chọn địa chỉ kinh doanh của bạn!</red>`);
              tryCreate++;
              this.innerHTML = `Thử lại (${tryCreate}) <div class="arrow-wrapper"><div class="arrow"></div></div>`;
              return false;
            }
          }
          var img_data=await app.compressIMAGE(img);
          var dtcreate={
            file_name: img.name,
            file_type: img.type,
            file_size: img.size,
            img: img_data,
          }
          // đăng ký services
          var upload_img=await app.post("i/Photos/",dtcreate);
          if (upload_img&&upload_img.id){ // upload avatars successfully
            var dtcreate={
              Avatar: upload_img.id,
              ServiceCode: "NhaHang",
              Name: $("#store_name").val(),
              comment: $("#store_des").val(),
              Sologan: $("#store_sologan").val(),
              adr_tinh: $("#addr-tinh").val(),
              adr_huyen: $("#addr-huyen").val(),
              adr_xa: $("#addr-xa").val(),
              adr_thon: $("#addr-thon").val(),
              adr_details: $("#addr-details").val(),
              Hotline: $("#store_phone").val(),
              Zalo: $("#store_zalo").val(),
              Facebook: $("#store_facebook").val(),
            }
            var create_Store = await app.post("i/UserServices/",dtcreate);
            if (create_Store.id){
              list_services.push(create_Store);
              app.reloadServices();
            }
          }
        } catch (e) {
          console.log(e)
          try {
            $("#rs_message").html(`<red>${e.responseJSON}</red>`);
            return false;
          } catch (e2) {
            $("#rs_message").html(`<red>Phát sinh lỗi không xác định (Mã lỗi: ${rd})</red>`);
            return false;
          }
        }
      });
      break;
    default: break;
  }
}
app.random=function (length) {
  let result = '';
  const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  const charactersLength = characters.length;
  let counter = 0;
  while (counter < length) {
    result += characters.charAt(Math.floor(Math.random() * charactersLength));
    counter += 1;
  }
  return result;
}
app.reloadServices = async function (){
  var reloadServicesview="";
  for (var i=0;i<list_services.length;i++){
    reloadServicesview+=`
    <div class="app-sv" id="${list_services[i].id}">
      <img src='${list_services[i].AvatarIMG}'>
      <div class="tooltiptext">${list_services[i].Name}</div>
    </div>`;
  }
  $("#list_services").html(reloadServicesview)
  $(".app-sv").click(async function(){
    var all=document.getElementsByClassName("app-sv");
    for (var i=0;i<all.length;i++) {
      all[i].classList.remove("active");
    }
    this.classList.add("active");
    $("#main-load").load("assets/tools/services.php?id="+this.id);
    window.history.replaceState( {} , 'foo', '?function=UserServices&id='+this.id);
  });
}
app.view = function(view){
  var box=`<div class="app_bg"><div class="app_bg_autoclose"></div><div class="app_bg_view">${view}</div></div>`
  $("#main-load").append(box);
  $(".app_bg_autoclose").click(function(){
    this.parentNode.remove();
  });
};
app.runmoney=function(id, start, end, duration) {
  if (start === end) return;
  var range = end - start;
  var current = start;
  var increment = end > start? 1 : -1;
  var stepTime = Math.abs(Math.floor(duration / range));
  var obj = document.getElementById(id);
  var timer = setInterval(function() {
      current += increment;
      obj.innerHTML = current;
      if (current == end) {
          clearInterval(timer);
      }
  }, stepTime);
}
app.setCookie = function(cname, cvalue, secs) {
  const d = new Date();
  d.setTime(d.getTime() + (secs * 1000));
  let expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

app.getCookie = function (cname) {
  let name = cname + "=";
  let ca = document.cookie.split(';');
  for(let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
app.checkCookie = function () {
  let user = getCookie("username");
  if (user != "") {
    alert("Welcome again " + user);
  } else {
    user = prompt("Please enter your name:", "");
    if (user != "" && user != null) {
      setCookie("username", user, 365);
    }
  }
}
app.load = function (id, delay) {
}
app.delay = function (ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}
app.compressIMAGE = async function(file,out) {
  const blobURL = URL.createObjectURL(file);
  const img = new Image();
  img.src = blobURL;
  img.onerror = function () {
      URL.revokeObjectURL(this.src);
      // Handle the failure properly
      console.log("Cannot load image");
  };
  return prompt = new Promise(function(myResolve, myReject) {
    img.onload = function () {
      URL.revokeObjectURL(this.src);
      const [newWidth, newHeight] = calculateSize(img, 900, 600);
      const canvas = document.createElement("canvas");
      canvas.width = newWidth;
      canvas.height = newHeight;
      const ctx = canvas.getContext("2d");
      ctx.drawImage(img, 0, 0, newWidth, newHeight);
      canvas.toBlob(
        (blob) => {
          var image = new Image();
          image.src = URL.createObjectURL(blob);
          if(out){ $(`#${out}`).html(image); }
          myResolve(app.blobToBase64(blob));
        },"image/png",0.7
      );
    };
  });
}
app.blob2Bit=function (b) {
  var uri = URL.createObjectURL(b),
      xhr = new XMLHttpRequest(),
      i,
      ui8;
  xhr.open('GET', uri, false);
  xhr.send();
  URL.revokeObjectURL(uri);
  ui8 = new Uint8Array(xhr.response.length);
  for (i = 0; i < xhr.response.length; ++i) {
      ui8[i] = xhr.response.charCodeAt(i);
  }
  return ui8;
}
app.blobToBase64=(blob)=>{
  return new Promise((resolve, _) => {
    const reader = new FileReader();
    reader.onloadend = () => resolve(reader.result);
    reader.readAsDataURL(blob);
  });
}
app.blobToBinary = async (blob) => {
  const buffer = await blob.arrayBuffer();
  
  const view = new Int8Array(buffer);
  
  return [...view].map((n) => n.toString(2)).join(' ');
};
function calculateSize(img, maxWidth, maxHeight) {
  let width = img.width;
  let height = img.height;
  if (width > height) {
      if (width > maxWidth) {
          height = Math.round((height * maxWidth) / width);
          width = maxWidth;
      }
  } else {
      if (height > maxHeight) {
          width = Math.round((width * maxHeight) / height);
          height = maxHeight;
      }
  }
  return [width, height];
}
function readableBytes(bytes) {
  const i = Math.floor(Math.log(bytes) / Math.log(1024)),
      sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
  return (bytes / Math.pow(1024, i)).toFixed(2) + ' ' + sizes[i];
}