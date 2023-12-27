<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signage Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://unpkg.com/gsap@3.9.0/dist/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.0/color-thief.umd.js"></script>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Lato&display=swap");

        html {
            box-sizing: border-box;

            --gutter: 2.5rem;

            --color-primary: #252525;
            --color-secondary: #fff;
            --color-secondary-rgb: 255, 255, 255;
        }

        html *,
        html *::before,
        html *::after {
            box-sizing: inherit;
        }

        body {
            margin: 0;
            height: 100vh;
            display: flex;
            overflow: hidden;
            flex-direction: column;
            color: var(--color-primary);
            font-family: "Lato", sans-serif;
        }

        button {
            all: unset;
            cursor: pointer;
            -webkit-tap-highlight-color: transparent;
        }

        .inner-container {
            height: 100%;
            margin: 0 auto;
            max-width: 85rem;
            width: calc(100% - var(--gutter));
        }

        /* ---General classes--- */
        .flex-row {
            display: flex;
        }

        .flex-column {
            display: flex;
            flex-direction: column;
        }

        .flex-center {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .justify-between {
            display: flex;
            justify-content: space-between;
        }

        /* ---General classes--- */

        .slider {
            height: 100%;
            overflow: hidden;
        }

        .slider__wrraper {
            height: 100%;
            justify-content: flex-end;
        }

        .slider__img {
            width: 20rem;
            align-self: center;
            margin-bottom: 1.7rem;
        }

        .slider__context {
            font-weight: 900;
            font-size: 1.55rem;
            width: fit-content;
            margin-bottom: 1.5rem;
            text-transform: capitalize;
        }

        .slider__title {
            font-size: 1.1em;
            margin: 0.1rem 0 0.35rem;
        }

        .slider__category {
            margin: 0;
            font-size: 1.55rem;
            letter-spacing: 0.05em;
            color: var(--color-secondary);
        }

        .slider__price {
            font-size: 0.5em;
            font-weight: lighter;
            font-family: sans-serif;
        }

        .context {
            display: flex;
            font-weight: 900;
            font-size: 1.55rem;
            width: fit-content;
            margin-bottom: 3.05em;
            flex-direction: column;
            text-transform: capitalize;
        }

        .slider__footer {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .slider__btns {
            width: 100%;
            font-size: 1.9em;
            align-items: center;
        }

        .slider__btn-buy {
            font-weight: bold;
            font-size: 0.55rem;
            letter-spacing: 1px;
            border-radius: 15px;
            text-transform: uppercase;
            padding: 0.65rem 2.2rem 0.5rem;
            background-color: rgba(var(--color-secondary-rgb), 0.533);
        }

        .slider__btn-switch {
            width: 30px;
            height: 30px;
            position: relative;
            border-radius: 50%;
            margin-inline-start: 0.7rem;
        }

        .slider__btn-switch::before {
            content: "";
            height: 0.3rem;
            width: 0.3rem;
            position: absolute;
            border: 2px solid;
            border-top: unset;
            border-left: unset;
            margin-inline-end: 0.2rem;
            transform: rotate(-45deg);
        }

        .slider__btn-switch--dark {
            background-color: var(--color-primary);
            transform: rotate(180deg);
        }

        .slider__btn-switch--dark::before {
            border-color: var(--color-secondary);
        }

        .slider__btn-switch--light {
            background-color: var(--color-secondary);
        }

        .slider__btn-switch--light::before {
            border-color: var(--color-primary);
        }

        .slider__index {
            right: 0;
            gap: 0 5.7em;
            display: flex;
            font-weight: 900;
            font-weight: 600;
            font-size: 0.85em;
            visibility: hidden;
            position: absolute;
            font-family: system-ui;
            justify-content: center;
            bottom: calc(100% + 0.8em);
        }

        .slider__index :last-child {
            color: var(--color-secondary);
        }

        .slider__index::before {
            top: 55%;
            height: 1%;
            width: 42%;
            content: "";
            position: absolute;
            transform-origin: center;
            background-color: var(--color-primary);
        }

        @media (min-width: 490px) {
            .slider__img {
                width: 29rem;
                margin-bottom: -1rem;
            }

            .slider__context {
                font-size: 1.8rem;
            }

            .slider__index {
                visibility: visible;
            }

            .slider__price {
                font-size: 0.4em;
            }

            .slider__footer {
                font-size: 0.98rem;
                margin-bottom: 2.2em;
            }
        }

        @media (min-width: 830px) {
            .slider__img {
                width: 37rem;
                margin-bottom: -11.5rem;
            }

            .slider__context {
                font-size: 2rem;
                margin-bottom: 1.15em;
            }

            .slider__footer {
                margin-bottom: 2.8em;
            }
        }
    </style>
</head>

<body>
    <div class="slider">
        <div class="inner-container">
            <div class="slider__wrraper flex-column">
                <div class="flex-column slider__content"></div>
                <div class="slider__footer">
                    <div class="slider__btns justify-between">
                        <button class="slider__btn-buy">buy</button>
                        <div class="flex-center">
                            <button data-type="prev"
                                class="slider__btn-switch slider__btn-switch--dark flex-center"></button>
                            <button data-type="next"
                                class="slider__btn-switch slider__btn-switch--light flex-center"></button>
                        </div>
                    </div>
                    <div class="slider__index"></div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    const items = [{
            img: "{{ asset('img/slide2.jpg') }}",
            category: "electrics",
            title: "high bayz",
            price: "£100",
            bgColor: "#ffe474",
        },
        {
            img: "{{ asset('img/slide1.jpg') }}",
            category: "classic",
            title: "insignia purch",
            price: "£300",
            bgColor: "#d2e2d7",
        },
        {
            img: "{{ asset('img/slide2.jpg') }}",
            category: "living",
            title: "bison welder",
            price: "£420",
            bgColor: "#f3c3be",
        },
        {
            img: "{{ asset('img/slide1.jpg') }}",
            category: "watch",
            title: "schemiet watch",
            price: "£267",
            bgColor: "#dedede",
        },
    ];

    const timeLine = gsap.timeline();

    class Slider {
        constructor(items) {
            this.active = 0;
            this.items = items;
            // Automatic transition every 10 seconds
            setInterval(() => this.handleClick("next"), 10000);
        }

        renderItem() {
            const {
                img,
                category,
                title,
                price
            } = this.items[this.active];

            const sliderContent = `
  <img class="slider__img" src="${img}" alt="${title}" />
  <div class="slider__context flex-column">
    <h3 class="slider__category">${category}</h3>
    <strong class="slider__title">${title}</strong>
    <small class="slider__price">${price}</small>
  </div>
`;
            const sliderIndex = `
  <span>${
    this.active < 10 ? "0" + (this.active + 1) : this.active + 1
  }</span>
  <span>${
    this.items.length < 10 ? "0" + this.items.length : this.items.length
  }</span>
`;

            document.querySelector(".slider__content").innerHTML = sliderContent;
            document.querySelector(".slider__index").innerHTML = sliderIndex;
        }

        basicAimation(dir, delay) {
            const colorThief = new ColorThief();

            const image = new Image();
            image.src = items[this.active].img;

            image.onload = () => {
                const dominantColor = colorThief.getColor(image);

                timeLine.to(".slider", {
                    delay,
                    duration: 0.2,
                    backgroundColor: `rgb(${dominantColor[0]}, ${dominantColor[1]}, ${dominantColor[2]})`,
                });

                timeLine.fromTo(
                    ".slider__img", {
                        x: 150 * dir,
                        opacity: 0,
                        duration: 1,
                        ease: "power2.out",
                    }, {
                        x: 0,
                        opacity: 1,
                        duration: 1,
                        ease: "power2.out",
                    }
                );

                timeLine.fromTo(
                    ".slider__context *", {
                        x: 50 * dir,
                        opacity: 0,
                        duration: 0.7,
                        stagger: 0.15,
                        ease: "power2.out",
                    }, {
                        x: 0,
                        opacity: 1,
                        duration: 0.7,
                        stagger: 0.15,
                        ease: "power2.out",
                    },
                    "<"
                );
            };
        }

        handleClick(type) {
            const dir = type === "next" ? 1 : -1;
            timeLine.to(".slider__img", {
                x: -250 * dir,
                opacity: 0,
                duration: 1,
                ease: "power2.inOut",

                onComplete: () => {
                    if (type === "next") {
                        this.active =
                            this.active === items.length - 1 ? 0 : this.active + 1;
                    } else {
                        this.active =
                            this.active <= 0 ? items.length - 1 : this.active - 1;
                    }

                    this.renderItem();
                    this.basicAimation(dir);
                },
            });
            timeLine.to(
                " .slider__context *", {
                    x: -100 * dir,
                    opacity: 0,
                    duration: 0.7,
                    stagger: 0.15,
                    ease: "power2.inOut",
                },
                "<"
            );
        }
    }

    const slider = new Slider(items);
    slider.renderItem();
    slider.basicAimation(1, 1);
</script>
@include('dashboard.signage.main', ['next' => 'showreels'])

</html>
