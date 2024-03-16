<div class="main-view">
  <div class="main-content">
    <div class="flex-c main-b">
      <div class="flex main-b-head">
        <div class="flex left">
          <div class="m-h1">QRCode của tôi</div>
        </div>
        <div class="flex right" id="editQR">
          <button class="default"><i class="fa-solid fa-marker"></i> Sửa</button>
        </div>
      </div>
      <div class="flex-c mg5 acenter" style="margin-bottom:15px">
        <div class="flex jcenter">
          <div id="qrcode" class="qr-code"></div>
        </div>
        <div class="flex-c f1 g5 deactive animate__animated animate__fadeIn" id="QRtools">
          <div class="flex-c">
            <div class="flex"><select id="bank_id"><option>-- Chọn ngân hàng --</option></select></div>
            <div class="flex"><input type="text" id="card_id" placeholder="Số tài khoản" value="0343151269"></div>
            <div class="flex"><input type="text" id="card_money" placeholder="Số tiền" value="500000"></div>
            <div class="flex"><input type="text" id="card_comment" placeholder="Nội dung" value="Chuyen tien"></div>
          </div>
          <div class="flex">
            <select id="qr-types">
              <option value="classy-rounded">Mặc định</option>
              <option value="classy">Cổ điển</option>
              <option value="extra-rounded">Bo viền</option>
              <option value="rounded">Bo viền 2</option>
              <option value="dots">Chấm bi</option>
              <option value="square">Bình thường</option>
            </select>
          </div>
          <div class="flex g5">
            <label id ="html5colorpicker-lb" class="label-color" for="html5colorpicker" style="background-color: #004CFF;"></label>
            <input type="color" id="html5colorpicker" value="#004CFF">
            <label id ="html5colorpicker-lb2" class="label-color" for="html5colorpicker2" style="background-color: #E12D2D;"></label>
            <input type="color" id="html5colorpicker2" value="#E12D2D">
          </div>
          <div class="flex">
            <input id="rotation" type="range" value=5 min=0 max=6>
          </div>
        </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(async()=>{
  updateQR();
  var apibank=await gets("https://api.vietqr.io/v2/banks");
  if(apibank.data){
    apibank.data.forEach(function(v){
      $("#bank_id").append("<option value='"+v.bin+"' selected>"+v.shortName+"</option>");
    });
  }
  $("#editQR").click(async()=>{
    var a=document.getElementById("QRtools").classList;
    if (a.value.includes("deactive")){
      a.remove("deactive");
    } else {
      a.add("animate__fadeOut");
      await sleep(400);
      a.remove("animate__fadeOut");
      a.add("deactive");
    }
  });
  $("#bank_id").change(() => updateQR() );
  $("#card_id").change(() => updateQR() );
  $("#card_money").change(() => updateQR() );
  $("#card_comment").change(() => {
    $("#card_comment").val(removeVietnameseTones($("#card_comment").val()));
    updateQR();
  } );
  $("#rotation").on('input',function(){
    updateQR();
  });
  $("#html5colorpicker2").change(function(){
    document.getElementById("html5colorpicker-lb2").style.backgroundColor=$("#html5colorpicker2").val();
    updateQR();
  });
  $("#html5colorpicker").change(function(){
    document.getElementById("html5colorpicker-lb").style.backgroundColor=$("#html5colorpicker").val();
    updateQR();
  });
  $("#QRdata").keyup(function(){
    updateQR();
  });
  $("#qr-types").change(function(){
    updateQR();
  });
});
function updateQR(){
  var stk=$("#card_id").val();
  var ttnh=`0006${$("#bank_id").val()}01${pad(stk.length,2)}${stk}`;
  var tttk=`0010A00000072701${pad(ttnh.length,2)}${ttnh}0208QRIBFTTA`;
  var sotien=$("#card_money").val();
  var com=$("#card_comment").val();
  var coma=`08${pad(com.length,2)}${com}`;
  var str=`00020101021238${pad(tttk.length,2)}${tttk}530370454${pad(sotien.length,2)}${sotien}5802VN62${pad(coma.length,2)}${coma}6304`;
  
  var crc=crc_ccitt_ffff(str).toUpperCase();
  if (crc){
    crc=pad(crc, 4)
    var str2=`${str}${crc}`;
    app.genQRCode(str2,"qrcode",{
      color:$("#html5colorpicker").val(),
      image:"web/app/assets/img/web/icon.png",
      dottype:$("#qr-types").val(),
      startColor:$("#html5colorpicker").val(),
      endColor:$("#html5colorpicker2").val(),
      rotation:$("#rotation").val()
    },250);
  } else {
    console.log(crc);
  }
}
function pad(num, size) {
  num = num.toString();
  while (num.length < size) num = "0" + num;
  return num;
}
function crc_ccitt_ffff(str) {
    const POLY  = 0x1021;
    const START = 0xFFFF;

    function get_crc_for_num(i) {
        var crc = 0;
        var c = i * 256;
        [...Array(8).keys()].forEach(_ => {
            crc = ((crc ^ c) & 0x8000) ? (crc * 2) ^ POLY : crc * 2;
            c = c * 2 });
        return crc;
    }

    var table = [...Array(256).keys()].map((_,n) => get_crc_for_num(n));

    var crc = START;

    str.split('').forEach(c => {
        crc = (crc * 0x100) ^ table[ ( ((crc / 0x100) >> 0) ^ c.charCodeAt() ) & 0xFF ];
        crc = (((crc / 0x10000) >> 0) * 0x10000) ^ crc;
        }
    )

    return crc.toString(16);
}
var crcTable = [
  0x0000, 0x1021, 0x2042, 0x3063, 0x4084, 0x50A5, 0x60C6, 0x70E7,
  0x8108, 0x9129, 0xA14A, 0xB16B, 0xC18C, 0xD1AD, 0xE1CE, 0xF1EF,
  0x1231, 0x0210, 0x3273, 0x2252, 0x52B5, 0x4294, 0x72F7, 0x62D6,
  0x9339, 0x8318, 0xB37B, 0xA35A, 0xD3BD, 0xC39C, 0xF3FF, 0xE3DE,
  0x2462, 0x3443, 0x0420, 0x1401, 0x64E6, 0x74C7, 0x44A4, 0x5485,
  0xA56A, 0xB54B, 0x8528, 0x9509, 0xE5EE, 0xF5CF, 0xC5AC, 0xD58D,
  0x3653, 0x2672, 0x1611, 0x0630, 0x76D7, 0x66F6, 0x5695, 0x46B4,
  0xB75B, 0xA77A, 0x9719, 0x8738, 0xF7DF, 0xE7FE, 0xD79D, 0xC7BC,
  0x48C4, 0x58E5, 0x6886, 0x78A7, 0x0840, 0x1861, 0x2802, 0x3823,
  0xC9CC, 0xD9ED, 0xE98E, 0xF9AF, 0x8948, 0x9969, 0xA90A, 0xB92B,
  0x5AF5, 0x4AD4, 0x7AB7, 0x6A96, 0x1A71, 0x0A50, 0x3A33, 0x2A12,
  0xDBFD, 0xCBDC, 0xFBBF, 0xEB9E, 0x9B79, 0x8B58, 0xBB3B, 0xAB1A,
  0x6CA6, 0x7C87, 0x4CE4, 0x5CC5, 0x2C22, 0x3C03, 0x0C60, 0x1C41,
  0xEDAE, 0xFD8F, 0xCDEC, 0xDDCD, 0xAD2A, 0xBD0B, 0x8D68, 0x9D49,
  0x7E97, 0x6EB6, 0x5ED5, 0x4EF4, 0x3E13, 0x2E32, 0x1E51, 0x0E70,
  0xFF9F, 0xEFBE, 0xDFDD, 0xCFFC, 0xBF1B, 0xAF3A, 0x9F59, 0x8F78,
  0x9188, 0x81A9, 0xB1CA, 0xA1EB, 0xD10C, 0xC12D, 0xF14E, 0xE16F,
  0x1080, 0x00A1, 0x30C2, 0x20E3, 0x5004, 0x4025, 0x7046, 0x6067,
  0x83B9, 0x9398, 0xA3FB, 0xB3DA, 0xC33D, 0xD31C, 0xE37F, 0xF35E,
  0x02B1, 0x1290, 0x22F3, 0x32D2, 0x4235, 0x5214, 0x6277, 0x7256,
  0xB5EA, 0xA5CB, 0x95A8, 0x8589, 0xF56E, 0xE54F, 0xD52C, 0xC50D,
  0x34E2, 0x24C3, 0x14A0, 0x0481, 0x7466, 0x6447, 0x5424, 0x4405,
  0xA7DB, 0xB7FA, 0x8799, 0x97B8, 0xE75F, 0xF77E, 0xC71D, 0xD73C,
  0x26D3, 0x36F2, 0x0691, 0x16B0, 0x6657, 0x7676, 0x4615, 0x5634,
  0xD94C, 0xC96D, 0xF90E, 0xE92F, 0x99C8, 0x89E9, 0xB98A, 0xA9AB,
  0x5844, 0x4865, 0x7806, 0x6827, 0x18C0, 0x08E1, 0x3882, 0x28A3,
  0xCB7D, 0xDB5C, 0xEB3F, 0xFB1E, 0x8BF9, 0x9BD8, 0xABBB, 0xBB9A,
  0x4A75, 0x5A54, 0x6A37, 0x7A16, 0x0AF1, 0x1AD0, 0x2AB3, 0x3A92,
  0xFD2E, 0xED0F, 0xDD6C, 0xCD4D, 0xBDAA, 0xAD8B, 0x9DE8, 0x8DC9,
  0x7C26, 0x6C07, 0x5C64, 0x4C45, 0x3CA2, 0x2C83, 0x1CE0, 0x0CC1,
  0xEF1F, 0xFF3E, 0xCF5D, 0xDF7C, 0xAF9B, 0xBFBA, 0x8FD9, 0x9FF8,
  0x6E17, 0x7E36, 0x4E55, 0x5E74, 0x2E93, 0x3EB2, 0x0ED1, 0x1EF0,
];
function crc16(s) {
  var crc = 0xFFFF;
  var j, i;
  for (i = 0; i < s.length; i++) {
    c = s.charCodeAt(i);
    j = (c ^ (crc >> 8)) & 0xFF;
    crc = crcTable[j] ^ (crc << 8);
  }
  return crc
}
function removeVietnameseTones(str) {
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a"); 
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e"); 
    str = str.replace(/ì|í|ị|ỉ|ĩ/g,"i"); 
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o"); 
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u"); 
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y"); 
    str = str.replace(/đ/g,"d");
    str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
    str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
    str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
    str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
    str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
    str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
    str = str.replace(/Đ/g, "D");
    // Some system encode vietnamese combining accent as individual utf-8 characters
    // Một vài bộ encode coi các dấu mũ, dấu chữ như một kí tự riêng biệt nên thêm hai dòng này
    str = str.replace(/\u0300|\u0301|\u0303|\u0309|\u0323/g, ""); // ̀ ́ ̃ ̉ ̣  huyền, sắc, ngã, hỏi, nặng
    str = str.replace(/\u02C6|\u0306|\u031B/g, ""); // ˆ ̆ ̛  Â, Ê, Ă, Ơ, Ư
    // Remove extra spaces
    // Bỏ các khoảng trắng liền nhau
    str = str.replace(/ + /g," ");
    str = str.trim();
    // Remove punctuations
    // Bỏ dấu câu, kí tự đặc biệt
    str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g," ");
    return str;
}
</script>