$(document).ready(async function(){
  try {
    var user = await app.user();
    console.log(user);
    if (user.results&&user.results.length == 1) {
      await app.delay(500);
      $("#firstload").remove();
      $("#main-load").load("assets/tools/report.php");
    }
  } catch (e) {
    location.href = '/electron/login/index.php';
  }
  $(".app-item").click(async function(){
    var all=document.getElementsByClassName("app-item");
    for (var i=0;i<all.length;i++) {
      all[i].classList.remove("active");
    }
    this.classList.add("active");
    $("#main-load").load("assets/tools/"+this.id+".php");
  });
  $("#win-min").click(async function(){
    ipc.send('maximize');
  });
  $("#win-close").click(async function(){
    ipc.send('close');
  });
  $("#win-miniminze").click(async function(){
    ipc.send('minimize');
  });
});