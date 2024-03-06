$(document).ready(async function() {
  try{
    var user=localStorage.getItem('user');
    var pass=localStorage.getItem('pass');
    $("#user").val(user);
    $("#pass").val(pass);
    // if (user!=null&&pass!=null&&user!=""&&pass!=""){
    //   await login(user,pass);
    // }
  } catch(e){
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
    await login(user,pass);
  });
  $("#more_details").click(async function(){
    ipc.send("chrome","http://"+location.hostname+"/document/")
  });
  $("#exit").click(async function() {
    ipc.send("exit");
  });
});
async function login(user,pass){
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
  ipc.send("maximinze");
  app.setCookie('token',token.access_token,token.expires_in);
  app.delay(300);
  location.href = "/electron/";
}