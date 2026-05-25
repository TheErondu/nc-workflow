<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="News Central Television.Africa First">
    <meta name="author" content="Erondu">

    <title>{{env('APP_NAME')}}</title>

    <!-- PICK ONE OF THE STYLES BELOW -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/summernote.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/nunito.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Jost.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Jost.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/fixedheader/3.2.0/css/fixedHeader.dataTables.min.css" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#272727">
    <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#272727">
    {{-- PWA --}}
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="NCWorkflow">
    <meta name="vapid-public-key" content="{{ config('webpush.vapid.public_key') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            opacity: 0;
        }
    </style>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ @asset('vendor/larapex-charts/apexcharts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

</head>

<body>
    <div class="splash active">
        <div class="splash-icon"></div>
    </div>

    <div class="wrapper">
        @include('layouts.sidebar')
        <div class="main">
            @include('layouts.navbar')

            <main class="content">
                @yield('content')
                @yield("javascript")
            </main>


            @include('layouts.footer')
        </div>

    </div>

    <svg width="0" height="0" style="position:absolute">
        <defs>
            <symbol viewBox="0 0 512 512" id="ion-ios-pulse-strong">
                <path
                    d="M448 273.001c-21.27 0-39.296 13.999-45.596 32.999h-38.857l-28.361-85.417a15.999 15.999 0 0 0-15.183-10.956c-.112 0-.224 0-.335.004a15.997 15.997 0 0 0-15.049 11.588l-44.484 155.262-52.353-314.108C206.535 54.893 200.333 48 192 48s-13.693 5.776-15.525 13.135L115.496 306H16v31.999h112c7.348 0 13.75-5.003 15.525-12.134l45.368-182.177 51.324 307.94c1.229 7.377 7.397 11.92 14.864 12.344.308.018.614.028.919.028 7.097 0 13.406-3.701 15.381-10.594l49.744-173.617 15.689 47.252A16.001 16.001 0 0 0 352 337.999h51.108C409.973 355.999 427.477 369 448 369c26.511 0 48-22.492 48-49 0-26.509-21.489-46.999-48-46.999z">
                </path>
            </symbol>
        </defs>
    </svg>
    <script src="{{ asset('js/main.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script src="{{ asset('js/summernote.min.js') }}"></script>
    <script>
        $(".alert").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert").slideUp(500);
});
        </script>

    {{-- PWA: Install banner --}}
    <div id="pwa-install-banner" style="display:none;position:fixed;bottom:1rem;left:50%;transform:translateX(-50%);z-index:9999;background:#272727;color:#fff;padding:0.75rem 1.25rem;border-radius:8px;box-shadow:0 4px 16px rgba(0,0,0,0.4);display:none;align-items:center;gap:0.75rem;font-size:0.9rem;max-width:90vw;">
        <img src="{{ asset('favicon/android-icon-48x48.png') }}" style="width:32px;height:32px;border-radius:4px;">
        <span>Install <strong>NC Workflow</strong> for quick access</span>
        <button id="pwa-install-btn" style="background:#fff;color:#272727;border:none;padding:0.35rem 0.9rem;border-radius:4px;cursor:pointer;font-weight:600;white-space:nowrap;">Install</button>
        <button id="pwa-install-dismiss" style="background:transparent;color:#aaa;border:none;cursor:pointer;font-size:1.1rem;line-height:1;">✕</button>
    </div>

    <script>
    (function () {
        // --- Service Worker ---
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/sw.js').then(function (reg) {
                // Push notifications
                var vapidPublicKey = document.querySelector('meta[name="vapid-public-key"]').content;
                if (!vapidPublicKey || !('PushManager' in window)) return;

                reg.pushManager.getSubscription().then(function (existing) {
                    if (!existing) return; // User hasn't subscribed yet; wait for explicit action
                    sendSubscriptionToServer(existing, '{{ route("push.subscribe") }}');
                });
            });
        }

        // --- Install prompt ---
        var deferredPrompt = null;
        var banner = document.getElementById('pwa-install-banner');

        window.addEventListener('beforeinstallprompt', function (e) {
            e.preventDefault();
            deferredPrompt = e;
            banner.style.display = 'flex';
        });

        document.getElementById('pwa-install-btn').addEventListener('click', function () {
            if (!deferredPrompt) return;
            banner.style.display = 'none';
            deferredPrompt.prompt();
            deferredPrompt.userChoice.then(function () { deferredPrompt = null; });
        });

        document.getElementById('pwa-install-dismiss').addEventListener('click', function () {
            banner.style.display = 'none';
            deferredPrompt = null;
        });

        window.addEventListener('appinstalled', function () {
            banner.style.display = 'none';
            deferredPrompt = null;
        });

        // --- Push helpers ---
        function urlBase64ToUint8Array(base64String) {
            var padding = '='.repeat((4 - base64String.length % 4) % 4);
            var base64 = (base64String + padding).replace(/-/g, '+').replace(/_/g, '/');
            var rawData = atob(base64);
            var outputArray = new Uint8Array(rawData.length);
            for (var i = 0; i < rawData.length; ++i) { outputArray[i] = rawData.charCodeAt(i); }
            return outputArray;
        }

        function sendSubscriptionToServer(subscription, url) {
            var key = subscription.getKey ? subscription.getKey('p256dh') : null;
            var auth = subscription.getKey ? subscription.getKey('auth') : null;
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    endpoint: subscription.endpoint,
                    public_key: key ? btoa(String.fromCharCode.apply(null, new Uint8Array(key))) : null,
                    auth_token: auth ? btoa(String.fromCharCode.apply(null, new Uint8Array(auth))) : null,
                })
            });
        }

        // Expose subscribe function so a button in the UI can trigger it
        window.ncSubscribeToPush = function () {
            if (!('serviceWorker' in navigator) || !('PushManager' in window)) {
                alert('Push notifications are not supported in this browser.');
                return;
            }
            var vapidPublicKey = document.querySelector('meta[name="vapid-public-key"]').content;
            Notification.requestPermission().then(function (permission) {
                if (permission !== 'granted') return;
                navigator.serviceWorker.ready.then(function (reg) {
                    reg.pushManager.subscribe({
                        userVisibleOnly: true,
                        applicationServerKey: urlBase64ToUint8Array(vapidPublicKey)
                    }).then(function (sub) {
                        sendSubscriptionToServer(sub, '{{ route("push.subscribe") }}');
                    });
                });
            });
        };
    })();
    </script>
</body>

</html>
