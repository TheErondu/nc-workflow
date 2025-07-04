<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signage Page</title>
    <script src="{{ asset('js/three.min.js') }}"></script>
    <script src="{{ asset('js/TweenMax.min.js') }}"></script>
    <script src="{{ asset('js/bas.js') }}"></script>
    <script src="{{ asset('js/OrbitControls-2.js') }}"></script>

    <style>
        .info {
            position: absolute;
            top: 0;
            right: 0;
            z-index: 9999999;
            margin: 1.5rem;
        }

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

        .content blockquote {
            position: absolute;
            bottom: 5%;
            left: 4%;
            z-index: 2;
            max-width: 45%;
        }

        blockquote p {
            font-size: 4rem;
            margin-bottom: 2rem;
        }

        blockquote span {
            font-size: 1.4rem;
        }

        /* current slide
---------------------------------*/
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

        /* nav
---------------------------------*/
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
            <li data-color="#00000000">
                <div class="content" style="background-image:url({{ asset('signage-slides/birthdays/26-06-2025/1.jpg') }}?v=4)">

                </div>
            </li>
            {{-- <li data-color="#00000000">
                <div class="content" style="background-image:url({{ asset('signage-slides/process/2.jpg') }}?v=2)">

                </div>
            </li>
            <li data-color="#00000000">
                <div class="content" style="background-image:url({{ asset('signage-slides/process/3.jpg') }}?v=2.1">
                </div>
            </li>
            <li data-color="#00000000">
                <div class="content" style="background-image:url({{ asset('signage-slides/process/4.jpg') }}?v=2.1">

                </div>
            </li>
            <li data-color="#00000000">
                <div class="content" style="background-image:url({{ asset('signage-slides/process/5.jpg') }}?v=2.1">
                </div>
            </li>
            <li data-color="#00000000">
                <div class="content" style="background-image:url({{ asset('signage-slides/process/6.jpg') }}?v=2.1">
                </div>
            </li>
            <li data-color="#00000000">
                <div class="content" style="background-image:url({{ asset('signage-slides/process/7.jpg') }}?v=2.1">
                </div>
            </li>
            <li data-color="#00000000">
                <div class="content" style="background-image:url({{ asset('signage-slides/process/8.jpg') }}?v=2.1">
                </div>
            </li>
            <li data-color="#00000000">
                <div class="content" style="background-image:url({{ asset('signage-slides/process/9.jpg') }}?v=2.1">
                </div>
            </li>
            <li data-color="#00000000">
                <div class="content" style="background-image:url({{ asset('signage-slides/process/10.jpg') }}?v=2.1">
                </div>
            </li>
            <li data-color="#00000000">
                <div class="content" style="background-image:url({{ asset('signage-slides/process/11.jpg') }}?v=2.1">
                </div>
            </li>
            <li data-color="#00000000">
                <div class="content" style="background-image:url({{ asset('signage-slides/process/12.jpg') }}?v=2.1">
                </div>
            </li> --}}
        </ul>
        <nav>
            <div><a class="prev" href="#"></a></div>
            <div><a class="next" href="#"></a></div>
        </nav>
    </section>
</body>
<script>
    (function() {
        var autoUpdate = true,
            timeTrans = 7000,
            cdSlider = document.querySelector('.cd-slider'),
            item = cdSlider.querySelectorAll("li"),
            nav = cdSlider.querySelector("nav");

        item[0].className = "current_slide";

        for (var i = 0, len = item.length; i < len; i++) {
            var color = item[i].getAttribute("data-color");
            item[i].style.backgroundColor = color;
        }

        // Detect IE
        // hide ripple effect on IE9
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

            ripple.addEventListener("webkitTransitionEnd", function() {
                if (this.parentNode) {
                    this.parentNode.removeChild(this);
                }
            });

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

            ripple.addEventListener("webkitTransitionEnd", function() {
                if (this.parentNode) {
                    this.parentNode.removeChild(this);
                }
            });

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

        // Set up the views array and delay time
        const views = "{!! request('screen')->views !!}"; // Assuming $views is a string of words separated by commas
        const viewList = views.split(','); // Convert the string into an array
        const delay = {{ $delay ?? 5000 }}; // Default delay of 5 seconds if not set

        const urlParams = new URLSearchParams(window.location.search);
        let viewIndex = urlParams.has('viewIndex') ? parseInt(urlParams.get('viewIndex')) : 0;

        // Ensure viewIndex is within bounds
        viewIndex = viewIndex % viewList.length;
        const newURL = '{{ url("signage/show/{$screen->name}") }}' + '?view=' + encodeURIComponent(viewList[
            viewIndex]) + '&viewIndex=' + ((viewIndex + 1) % viewList.length);


        // autoUpdate
        var intervalId = setInterval(function() {
            if (autoUpdate) {
                nextSlide();
                updateNavColor();
            }
        }, timeTrans);

        if(item.length == 1){
            return;
        }
        else{
            // Set timeout for redirection after the last slide
        setTimeout(function() {
            window.location.href = newURL;
            clearInterval(intervalId); // Stop the autoUpdate interval
        }, (item.length * timeTrans));
        }

    })();
</script>

</html>
