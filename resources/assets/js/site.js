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

/*****  INFINITE SCROLL   *****/
/*
const _getCatImg = () => {
  const randomNum = () => {
    return Math.floor(Math.random() * 100000);
  };
  const url = "https://source.unsplash.com/collection/139386/500x500/?sig=";
  return url + randomNum();
};
*/

let topSentinelPreviousY = 0;
let topSentinelPreviousRatio = 0;
let bottomSentinelPreviousY = 0;
let bottomSentinelPreviousRatio = 0;

initDB = function(initPizzas){
   DB = initPizzas;
   console.log('db initialized')

  DB = DB.concat(initPizzas)
   console.log('db doubled')
   console.log(DB.length)
}


let DB = [];

let currentIndex = 0;

const getSlidingWindow = isScrollDown => {
	const increment = listSize / 2;
	let firstIndex;

  if (isScrollDown) {
  	firstIndex = currentIndex + increment;
  } else {
    firstIndex = currentIndex - increment - listSize;
  }

  if (firstIndex < 0) {
  	firstIndex = 0;
  }

  return firstIndex;
}

const recycleDOM = firstIndex => {
	for (let i = 0; i < listSize; i++) {
  	const tile = document.querySelector("#feed-tile-" + i);
    tile.getElementsByClassName("feed-tile-name")[0].innerText = DB[i + firstIndex]['id'];
    tile.getElementsByClassName("feed-tile-img")[0].setAttribute("src", "http://127.0.0.1:8000/img/pizzapop.png");
  }
}

const getNumFromStyle = numStr => Number(numStr.substring(0, numStr.length - 2));

const adjustPaddings = isScrollDown => {
	const container = document.querySelector(".feed-list");
  const currentPaddingTop = getNumFromStyle(container.style.paddingTop);
  const currentPaddingBottom = getNumFromStyle(container.style.paddingBottom);
  const remPaddingsVal = 365* (listSize / 2);
	if (isScrollDown) {
  	container.style.paddingTop = currentPaddingTop + remPaddingsVal + "px";
    container.style.paddingBottom = currentPaddingBottom === 0 ? "0px" : currentPaddingBottom - remPaddingsVal + "px";
  } else {
  	container.style.paddingBottom = currentPaddingBottom + remPaddingsVal + "px";
    container.style.paddingTop = currentPaddingTop === 0 ? "0px" : currentPaddingTop - remPaddingsVal + "px";

  }
}

const topSentCallback = entry => {
	if (currentIndex === 0) {
		const container = document.querySelector(".feed-list");
  	container.style.paddingTop = "0px";
  	container.style.paddingBottom = "0px";
  }

  const currentY = entry.boundingClientRect.top;
  const currentRatio = entry.intersectionRatio;
  const isIntersecting = entry.isIntersecting;

  // conditional check for Scrolling up
  if (
    currentY > topSentinelPreviousY &&
    isIntersecting &&
    currentRatio >= topSentinelPreviousRatio &&
    currentIndex !== 0
  ) {
    const firstIndex = getSlidingWindow(false);
    adjustPaddings(false);
    recycleDOM(firstIndex);
    currentIndex = firstIndex;
  }

  topSentinelPreviousY = currentY;
  topSentinelPreviousRatio = currentRatio;
}

const botSentCallback = entry => {
	if (currentIndex === DBSize - listSize) {
  	return;
  }
  const currentY = entry.boundingClientRect.top;
  const currentRatio = entry.intersectionRatio;
  const isIntersecting = entry.isIntersecting;

  // conditional check for Scrolling down
  if (
    currentY < bottomSentinelPreviousY &&
    currentRatio > bottomSentinelPreviousRatio &&
    isIntersecting
  ) {
    const firstIndex = getSlidingWindow(true);
    adjustPaddings(true);
    recycleDOM(firstIndex);
    currentIndex = firstIndex;
  }

  bottomSentinelPreviousY = currentY;
  bottomSentinelPreviousRatio = currentRatio;
}

const initIntersectionObserver = () => {
  const options = {
  	/* root: document.querySelector(".cat-list") */
  }

  const callback = entries => {
    entries.forEach(entry => {
      if (entry.target.id === 'feed-tile-0') {
        topSentCallback(entry);
      } else if (entry.target.id === `feed-tile-${listSize - 1}`) {
        botSentCallback(entry);
      }
    });
  }

  var observer = new IntersectionObserver(callback, options);
  observer.observe(document.querySelector("#feed-tile-0"));
  observer.observe(document.querySelector(`#feed-tile-${listSize - 1}`));
}

start = function(){
console.log("start()");

    DBSize = 200;
    listSize = 20;

	initIntersectionObserver();
}
