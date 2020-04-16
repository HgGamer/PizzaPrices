require('./bootstrap.js');

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})
window.onload = function(){
    console.log('%c ', 'font-size:500px; background:url('+window.location.protocol+"//" +window.location.hostname +'/img/2.webp) no-repeat;');
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
        document.getElementById('cookie-footer').style.display = 'none';
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
    document.getElementById('fel').style.marginBottom = '40px';
    document.getElementsByClassName('feedbackform')[0].style.marginBottom = '40px';
}

document.addEventListener("DOMContentLoaded", function(event) {
    if (isProd) {
        checkCookie();
    }
});

/*****  INFINITE SCROLL   *****/
//https://medium.com/walmartlabs/infinite-scrolling-the-right-way-11b098a08815
let DB = [];
var maxLoad
var paginatedBy
var URL
getUrl = function(siteUrl){
    URL = siteUrl
}
var loadCount = 2
var observer

start = function(max, paginateNum,initData){
    maxLoad = max
    DB = initData
    paginatedBy = paginateNum
    getData(2)

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
    observer.observe(document.querySelector(lastId));
    console.log("sub:" + lastId)
  }

function botSentCallback(entry) {

    const isIntersecting = entry.isIntersecting;

    if (
        isIntersecting
      ) {
        getData(loadCount)
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
            <div class="ft-recipe__thumb${ (isYellow) ? "m" : ""} text-center d-flex  align-items-center">
                <img class="mx-auto d-block feed-tile-img" src="${URL}/img/pizzapop.png" alt=""/>
            </div>
            <div class="ft-recipe__content ">
                <header class="content__header">
                    <div class="row-wrapper text-center">
                        <h3 class="recipe-title feed-tile-name text-center">${items[i]['pizza']['name']}</h3>
                    </div>
                    <ul class="recipe-details">
                        <li class="recipe-details-item ingredients"><i class="fas fa-coins"></i><span class="value">${ items[i]['price'] }</span><span class="title">Ár(HUF)</span></li>
                        <li class="recipe-details-item time"><i class="fas fa-ruler-horizontal"></i></i><span class="value">${items[i]['pizzasize']}</span><span class="title">Méret(cm)</span></li>
                    </ul>
                </header>
                <h4 class="text-center font-weight-bold"> <a href="${ (items[i]['url'] != "") ? items[i]['url'] : items[i]['website']['url'] }"> ${items[i]['website']['title']} </a> </h4>
                <h4>Feltétek:</h4>
                <p class="description">
                 ${items[i]['pizza']['recept'].map(function (feltet, i, arr) {
                     if (i !=arr.length-1) {
                         return `${feltet}, `
                     } else {
                         return `${feltet}`
                     }

                     }).join("")
                    }

                   &#32;
                </p>
                <footer class="content__footer${ (isYellow) ? "m" : ""} align-self-end "><a href="#">Részletek</a></footer>
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

function getData(num){
    if (num == maxLoad ) {
        console.log("feed end")
        return
    }

    document.getElementById('feed-loader').style.display = 'inline';
    console.log('request start')
   fetch(URL + "/api/infinite_pizzas?page=" + loadCount)
        .then(response=>response.json())
        .then( data =>{
            addNextItems(data['data'])
            loadCount++

            document.getElementById('feed-loader').style.display = 'none';
        }).catch(function(error) {
            //console.log(error);
          });
}

/******  INFINITE SCROLL END ******/






