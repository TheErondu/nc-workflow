
<script>

    // Set the URL to navigate to
    const newURL = '{{ route('signage.show') }}?display={{ $next }}';

    // Delayed navigation after 7 seconds
    setTimeout(function() {
        window.location.href = newURL;
    }, {{$delay}});
    // 7000 milliseconds = 7 seconds
</script>
