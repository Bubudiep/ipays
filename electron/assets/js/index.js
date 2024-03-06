$(document).ready(async function(){
  try {
    var user = await app.user();
    if (user.results&&user.results.length > 1) {
      await app.delay(500);
      $("#firstload").remove();
    }
  } catch (e) {
    location.href = '/electron/login/index.php';
  }
  $("#win-min").click(async function(){
    ipc.send('maximinze');
  });
  $("#win-close").click(async function(){
    ipc.send('close');
  });
  $("#win-miniminze").click(async function(){
    ipc.send('miniminze');
  });
});