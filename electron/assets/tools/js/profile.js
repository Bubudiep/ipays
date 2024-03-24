$(document).ready(async function(){
  await loadIMG();
})
async function loadIMG(){
  var dt=await app.get("i/Photos/?page_size=15");
  if(dt.results&&dt.results.length>0){
    var view=``;
    for (var i=0;i<dt.results.length;i++){
      view+=`<div class="items"><img src="${dt.results[i].img}"></div>`;
    }
    $("#my-img").html(view);
  } else {
    $("#my-img").html("<div class='list-img-null'>Bạn chưa có ảnh nào</div>");
  }
}