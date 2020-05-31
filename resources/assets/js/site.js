require('./bootstrap.js');

//var latestCacheVersion = '0.0.1'; //sw.jsben is írd át!!!

//console.log = function(){}

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

window.onbeforeunload = function () {
    window.scrollTo(0, 0);
  }

window.onload = function(){
  addScrollListener();

   // console.log('%c ', 'font-size:500px; background:url('+window.location.protocol+"//" +window.location.hostname +'/img/2.webp) no-repeat;');
/*
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker
            .register('./sw.js?version='+Date.now() , {
                scope: './',
            })
            .then(function (registration) {
                console.log("Service Worker Registered");
            })
            .catch(function (err) {
                 console.log("Service Worker Failed to Register", err);
            })
    }
    navigator.serviceWorker.ready.then(function(swRegistration) {
        return swRegistration.sync.register(latestCacheVersion);
      });
    if(rmsw){*/
       // removeSW();
    /*}*/
}



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

        let cookieFooter = document.getElementById('cookie-footer')

        if(cookieFooter != null){
            cookieFooter.style.display = 'none';
        }

        gtag('js', new Date());
        gtag('config', 'UA-161580640-1');
        setFloatingButtonMargins();
    } else {

    }
  }

setCookiePolicyCookie = function(){
    if (!isProd) {
        setFloatingButtonMargins()
        setCookie('accepted_cookies','true',400)
        document.getElementById('cookie-footer').style.display = 'none';
        return
    }

    setCookie('accepted_cookies','true',400)
    document.getElementById('cookie-footer').style.display = 'none';

    gtag('js', new Date());
    gtag('config', 'UA-161580640-1');
    setFloatingButtonMargins();

}

function setFloatingButtonMargins(){
    console.log("lefut")
    let upButton = document.getElementById('fel');
    if (upButton !=null) {
      upButton.style.marginBottom = '40px';
    }

    let mailButton = document.getElementsByClassName('feedbackform')[0];

    if(mailButton != null){
      mailButton.style.marginBottom = '40px';
    }

}

document.addEventListener("DOMContentLoaded", function(event) {
    if (isProd && !isWelcomePage) {
        checkCookie();
    }
});

/*****  INFINITE SCROLL   *****/
//https://medium.com/walmartlabs/infinite-scrolling-the-right-way-11b098a08815
let DB = [];
var paginatedBy
var URL
getUrl = function(siteUrl){
    URL = siteUrl
}
var loadCount = 2
var observer

start = function(paginateNum,initData){
    DB = initData
    paginatedBy = paginateNum
    getData()

    initIntersectionObserver();
}

function initIntersectionObserver() {
    let options = {
     root: null,
     rootMargins: "0px",
     threshold: 0
    }

    const callback = entries => {
      entries.forEach(entry => {
       /* if (entry.target.id === 'feed-start') {
          topSentCallback(entry);
        } else*/
       // if (entry.target.id === `feed-end`) {
        //if (entry.target.class=== 'feed-list') {
          botSentCallback(entry);
        //}
      });
    }

    observer = new IntersectionObserver(callback, options);

   lastId = '#feed-tile-' + (((loadCount-1) *  paginatedBy) -1)
   console.log(lastId)
    observer.observe(document.querySelector(lastId));
    console.log("sub:" + lastId)
  }

function botSentCallback(entry) {

    const isIntersecting = entry.isIntersecting;

    if (
        isIntersecting
      ) {
        getData()
      }
}

