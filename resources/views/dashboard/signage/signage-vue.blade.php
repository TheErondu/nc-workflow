<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fullscreen Presentation</title>
</head>
<body>
    <div id="app"></div>
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        const app = new Vue({
            el: '#app',
            components: {
                FullscreenPresentation: require('./components/FullscreenPresentation.vue').default,
            },
            template: '<FullscreenPresentation />',
        });
    </script>
</body>
</html>
