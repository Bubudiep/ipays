$(document).ready(async function(){
  try {
    var user = await app.user();
    if (user.results&&user.results.length > 1) {
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
    ipc.send('maximinze');
  });
  $("#win-close").click(async function(){
    ipc.send('close');
  });
  $("#win-miniminze").click(async function(){
    ipc.send('miniminze');
  });
  connect();
});
let chatSocket = null;
function connect() {
    chatSocket = new WebSocket("ws://localhost:8000/ws/chat/public/");
    chatSocket.onopen = function(e) {
        console.log("Successfully connected to the WebSocket.");
    }
    chatSocket.onclose = function(e) {
        console.log("WebSocket connection closed unexpectedly. Trying to reconnect in 2s...");
        setTimeout(function() {
            console.log("Reconnecting...");
            connect();
        }, 2000);
    };
    chatSocket.onmessage = function(e) {
      const data = JSON.parse(e.data);
      console.log(data);
      switch (data.type) {
          case "user_list":
              break;
          case "user_join":
              break;
          case "user_leave":
              break;
          case "chat_message":
              break;
          case "private_message":
              break;
          case "private_message_delivered":
              break;
          default:
              console.error("Unknown message type!");
              break;
      }
    };
    chatSocket.onerror = function(err) {
        console.log("WebSocket encountered an error: " + err.message);
        console.log("Closing the socket.");
        chatSocket.close();
    }
}