function addNextItems(items){
    var feedNode = document.querySelector("#feed-wrap")
    var feedList = document.createElement("ul");
    feedList.setAttribute('class', 'row feed-list pizzafeed')

    var isYellow = false;
    var counter = 1;

    for (let i = 0; i < items.length; i++) {
        var item = document.createElement("div");
        item.setAttribute('class', 'col-lg-6 col-md-12 mb-5 feed-tile')
        specificId = 'feed-tile-' + (((loadCount-1) *  paginatedBy) + i)
        item.setAttribute('id', specificId)
        item.innerHTML = `
       <div class="ft-recipe">
            <div class="ft-recipe__thumb${ (isYellow) ? "m" : ""} text-center d-flex  align-items-center justify-content-center">

                <object data="${items[i]['pizza_alias']['generatedURL'] }" type="image/png" alt="Generalt pizza kép">
                    <img class="mx-auto d-block feed-tile-img" src="${URL}/img/pizzapop.png" alt="Generalt pizza kép"/>
                </object>

            </div>
            <div class="ft-recipe__content ">
                <header class="content__header">
                    <div class="row-wrapper text-center">
                        <h3 class="recipe-title feed-tile-name text-center">${items[i]['pizza_alias']['name']}</h3>
                    </div>
                    <ul class="recipe-details">
                        <li class="recipe-details-item ingredients"><i class="fas fa-coins"></i><span class="value">${ items[i]['price'] }</span><span class="title">Ár(HUF)</span></li>
                        <li class="recipe-details-item time"><i class="fas fa-ruler-horizontal"></i></i><span class="value">${items[i]['pizzasize']}</span><span class="title">Méret(cm)</span></li>
                    </ul>
                </header>
                <h4 class="text-center font-weight-bold"> <a href="${ (items[i]['url'] != "") ? items[i]['url'] : items[i]['website']['url'] }" rel="noopener" target="_blank"> ${items[i]['website']['title']} </a> </h4>
                <h4>Feltétek:</h4>
                <p class="description">
                 ${items[i]['pizza_alias']['recept'].map(function (feltet, i, arr) {
                     if (i !=arr.length-1) {
                         return `${feltet}, `
                     } else {
                         return `${feltet}`
                     }

                     }).join("")
                    }

                   &#32;
                </p>
                <footer class="content__footer${ (isYellow) ? "m" : ""} align-self-end "><a href="${ (items[i]['url'] != "") ? items[i]['url'] : items[i]['website']['url'] }" target="_blank" rel="noopener">Részletek</a></footer>
            </div>
        </div>
        `;

        counter++;
        if (counter == 2) {
            isYellow = !isYellow
            counter = 0;
        }

        feedList.appendChild(item)
    }

    feedNode.appendChild(feedList)
    console.log('items Added')

    prevItemslastID = '#feed-tile-' + (((loadCount-2) *  paginatedBy) -1)
    actualItemsLastId = '#feed-tile-' + (((loadCount-1) *  paginatedBy) -1)

    //Első körben nem kell fel/leiratkozni
    if (!(loadCount == 2)) {
        observer.unobserve(document.querySelector(prevItemslastID));
        observer.observe(document.querySelector(actualItemsLastId));
    }

}

function getData(){

   document.getElementById('feed-loader').style.display = 'inline';
   console.log('request start')
   fetch(URL + "/api/infinite_pizzas")
        .then(response=>response.json())
        .then( data =>{
            addNextItems(data)
            loadCount++

            document.getElementById('feed-loader').style.display = 'none';
        }).catch(function(error) {
            console.log(error);
          });
}

/******  INFINITE SCROLL END ******/

