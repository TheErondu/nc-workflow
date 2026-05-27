const CACHE_NAME = 'ncworkflow-v2';
const OFFLINE_URL = '/offline';

const PRECACHE_URLS = [
    '/',
    '/css/app.css',
    '/js/app.js',
    '/js/main.js',
    '/offline',
];

self.addEventListener('install', function (event) {
    event.waitUntil(
        caches.open(CACHE_NAME).then(function (cache) {
            return cache.addAll(PRECACHE_URLS).catch(function () {
                // Silently ignore precache failures (some URLs may 404 in dev)
            });
        }).then(function () {
            return self.skipWaiting();
        })
    );
});

self.addEventListener('activate', function (event) {
    event.waitUntil(
        caches.keys().then(function (cacheNames) {
            return Promise.all(
                cacheNames
                    .filter(function (name) { return name !== CACHE_NAME; })
                    .map(function (name) { return caches.delete(name); })
            );
        }).then(function () {
            return self.clients.claim();
        })
    );
});

// JS bundles that block rendering — let the browser cache handle these directly
var PASSTHROUGH_SCRIPTS = /\/(jquery|settings|app|main|apexcharts|jspdf)[^/]*\.js/;

self.addEventListener('fetch', function (event) {
    // Only handle GET requests for same-origin navigation
    if (event.request.method !== 'GET') return;
    if (!event.request.url.startsWith(self.location.origin)) return;

    // Network-first for HTML pages (always fresh), cache-first for static assets
    var isNavigation = event.request.mode === 'navigate';
    var isAsset = /\.(css|png|jpg|jpeg|gif|svg|ico|woff2?)$/.test(event.request.url);

    if (isNavigation) {
        event.respondWith(
            fetch(event.request).catch(function () {
                return caches.match(OFFLINE_URL) || caches.match('/');
            })
        );
    } else if (isAsset && !PASSTHROUGH_SCRIPTS.test(event.request.url)) {
        event.respondWith(
            caches.match(event.request).then(function (cached) {
                return cached || fetch(event.request).then(function (response) {
                    if (response.ok) {
                        var clone = response.clone();
                        caches.open(CACHE_NAME).then(function (cache) {
                            cache.put(event.request, clone);
                        });
                    }
                    return response;
                });
            })
        );
    }
    // All other requests (JS bundles, API calls, etc.) pass through unintercepted
});

// Push notification handler
self.addEventListener('push', function (event) {
    var data = {};
    if (event.data) {
        try {
            data = event.data.json();
        } catch (e) {
            data = { title: 'NC Workflow', body: event.data.text() };
        }
    }

    var title = data.title || 'NC Workflow';
    var options = {
        body: data.body || 'You have a new notification.',
        icon: '/favicon/android-icon-192x192.png',
        badge: '/favicon/android-icon-96x96.png',
        data: { url: data.url || '/' },
        vibrate: [200, 100, 200],
        requireInteraction: false,
    };

    event.waitUntil(self.registration.showNotification(title, options));
});

// Open the app when a notification is clicked
self.addEventListener('notificationclick', function (event) {
    event.notification.close();
    var targetUrl = (event.notification.data && event.notification.data.url) ? event.notification.data.url : '/';
    event.waitUntil(
        clients.matchAll({ type: 'window', includeUncontrolled: true }).then(function (clientList) {
            for (var i = 0; i < clientList.length; i++) {
                var client = clientList[i];
                if (client.url === targetUrl && 'focus' in client) {
                    return client.focus();
                }
            }
            return clients.openWindow(targetUrl);
        })
    );
});
