{{--
<script>
    // Set the URL to navigate to
    const newURL = '{{ route('signage.show') }}?display={{ $next }}';

    // Function to check internet connectivity
    function checkInternetConnection() {
        return navigator.onLine;
    }

    // Function to retry navigation every 5 seconds
    function retryNavigation() {
        setTimeout(function() {
            if (checkInternetConnection()) {
                // If online, navigate to the new URL
                window.location.href = newURL;
            } else {
                // If offline, retry after 5 seconds
                retryNavigation();
            }
        }, 5000); // Retry every 5 seconds (5000 milliseconds)
    }

    // Initial check and start retrying if offline
    if (checkInternetConnection()) {
        // If online, navigate to the new URL after 1 minute
        setTimeout(function() {
            window.location.href = newURL;
        }, 60000); // 60000 milliseconds = 1 minute
    } else {
        // If offline, start retrying every 5 seconds
        retryNavigation();
    }
</script>
 --}}
