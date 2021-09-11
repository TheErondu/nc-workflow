@if($editor_enabled)

@if($codemirror_enabled)
    <script src="{{asset ('js/codemirror.min.js') }}"></script>
    <script src="{{asset ('js/xml.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/{{Kordy\Ticketit\Helpers\Cdn::Summernote}}/summernote-bs4.min.js"></script>
@endif

@if($editor_locale)
<script src="{{ asset('js/summernote.min.js') }}"></script>
@endif
<script>


    $(function() {

        var options = $.extend(true, {lang: '{{$editor_locale}}' {!! $codemirror_enabled ? ", codemirror: {theme: '{$codemirror_theme}', mode: 'text/html', htmlMode: true, lineWrapping: true}" : ''  !!} } , {!! $editor_options !!});

        $("textarea.summernote-editor").summernote(options);

        $("label[for=content]").click(function () {
            $("#content").summernote("focus");
        });
    });


</script>
@endif
