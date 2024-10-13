<script>
    // Set up the views array and delay time
    const views = "{!! $screen->views !!}"; // Assuming $views is a string of words separated by commas
    const viewList = views.split(','); // Convert the string into an array
    const delay = {{$delay ?? 60000}}; // Default delay of 5 seconds if not set

    // Get the current view index from the URL (if present) or default to 0
    const urlParams = new URLSearchParams(window.location.search);
    let viewIndex = parseInt(urlParams.get('viewIndex')) || 0;

    // Function to navigate to a specific view
    function navigateToView() {
        // Generate the URL for the specific view using a combination of PHP and JS
        const newURL = '{{ url("signage/{$screen->name}") }}' + '?view=' + encodeURIComponent(viewList[viewIndex]) + '&viewIndex=' + ((viewIndex + 1) % viewList.length);

        console.log(newURL); // Logs the URL for debugging

        // Redirect to the new URL
        window.location.href = newURL;
    }

    // Set the next navigation after the delay
    setTimeout(navigateToView, delay);

</script>
