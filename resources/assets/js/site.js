require('./bootstrap.js');


function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";

}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }

 function checkCookie() {
    var accepted = getCookie("accepted_cookies");
    if (accepted != "") {
        //él a cookie
        document.getElementById('cookie-footer').style.display = 'none';
        gtag('js', new Date());
         gtag('config', 'UA-161580640-1');
    } else {

    }
  }

setCookiePolicyCookie = function(){
    setCookie('accepted_cookies','true',400)
    document.getElementById('cookie-footer').style.display = 'none';

    gtag('js', new Date());
    gtag('config', 'UA-161580640-1');

}

document.addEventListener("DOMContentLoaded", function(event) {

    checkCookie();

});
