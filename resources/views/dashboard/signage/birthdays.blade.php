@if(isset($slides) && count($slides) > 0)
{{-- ===== BIRTHDAY SLIDES VIEW ===== --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birthday Celebrations</title>
    <script src="{{ asset('js/three.min.js') }}"></script>
    <script src="{{ asset('js/TweenMax.min.js') }}"></script>
    <script src="{{ asset('js/bas.js') }}"></script>
    <script src="{{ asset('js/OrbitControls-2.js') }}"></script>

    <style>
        @import url(https://fonts.googleapis.com/css?family=Montserrat:700);

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
            border: 0;
        }

        html {
            font-size: 10px;
            font-size: calc(5px + 0.4vw);
        }

        body {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            color: #fff;
        }

        a {
            text-decoration: none;
            color: rgba(225, 255, 255, .8);
        }

        /* Slider style */
        .cd-slider {
            position: relative;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        .cd-slider.ie9 nav div span {
            display: none;
        }

        .cd-slider ul li {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            visibility: hidden;
            transition: visibility 0s .6s;
        }

        .cd-slider ul li::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            border-radius: 100%;
            width: 135vh;
            height: 135vh;
            border: solid rgba(0, 0, 0, 0.2);
            border-width: 0;
            transform: translate(-50%, -50%);
            pointer-events: none;
            transition: border-width .4s .6s;
        }

        .content {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-position: 50% 100%;
            background-size: auto 100%;
            background-repeat: no-repeat;
            mix-blend-mode: lighten;
            opacity: 0;
            transform: scale(1.2);
            transition: opacity .4s .6s, transform .4s .6s;
        }

        /* current slide */
        .cd-slider li.current_slide {
            visibility: visible;
        }

        .cd-slider li.current_slide::before {
            border-width: 16rem;
        }

        .cd-slider li.current_slide .content {
            opacity: 1;
            transform: scale(1);
        }

        /* nav */
        nav div {
            position: absolute;
            top: 50%;
            left: 4%;
            width: 5rem;
            height: 5rem;
            margin-top: -2.5rem;
            list-style: none;
        }

        nav div:last-of-type {
            left: auto;
            right: 4%;
        }

        .prev,
        .next {
            position: relative;
            z-index: 100;
            width: 100%;
            height: 100%;
            display: none;
            border-radius: 100%;
            transition: box-shadow .3s;
        }

        .prev::before,
        .prev::after,
        .next::before,
        .next::after {
            content: '';
            position: absolute;
            left: 43%;
            background: #fff;
            width: .4rem;
            min-width: 3px;
            border-radius: 3px;
            height: 34%;
        }

        .prev::before {
            transform: rotate(45deg);
            top: 24%;
        }

        .prev::after {
            transform: rotate(-45deg);
            bottom: 24%;
        }

        .next::before,
        .next::after {
            left: auto;
            right: 43%;
        }

        .next::before {
            transform: rotate(-45deg);
            top: 24%;
        }

        .next::after {
            transform: rotate(45deg);
            bottom: 24%;
        }

        .prev:hover,
        .next:hover {
            box-shadow: 0 0 0 1rem rgba(0, 0, 0, 0.15);
        }

        nav>div>span {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 100%;
            z-index: 5;
            pointer-events: none;
            will-change: width, height;
            transform: translate(-50%, -50%);
            transition: width .6s, height .6s;
        }
    </style>
</head>

<body>
    <section class="cd-slider">
        <ul>
            @foreach($slides as $slide)
            <li data-color="#00000000">
                <div class="content"
                    style="background-image:url({{ $slide->image_url }}?v={{ $slide->updated_at->timestamp }})">
                </div>
            </li>
            @endforeach
        </ul>
        <nav>
            <div><a class="prev" href="#"></a></div>
            <div><a class="next" href="#"></a></div>
        </nav>
    </section>
</body>
<script>
    (function() {
        const views = @json(is_array($screen->views) ? $screen->views : explode(',', $screen->views ?? ''));
        const viewList = Array.isArray(views) ? views : views.split(',');
        const viewDuration = {{ $screen->view_duration ?? 60000 }};

        const urlParams = new URLSearchParams(window.location.search);
        let viewIndex = urlParams.has('viewIndex') ? parseInt(urlParams.get('viewIndex')) : 0;
        viewIndex = viewIndex % viewList.length;
        const newURL = '{{ url("signage/show/{$screen->name}") }}' + '?view=' + encodeURIComponent(viewList[
            viewIndex]) + '&viewIndex=' + ((viewIndex + 1) % viewList.length);

        var autoUpdate = true,
            timeTrans = {{ $screen->slide_duration ?? 7000 }},
            cdSlider = document.querySelector('.cd-slider'),
            item = cdSlider.querySelectorAll("li"),
            nav = cdSlider.querySelector("nav");

        item[0].className = "current_slide";

        for (var i = 0, len = item.length; i < len; i++) {
            var color = item[i].getAttribute("data-color");
            item[i].style.backgroundColor = color;
        }

        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE");
        if (msie > 0) {
            var version = parseInt(ua.substring(msie + 5, ua.indexOf(".", msie)));
            if (version === 9) {
                cdSlider.className = "cd-slider ie9";
            }
        }

        if (item.length <= 1) {
            nav.style.display = "none";
        }

        function prevSlide() {
            var currentSlide = cdSlider.querySelector("li.current_slide"),
                prevElement = currentSlide.previousElementSibling,
                prevSlide = (prevElement !== null) ? prevElement : item[item.length - 1],
                prevColor = prevSlide.getAttribute("data-color"),
                el = document.createElement('span');

            currentSlide.className = "";
            prevSlide.className = "current_slide";

            nav.children[0].appendChild(el);

            var size = (cdSlider.clientWidth >= cdSlider.clientHeight) ? cdSlider.clientWidth * 2 : cdSlider
                .clientHeight * 2,
                ripple = nav.children[0].querySelector("span");

            ripple.style.height = size + 'px';
            ripple.style.width = size + 'px';
            ripple.style.backgroundColor = prevColor;

            ripple.addEventListener("transitionend", function() {
                if (this.parentNode) {
                    this.parentNode.removeChild(this);
                }
            });
        }

        function nextSlide() {
            var currentSlide = cdSlider.querySelector("li.current_slide"),
                nextElement = currentSlide.nextElementSibling,
                nextSlide = (nextElement !== null) ? nextElement : item[0],
                nextColor = nextSlide.getAttribute("data-color"),
                el = document.createElement('span');

            currentSlide.className = "";
            nextSlide.className = "current_slide";

            nav.children[1].appendChild(el);

            var size = (cdSlider.clientWidth >= cdSlider.clientHeight) ? cdSlider.clientWidth * 2 : cdSlider
                .clientHeight * 2,
                ripple = nav.children[1].querySelector("span");

            ripple.style.height = size + 'px';
            ripple.style.width = size + 'px';
            ripple.style.backgroundColor = nextColor;

            ripple.addEventListener("transitionend", function() {
                if (this.parentNode) {
                    this.parentNode.removeChild(this);
                }
            });
        }

        function updateNavColor() {
            var currentSlide = cdSlider.querySelector("li.current_slide");

            var nextColor = (currentSlide.nextElementSibling !== null) ? currentSlide.nextElementSibling
                .getAttribute("data-color") : item[0].getAttribute("data-color");
            var prevColor = (currentSlide.previousElementSibling !== null) ? currentSlide.previousElementSibling
                .getAttribute("data-color") : item[item.length - 1].getAttribute("data-color");

            if (item.length > 2) {
                nav.querySelector(".prev").style.backgroundColor = prevColor;
                nav.querySelector(".next").style.backgroundColor = nextColor;
            }
        }

        nav.querySelector(".next").addEventListener('click', function(event) {
            event.preventDefault();
            nextSlide();
            updateNavColor();
        });

        nav.querySelector(".prev").addEventListener("click", function(event) {
            event.preventDefault();
            prevSlide();
            updateNavColor();
        });

        var intervalId = setInterval(function() {
            if (autoUpdate) {
                nextSlide();
                updateNavColor();
            }
        }, timeTrans);

        if (item.length == 1) {
            setTimeout(function() {
                window.location.href = newURL;
            }, viewDuration);
        } else {
            var totalSlideTime = item.length * timeTrans;
            var switchTime = Math.min(totalSlideTime, viewDuration);

            setTimeout(function() {
                window.location.href = newURL;
                clearInterval(intervalId);
            }, switchTime);
        }
    })();
</script>

</html>
@else
{{-- ===== NO BIRTHDAYS TODAY ===== --}}
<!doctype html>
<html lang="en">

<head>
    <title>Birthday Celebrations</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: #fff;
            min-height: 100vh;
            overflow: hidden;
        }

        .container {
            padding: 2rem 3rem;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            flex-shrink: 0;
            background: #d71f27;
            margin: -2rem -3rem 2rem -3rem;
            padding: 1.5rem 3rem;
        }

        .header-icon {
            width: 70px;
            height: 70px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1.5rem;
        }

        .header-icon svg {
            width: 40px;
            height: 40px;
            fill: white;
        }

        .header-title {
            color: #fff;
            font-size: 3rem;
            font-weight: 700;
        }

        .no-birthdays {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex: 1;
        }

        .no-birthdays svg {
            width: 160px;
            height: 160px;
            fill: #ccc;
            margin-bottom: 2.5rem;
        }

        .no-birthdays p {
            font-size: 3.5rem;
            font-weight: 700;
            color: #888;
        }

        .no-birthdays .sub {
            font-size: 1.8rem;
            font-weight: 400;
            color: #aaa;
            margin-top: 0.8rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="header-icon">
                {{-- Birthday cake icon --}}
                <svg viewBox="0 0 24 24"><path d="M12 6c1.11 0 2-.9 2-2 0-.38-.1-.73-.29-1.03L12 0l-1.71 2.97c-.19.3-.29.65-.29 1.03 0 1.1.9 2 2 2zm4.6 9.99l-1.07-1.07-1.08 1.07c-1.3 1.3-3.58 1.31-4.89 0l-1.07-1.07-1.09 1.07C6.75 16.64 5.88 17 4.96 17c-.73 0-1.4-.23-1.96-.61V21c0 .55.45 1 1 1h16c.55 0 1-.45 1-1v-4.61c-.56.38-1.23.61-1.96.61-.92 0-1.79-.36-2.44-1.01zM18 9h-5V7h-2v2H6c-1.66 0-3 1.34-3 3v1.54c0 1.08.88 1.96 1.96 1.96.52 0 1.02-.2 1.38-.57l2.14-2.13 2.13 2.13c.74.74 2.03.74 2.77 0l2.14-2.13 2.13 2.13c.37.37.86.57 1.38.57 1.08 0 1.96-.88 1.96-1.96V12c.01-1.66-1.33-3-2.99-3z"/></svg>
            </div>
            <h1 class="header-title">Birthday Celebrations</h1>
        </div>

        <div class="no-birthdays">
            {{-- Large cake icon --}}
            <svg viewBox="0 0 24 24"><path d="M12 6c1.11 0 2-.9 2-2 0-.38-.1-.73-.29-1.03L12 0l-1.71 2.97c-.19.3-.29.65-.29 1.03 0 1.1.9 2 2 2zm4.6 9.99l-1.07-1.07-1.08 1.07c-1.3 1.3-3.58 1.31-4.89 0l-1.07-1.07-1.09 1.07C6.75 16.64 5.88 17 4.96 17c-.73 0-1.4-.23-1.96-.61V21c0 .55.45 1 1 1h16c.55 0 1-.45 1-1v-4.61c-.56.38-1.23.61-1.96.61-.92 0-1.79-.36-2.44-1.01zM18 9h-5V7h-2v2H6c-1.66 0-3 1.34-3 3v1.54c0 1.08.88 1.96 1.96 1.96.52 0 1.02-.2 1.38-.57l2.14-2.13 2.13 2.13c.74.74 2.03.74 2.77 0l2.14-2.13 2.13 2.13c.37.37.86.57 1.38.57 1.08 0 1.96-.88 1.96-1.96V12c.01-1.66-1.33-3-2.99-3z"/></svg>
            <p>No Birthdays Today</p>
            <p class="sub">Check back tomorrow</p>
        </div>
    </div>

    @include('dashboard.signage.main', ['delay' => $screen->view_duration ?? 60000])
</body>

</html>
@endif