/*! modernizr 3.11.1 (Custom Build) | MIT *
 * https://modernizr.com/download/?-webp-setclasses !*/
 !function(n,e,A,o){function t(n,e){return typeof n===e}function a(n){var e=u.className,A=Modernizr._config.classPrefix||"";if(c&&(e=e.baseVal),Modernizr._config.enableJSClass){var o=new RegExp("(^|\\s)"+A+"no-js(\\s|$)");e=e.replace(o,"$1"+A+"js$2")}Modernizr._config.enableClasses&&(n.length>0&&(e+=" "+A+n.join(" "+A)),c?u.className.baseVal=e:u.className=e)}function i(n,e){if("object"==typeof n)for(var A in n)l(n,A)&&i(A,n[A]);else{n=n.toLowerCase();var o=n.split("."),t=Modernizr[o[0]];if(2===o.length&&(t=t[o[1]]),void 0!==t)return Modernizr;e="function"==typeof e?e():e,1===o.length?Modernizr[o[0]]=e:(!Modernizr[o[0]]||Modernizr[o[0]]instanceof Boolean||(Modernizr[o[0]]=new Boolean(Modernizr[o[0]])),Modernizr[o[0]][o[1]]=e),a([(e&&!1!==e?"":"no-")+o.join("-")]),Modernizr._trigger(n,e)}return Modernizr}var s=[],r={_version:"3.11.1",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(n,e){var A=this;setTimeout(function(){e(A[n])},0)},addTest:function(n,e,A){s.push({name:n,fn:e,options:A})},addAsyncTest:function(n){s.push({name:null,fn:n})}},Modernizr=function(){};Modernizr.prototype=r,Modernizr=new Modernizr;var l,f=[],u=A.documentElement,c="svg"===u.nodeName.toLowerCase();!function(){var n={}.hasOwnProperty;l=t(n,"undefined")||t(n.call,"undefined")?function(n,e){return e in n&&t(n.constructor.prototype[e],"undefined")}:function(e,A){return n.call(e,A)}}(),r._l={},r.on=function(n,e){this._l[n]||(this._l[n]=[]),this._l[n].push(e),Modernizr.hasOwnProperty(n)&&setTimeout(function(){Modernizr._trigger(n,Modernizr[n])},0)},r._trigger=function(n,e){if(this._l[n]){var A=this._l[n];setTimeout(function(){var n;for(n=0;n<A.length;n++)(0,A[n])(e)},0),delete this._l[n]}},Modernizr._q.push(function(){r.addTest=i}),Modernizr.addAsyncTest(function(){function n(n,e,A){function o(e){var o=!(!e||"load"!==e.type)&&1===t.width;i(n,"webp"===n&&o?new Boolean(o):o),A&&A(e)}var t=new Image;t.onerror=o,t.onload=o,t.src=e}var e=[{uri:"data:image/webp;base64,UklGRiQAAABXRUJQVlA4IBgAAAAwAQCdASoBAAEAAwA0JaQAA3AA/vuUAAA=",name:"webp"},{uri:"data:image/webp;base64,UklGRkoAAABXRUJQVlA4WAoAAAAQAAAAAAAAAAAAQUxQSAwAAAABBxAR/Q9ERP8DAABWUDggGAAAADABAJ0BKgEAAQADADQlpAADcAD++/1QAA==",name:"webp.alpha"},{uri:"data:image/webp;base64,UklGRlIAAABXRUJQVlA4WAoAAAASAAAAAAAAAAAAQU5JTQYAAAD/////AABBTk1GJgAAAAAAAAAAAAAAAAAAAGQAAABWUDhMDQAAAC8AAAAQBxAREYiI/gcA",name:"webp.animation"},{uri:"data:image/webp;base64,UklGRh4AAABXRUJQVlA4TBEAAAAvAAAAAAfQ//73v/+BiOh/AAA=",name:"webp.lossless"}],A=e.shift();n(A.name,A.uri,function(A){if(A&&"load"===A.type)for(var o=0;o<e.length;o++)n(e[o].name,e[o].uri)})}),function(){var n,e,A,o,a,i,r;for(var l in s)if(s.hasOwnProperty(l)){if(n=[],e=s[l],e.name&&(n.push(e.name.toLowerCase()),e.options&&e.options.aliases&&e.options.aliases.length))for(A=0;A<e.options.aliases.length;A++)n.push(e.options.aliases[A].toLowerCase());for(o=t(e.fn,"function")?e.fn():e.fn,a=0;a<n.length;a++)i=n[a],r=i.split("."),1===r.length?Modernizr[r[0]]=o:(Modernizr[r[0]]&&(!Modernizr[r[0]]||Modernizr[r[0]]instanceof Boolean)||(Modernizr[r[0]]=new Boolean(Modernizr[r[0]])),Modernizr[r[0]][r[1]]=o),f.push((o?"":"no-")+r.join("-"))}}(),a(f),delete r.addTest,delete r.addAsyncTest;for(var p=0;p<Modernizr._q.length;p++)Modernizr._q[p]();n.Modernizr=Modernizr}(window,window,document);


function removeSW(){
    console.log("removeing sw");
    navigator.serviceWorker.getRegistrations().then(

        function(registrations) {

            for(let registration of registrations) {
                registration.unregister();

            }

    });
}

'use strict'

let toRadians = (deg) => deg * Math.PI / 180
let map = (val, a1, a2, b1, b2) => b1 + (val - a1) * (b2 - b1) / (a2 - a1)

