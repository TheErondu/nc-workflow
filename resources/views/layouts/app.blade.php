<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <style>
        html, body { background-color: #000; }
        .splash { display: flex !important; visibility: visible !important; }
        .splash .splash-icon {
            background: #28304e;
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            z-index: 100;
        }
        .splash.active .splash-icon:after {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            margin-left: -20px;
            margin-top: -20px;
            width: 40px;
            height: 40px;
            box-sizing: border-box;
            border: 5px solid #fff;
            border-radius: 50%;
            border-top-color: rgba(0, 0, 0, 0.2);
            animation: splash-spinner 1.2s linear infinite;
        }
        @keyframes splash-spinner {
            0% { transform: rotate(0deg); }
            to { transform: rotate(359deg); }
        }
        .wrapper { opacity: 0; transition: opacity 0.3s ease; }
    </style>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="News Central Television.Africa First">
    <meta name="author" content="Erondu">

    <title>{{env('APP_NAME')}}</title>

    <!-- PICK ONE OF THE STYLES BELOW -->
    <link rel="preload" href="{{ asset('css/app.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="{{ asset('css/app.css') }}" rel="stylesheet"></noscript>
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
    <meta name="msapplication-TileColor" content="#272727">
    <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#272727">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
        // Reveal page content once DOM is ready (pairs with .wrapper { opacity: 0 } in <head>)
        $(document).ready(function () {
            $('.wrapper').css('opacity', 1);
        });
        $(".alert").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert").slideUp(500);
});
        </script>

    {{-- Notification toast container --}}
    <div id="nc-toast-container"
        style="position:fixed;top:68px;right:16px;z-index:10050;display:flex;flex-direction:column;gap:8px;pointer-events:none;"></div>

    @role('Admin')
    <script>
    (function () {
        var POLL_INTERVAL = 30000;
        var lastUnread    = -1; // -1 so first poll never triggers toasts on page load
        var csrfToken     = document.querySelector('meta[name="csrf-token"]').content;

        // Unlock AudioContext on first user interaction
        var audioCtx = null;
        function getAudioCtx() {
            if (!audioCtx) audioCtx = new (window.AudioContext || window.webkitAudioContext)();
            if (audioCtx.state === 'suspended') audioCtx.resume();
            return audioCtx;
        }
        document.addEventListener('click', function () { getAudioCtx(); }, { once: true });

        // Ascending arpeggio = raised, descending = closed
        function playRing(type) {
            try {
                var ctx   = getAudioCtx();
                var notes = type === 'closed' ? [783.99, 659.25, 523.25] : [523.25, 659.25, 783.99];
                notes.forEach(function (freq, i) {
                    var osc  = ctx.createOscillator();
                    var gain = ctx.createGain();
                    osc.connect(gain);
                    gain.connect(ctx.destination);
                    osc.type = 'sine';
                    osc.frequency.value = freq;
                    var t = ctx.currentTime + i * 0.18;
                    gain.gain.setValueAtTime(0.25, t);
                    gain.gain.exponentialRampToValueAtTime(0.001, t + 0.35);
                    osc.start(t);
                    osc.stop(t + 0.35);
                });
            } catch (e) {}
        }

        function showToast(title, body, link, ring) {
            var container = document.getElementById('nc-toast-container');
            var color = ring === 'closed' ? '#27ae60' : '#e84040';
            var icon  = ring === 'closed' ? 'fa-check-circle' : 'fa-exclamation-circle';
            var div   = document.createElement('div');
            div.style.cssText = 'background:#1c1c1c;border:1px solid ' + color + ';border-left:4px solid ' + color + ';' +
                'border-radius:6px;padding:10px 14px;color:#eee;font-size:.82rem;max-width:300px;' +
                'box-shadow:0 4px 16px rgba(0,0,0,.5);cursor:pointer;transition:opacity .4s;pointer-events:auto;';
            div.innerHTML =
                '<div style="font-weight:600;margin-bottom:3px;">' +
                '<i class="fas ' + icon + '" style="color:' + color + ';margin-right:6px;"></i>' + title + '</div>' +
                '<div style="color:#aaa;">' + body + '</div>';
            div.addEventListener('click', function () { window.location.href = link; });
            container.appendChild(div);
            setTimeout(function () {
                div.style.opacity = '0';
                setTimeout(function () { if (div.parentNode) div.remove(); }, 400);
            }, 7000);
        }

        function updateBadge(count) {
            var badge = document.getElementById('notif-badge');
            if (!badge) return;
            if (count > 0) {
                badge.textContent = count > 99 ? '99+' : count;
                badge.style.display = 'inline-block';
            } else {
                badge.style.display = 'none';
            }
        }

        function renderList(notifications) {
            var list  = document.getElementById('notif-list');
            var empty = document.getElementById('notif-empty');
            if (!list) return;
            list.querySelectorAll('.notif-item').forEach(function (el) { el.remove(); });
            if (!notifications.length) {
                if (empty) empty.style.display = 'block';
                return;
            }
            if (empty) empty.style.display = 'none';
            notifications.forEach(function (n) {
                var color = n.ring === 'closed' ? '#27ae60' : '#e84040';
                var label = n.ring === 'closed' ? 'Resolved' : 'New Issue';
                var sub   = n.ring === 'closed'
                    ? (n.fixed_by   ? 'Fixed by ' + n.fixed_by   : '')
                    : (n.raised_by  ? 'Raised by ' + n.raised_by : '');
                var a = document.createElement('a');
                a.href = n.link;
                a.dataset.notifId   = n.id;
                a.dataset.notifLink = n.link;
                a.className = 'dropdown-item notif-item d-flex align-items-start gap-2 py-2';
                a.style.cssText = 'border-bottom:1px solid #2a2a2a;font-size:.8rem;white-space:normal;';
                a.innerHTML =
                    '<span style="width:8px;height:8px;border-radius:50%;background:' + color + ';margin-top:5px;flex-shrink:0;" class="notif-dot"></span>' +
                    '<div><div style="font-weight:600;">' + label + ': ' + (n.item_name || '') + '</div>' +
                    (sub ? '<div style="color:#aaa;">' + sub + '</div>' : '') +
                    '<div style="color:#666;font-size:.72rem;">' + (n.created_at || '') + '</div></div>';
                a.addEventListener('click', function (e) {
                    e.preventDefault();
                    var id   = this.dataset.notifId;
                    var link = this.dataset.notifLink;
                    var dot  = this.querySelector('.notif-dot');
                    if (dot) dot.style.background = '#555';
                    lastUnread = Math.max(0, lastUnread - 1);
                    updateBadge(lastUnread);
                    fetch('{{ url("notifications") }}/' + id + '/mark-one', {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' }
                    }).finally(function () {
                        window.location.href = link;
                    });
                });
                if (empty && empty.parentNode === list) {
                    list.insertBefore(a, empty);
                } else {
                    list.appendChild(a);
                }
            });
        }

        function poll() {
            fetch('{{ route("notifications.unread") }}', {
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': csrfToken }
            })
            .then(function (r) { return r.json(); })
            .then(function (data) {
                var count = data.unread_count || 0;
                updateBadge(count);
                renderList(data.notifications || []);

                // Only ring+toast when count genuinely grew (skip first poll to avoid noise on page load)
                if (lastUnread >= 0 && count > lastUnread) {
                    var newItems = (data.notifications || []).slice(0, count - lastUnread);
                    newItems.forEach(function (n) {
                        playRing(n.ring);
                        var title = n.ring === 'closed'
                            ? 'Resolved: '  + n.item_name
                            : 'New Issue: ' + n.item_name;
                        var body = n.ring === 'closed'
                            ? (n.fixed_by  ? 'Fixed by ' + n.fixed_by  : 'Marked as closed')
                            : (n.raised_by ? 'Raised by ' + n.raised_by : '');
                        showToast(title, body, n.link, n.ring);
                    });
                }
                lastUnread = count;
            })
            .catch(function () {});
        }

        document.addEventListener('DOMContentLoaded', function () {
            var btn = document.getElementById('notif-mark-read');
            if (btn) {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    fetch('{{ route("notifications.mark-read") }}', {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' }
                    }).then(function () {
                        lastUnread = 0;
                        updateBadge(0);
                        renderList([]);
                    });
                });
            }
            poll();
            setInterval(poll, POLL_INTERVAL);
        });
    })();
    </script>
    @endrole
</body>

</html>
