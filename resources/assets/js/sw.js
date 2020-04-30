// Set a name for the current cache
var cacheVersion = "0.0.1"; //site.js ben is írd át
// Default files to always cache
var cacheFiles = [
    '/',
]
//Cacheable folder
var cache_if_loaded = [

]

var tryLive = [
]

var cacheable_filetypes = [
    '.woff2', '.jpg', '.png', '.css', '.json', '.webp'
]
var cache_exclude = [
    'sw.js','site.js','app.js'
]
self.addEventListener('sync', function(event) {
    console.log('[SYNC]'+event.tag);
    if(event.tag != cacheVersion){
        self.registration.unregister();
    }
  });

self.addEventListener('install', function (e) {

    //console.log('%c [ServiceWorker] Installed',' color: #bada55');
    // e.waitUntil Delays the event until the Promise is resolved
    e.waitUntil(
        // Open the cache
        caches.open(cacheVersion).then(function (cache) {

            // Add all the default files to the cache
            //console.log('[ServiceWorker] Caching cacheFiles');
            return cache.addAll(cacheFiles);
        })
    ); // end e.waitUntil
});


self.addEventListener('activate', function (e) {
    console.log('[ServiceWorker] Activated');

    e.waitUntil(

        // Get all the cache keys (cacheVersion)
        caches.keys().then(function (cacheNames) {
            return Promise.all(cacheNames.map(function (thisCacheName) {

                // If a cached item is saved under a previous cacheName
                if (thisCacheName !== cacheVersion) {

                    // Delete that cached file
                    //       //console.log('[ServiceWorker] Removing Cached Files from Cache - ', thisCacheName);
                    return caches.delete(thisCacheName);
                }
            }));
        })
    ); // end e.waitUntil

});


self.addEventListener('fetch', function (e) {
    console.log('[ServiceWorker] Fetch', e.request.url);

    // e.respondWidth Responds to the fetch event
    e.respondWith(

        // Check in cache for the request being made
        caches.match(e.request)
        .then(function (response) {

            // If the request is in the cache
            if (response) {
                //  //console.log("[ServiceWorker] Found in Cache", e.request.url, response);
                // Return the cached version
                var skipcache = false;
                //console.log(e.request.url);
                tryLive.forEach(value => {
                    //console.log(value);
                    if (e.request.url.includes(value)) {
                        //console.log("benne van a live tömbben",e.request.url);
                        skipcache = true;
                    }
                })
                //console.log("SKIPCACHE" , skipcache);
                if (!skipcache) {
                    return response;
                }


            }
            return fetch(e.request)
                .then(function (response) {
                    if (!response) {
                        //console.error("No response");
                        return response;
                    }

                    var skipcache = false
                    tryLive.forEach(value => {
                        //console.log(value);
                        if (e.request.url.includes(value)) {
                            //console.log("benne van a live tömbben",e.request.url);
                            skipcache = true;
                        }
                    })
                    //console.log("SKIPCACHE22" , skipcache);

                    let clone = response.clone()
                    caches.open(cacheVersion).then(function (cache) {
                        if (skipcache) {
                            //console.log("benne van a live tömbben ezért újra belerakjuk",e.request.url);
                            cache.put(e.request, clone);
                            return response;
                        }
                        if (cacheFiles.includes(e.request.url.replace(e.request.referrer, '/'))) {
                            cache.put(e.request, clone);
                            return response;
                        }

                        let file = (e.request.url).match(/[^\\/]+$/g);

                        //exclude lista
                        if (file === null || cache_exclude.includes(file[0])) {
                            console.log("cache exclude", file);
                            return response;
                        }

                        //cacheljük ha van betöltjük
                        if (file !== null && cache_if_loaded.includes(file[0])) {

                            cache.put(e.request, clone);
                            return response;
                        }


                        let file_extension = (e.request.url).match(/\.[0-9a-z]+$/g)

                        //nincs benne a file a megengedett tipusokban.
                        //       //console.log(file_extension);
                        if (file_extension === null || !cacheable_filetypes.includes(file_extension[0])) {
                            // //console.log("nem rakjuk bele" ,e.request.url)
                            return response;
                        }
                        cache.put(e.request, clone);
                    });

                    return response;
                }).catch(function (e) {
                    return response;
                })

            // If the request is NOT in the cache, fetch and cache

        }) // end caches.match(e.request)
    ); // end e.respondWith
});
