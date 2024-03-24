$(document).ready(async function() {
  const urlParams = new URLSearchParams(window.location.search);
  const funtion = urlParams.get('function');
  const funtion_id = urlParams.get('id');
  if (funtion=="UserServices"){
    await loadServices(funtion_id)
  }
});
async function loadServices(id){
  var svdt= await app.get(`i/UserServices/${id}/`);
  console.log(svdt)
}