$(document).ready(async function() {
  try{
    var user=localStorage.getItem('user');
    var pass=localStorage.getItem('pass');
    $("#user").val(user);
    $("#pass").val(pass);
    var client= await app.get('i/oauth2-info/');
    $("#firstload").remove();
  } catch(e){
    $("#firstload").remove();
    app.error('Opps!... Kết nối máy chủ thất bại!');
  };
  $("#user").keydown(async function(e){
    if(e.which==13){
      $("#pass").focus();
    }
  });
  $("#pass").keydown(async function(e){
    if(e.which==13){
      $("#submit").click();
    }
  });
  $("#submit").click(async function(){
    var user=$("#user").val();
    var pass=$("#pass").val();
    console.log(user,pass);
    if($("#remember").prop('checked')){
      localStorage.setItem("user", user);
      localStorage.setItem("pass", pass);
    }
    await login(user,pass,client);
  });
  try {
    ipc.send("screen","800x600");
  } catch (e) {
    console.log(e);
  }
  $("#more_details").click(async function(){
    ipc.send("chrome","http://"+location.hostname+"/document/")
  });
  $("#exit").click(async function() {
    ipc.send("exit");
  });
});
async function login(user,pass){
  var id_load="login-"+app.random(5);
  await app.load(id_load,"Đang đăng nhập");
  try{
    var client= await app.get('i/oauth2-info/');
    var token=await app.post('o/token/',JSON.stringify({
      grant_type: "password",
      client_id: client.client_id,
      client_secret: client.client_secret,
      username: user,
      password: pass,
    }),{
      "Accept": "application/json",
      "Content-Type": "application/json",
    });
    await app.setCookie('token',token.access_token,token.expires_in);
    try {
      await ipc.send("maximinze");
    } catch (e) {
      console.log(e);
    }
    app.delay(300);
    location.href = "/electron/";
  } catch (e) {
    console.log(e);
    $("#"+id_load).remove();
    if (e?.responseJSON?.error=="invalid_grant"){
      app.error('Tài khoản không chính xác!');
    } else {
      app.error('Opps!... Kết nối máy chủ thất bại!');
    }
  }
}