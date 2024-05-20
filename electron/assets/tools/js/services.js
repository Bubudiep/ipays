$(document).ready(async function() {
  const urlParams = new URLSearchParams(window.location.search);
  const funtion = urlParams.get('function');
  const funtion_id = urlParams.get('id');
  if (funtion=="UserServices"){
    await loadServices(funtion_id)
  }
  $(".showup-store").click(async function() {
    var target = this.parentNode.parentNode.childNodes[1].classList.value;
    if(target.includes(`open`)){
      this.parentNode.parentNode.childNodes[1].classList.remove("open");
      this.parentNode.parentNode.childNodes[1].classList.add("hidden");
      this.style.transform=`rotate(180deg)`;
    } else {
      this.parentNode.parentNode.childNodes[1].classList.remove("hidden");
      this.parentNode.parentNode.childNodes[1].classList.add("open");
      this.style.transform=`rotate(0deg)`;
    }
  });
  $("#services_mains").load(`assets/tools/services/manager.php`);
  $(".store-items").click(async function(){
    if (!$(this).hasClass("active")){
      var all=document.getElementsByClassName("store-items");
      for(var i=0;i<all.length;i++){
        all[i].classList.remove("active");
      }
      this.classList.add("active");
      if(this.id!=""){
        $("#services_mains").load(`assets/tools/services/${this.id}.php`);
      } else {
        $("#services_mains").html('');
      }
    }
  });
});
async function loadServices(id){
  var svdt= await app.get(`i/UserServices/${id}/`);
  console.log(svdt)
}