$(document).ready(async function(){
  $("#add_restaurant").click(async function(){
    app.addService("restaurant");
  });
  $("#add_karaoke").click(async function(){
    app.addService("kaanoke");
  });
  $("#add_coffe").click(async function(){
    app.addService("coffe");
  });
});