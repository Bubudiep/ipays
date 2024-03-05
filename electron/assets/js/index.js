$(document).ready(async function(){
  try {
    var user = await app.user();
    if (user.results&&user.results.length == 1) {
      $("#load_user").remove();
    }
  } catch (e) {
    console.log("User");
    location.href = '/electron/login/index.php';
  }
});