const app={};
const api_port = 8000;
app.getcookie=function(name){
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(';').shift();
}
const token=app.getcookie('token');
app.user= async function(){
  return user= await app.get("shopfloor/users/");
};
app.post=async function(uri,data,headers={Authorization: token,}){
  var start = new Date().getTime(); // note getTime()
  return ($.ajax({
    type: "POST",
    url: `${location.protocol}//${location.hostname}:${api_port}/${uri}`,
    async: true,
    headers: headers,
    dataType: "json",
    data: data,
    success: function (data) {
      return data;
    }, // prevent caching response
    complete: function () {
      var end = new Date().getTime();
      console.log(uri + " : " + (end - start) + "ms");
    },
  }));
}
app.patch=async function(uri,data){
  var start = new Date().getTime(); // note getTime()
  return ($.ajax({
    type: "PATCH",
    url: `${location.protocol}//${location.hostname}:${api_port}/${uri}`,
    async: true,
    headers: {
      Authorization: token,
    },
    dataType: "json",
    data: data,
    success: function (data) {
      return data;
    }, // prevent caching response
    complete: function () {
      var end = new Date().getTime();
      console.log(uri + " : " + (end - start) + "ms");
    },
  }));
}
app.get=async function(uri){
  var start = new Date().getTime(); // note getTime()
  return ($.ajax({
    type: "GET",
    url: `${location.protocol}//${location.hostname}:${api_port}/${uri}`,
    async: true,
    dataType: "json",
    headers: {
      Authorization: token,
    },
    success: function (data) {
      return data;
    }, // prevent caching response
    complete: function () {
      var end = new Date().getTime();
      console.log(`${location.protocol}//${location.hostname}:${api_port}/${uri}` + (end - start) + "ms");
    },
  }));
}
app.setCookie = function(cname, cvalue, secs) {
  const d = new Date();
  d.setTime(d.getTime() + (secs * 1000));
  let expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

app.getCookie = function (cname) {
  let name = cname + "=";
  let ca = document.cookie.split(';');
  for(let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
app.checkCookie = function () {
  let user = getCookie("username");
  if (user != "") {
    alert("Welcome again " + user);
  } else {
    user = prompt("Please enter your name:", "");
    if (user != "" && user != null) {
      setCookie("username", user, 365);
    }
  }
}
app.load = function (id, delay) {
}
app.delay = function (ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}