Pizza = class Pizza {
  constructor(id) {
    this.canvas = document.getElementById(id)
    this.ctx = this.canvas.getContext('2d')

    this.sliceCount = 6
    this.sliceSize = 80

    this.width = this.height = this.canvas.height = this.canvas.width = this.sliceSize * 2 + 50
    this.center = this.height / 2 | 0

    this.sliceDegree = 360 / this.sliceCount
    this.sliceRadians = toRadians(this.sliceDegree)
    this.progress = 0
    this.cooldown = 10

  }

  update() {
    let ctx = this.ctx
    ctx.clearRect(0, 0, this.width, this.height)

    if (--this.cooldown < 0) this.progress += this.sliceRadians*0.01 + this.progress * 0.1

    ctx.save()
    ctx.translate(this.center, this.center)

    for (let i = this.sliceCount - 1; i > 0; i--) {

      let rad
      if (i === this.sliceCount - 1) {
        let ii = this.sliceCount - 1

        rad = this.sliceRadians * i + this.progress

        ctx.strokeStyle = '#FBC02D'
        cheese(ctx, rad, .9, ii, this.sliceSize, this.sliceDegree)
        cheese(ctx, rad, .6, ii, this.sliceSize, this.sliceDegree)
        cheese(ctx, rad, .5, ii, this.sliceSize, this.sliceDegree)
        cheese(ctx, rad, .3, ii, this.sliceSize, this.sliceDegree)

      } else rad = this.sliceRadians * i

      // border
      ctx.beginPath()
      ctx.lineCap = 'butt'
      ctx.lineWidth = 11
      ctx.arc(0, 0, this.sliceSize, rad, rad + this.sliceRadians)
      ctx.strokeStyle = '#F57F17'
      ctx.stroke()

      // slice
      let startX = this.sliceSize * Math.cos(rad)
      let startY = this.sliceSize * Math.sin(rad)
      let endX = this.sliceSize * Math.cos(rad + this.sliceRadians)
      let endY = this.sliceSize * Math.sin(rad + this.sliceRadians)
      let varriation = [0.9,0.7,1.1,1.2]
      ctx.fillStyle = '#FBC02D'
      ctx.beginPath()
      ctx.moveTo(0, 0)
      ctx.lineTo(startX, startY)
      ctx.arc(0, 0, this.sliceSize, rad, rad + this.sliceRadians)
      ctx.lineTo(0, 0)
      ctx.closePath()
      ctx.fill()
      ctx.lineWidth = .3
      ctx.stroke()

      // meat
      let x = this.sliceSize * .65 * Math.cos(rad + this.sliceRadians / 2)
      let y = this.sliceSize * .65 * Math.sin(rad + this.sliceRadians / 2)
      ctx.beginPath()
      ctx.arc(x, y, this.sliceDegree / 6, 0, 2 * Math.PI)
      ctx.fillStyle = '#D84315'
      ctx.fill()

    }

    ctx.restore()

    if (this.progress > this.sliceRadians) {
      ctx.translate(this.center, this.center)
      ctx.rotate(-this.sliceDegree * Math.PI / 180)
      ctx.translate(-this.center, -this.center)

      this.progress = 0
      this.cooldown = 20
    }

  }

}

function cheese(ctx, rad, multi, ii, sliceSize, sliceDegree) {
  let x1 = sliceSize * multi * Math.cos(toRadians(ii * sliceDegree) - .2)
  let y1 = sliceSize * multi * Math.sin(toRadians(ii * sliceDegree) - .2)
  let x2 = sliceSize * multi * Math.cos(rad + .2)
  let y2 = sliceSize * multi * Math.sin(rad + .2)

  let csx = sliceSize * Math.cos(rad)
  let csy = sliceSize * Math.sin(rad)

  var d = Math.sqrt((x1 - csx) * (x1 - csx) + (y1 - csy) * (y1 - csy))
  ctx.beginPath()
  ctx.lineCap = 'round'

  let percentage = map(d, 15, 70, 1.2, 0.2)

  let tx = x1 + (x2 - x1) * percentage
  let ty = y1 + (y2 - y1) * percentage
  ctx.moveTo(x1, y1)
  ctx.lineTo(tx, ty)

  tx = x2 + (x1 - x2) * percentage
  ty = y2 + (y1 - y2) * percentage
  ctx.moveTo(x2, y2)
  ctx.lineTo(tx, ty)

  ctx.lineWidth = map(d, 0, 100, 20, 2)
  ctx.stroke()
}

var lastScrollTop = 0;

function addScrollListener(){

  let upButton = document.getElementById("fel")

  if (upButton == null) {
    return
  }

  window.addEventListener("scroll", function(){
   var st = window.pageYOffset || document.documentElement.scrollTop;
    if (st > lastScrollTop){
        if(upButton.classList.contains("show")){
          upButton.classList.remove("show");
        }
    } else {
        if(!upButton.classList.contains("show") && $(window).scrollTop() > 300){
          upButton.classList.add("show");
        }
    }

    if ($(window).scrollTop() < 300) {
      if(upButton.classList.contains("show")){
          upButton.classList.remove("show");
        }
    }

   lastScrollTop = st <= 0 ? 0 : st;
  }, false);

}


