@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #272727;">
                        <h5 class="card-title" style="color: white;">NOTIFICATIONS DETAIL PAGE</h5>

                    </div>
                    <div class="row">
                        @if (Session::has('message'))
                            <div class="container">
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <div class="alert-icon">
                                        <i class="far fa-fw fa-bell"></i>
                                    </div>
                                    <div class="alert-message">
                                        <strong> {{ session('message') }}</strong>
                                    </div>

                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="container">
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    @foreach ($errors->all() as $error)
                                        <div class="alert-icon">
                                            <i class="far fa-fw fa-bell"></i>
                                        </div>
                                        <div class="alert-message">
                                            <strong> {{ $error }}</strong>
                                        </div>

                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('messages.update', $message->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="mb-3">
                                    <label for="title">title</label>
                                    <input name="title" type="text" class="form-control" id="title" value="{{$message->title}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <label>Type</label>
                                    <select name="type" class="form-control mb-3" required>
                                        <option value="{{$message->type}}">{{$message->type}}</option>
                                        <option value="message">Messages</option>
                                        <option value="notification">Notification</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group row">
                                    <label for="message" class="col-lg-2 col-form-label">Message Body: </label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control summernote-editor" placeholder="" rows="5" name="message" cols="50" id="message">{{ $message->message }} </textarea>
                                        <small class="form-text text-muted">Format text as you want it to appear</small>
                                    </div>
                                </div>

                            </div>
                            <div class="mb-3">
                                <label class="form-label">Upload file</label>
                                <input id="file" name="file" class="form-control" value="{{ $message->file }} " type="file">
                            </div>
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-6">
                                    <a href="{{ route('messages.index') }}" style="background-color: red !important;"
                                        class="btn btn-primary">Cancel</a>
                                </div>
                                <div class="mb-3 col-md-1">
                                    <button style="background-color: green !important;" type="submit"
                                        class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('javascript')
<script src="{{asset ('js/codemirror.min.js') }}"></script>
<script src="{{asset ('js/xml.min.js') }}"></script>

<script src="{{asset ('js/summernote.min.js') }}"></script>
<script src="{{asset ('js/summernote-cleaner.js') }}"></script>

<script>


$(function() {

    var options = $.extend(true, {lang: '' , codemirror: {theme: 'monokai', mode: 'text/html', htmlMode: true, lineWrapping: true} } , {
        toolbar:[
        ['cleaner',['cleaner']], // The Button
        ['style',['style']],
        ['font',['bold','italic','underline','clear']],
        ['fontname',['fontname']],
        ['fontcolor',['color']],
        ['para',['ul','ol','paragraph']],
        ['height',['height']],
        ['table',['table']],
        ['insert',['media','link','hr']],
        ['help',['help']]
    ],
    cleaner:{
          action: 'both',
          newline: '<br>',
          icon: '<i class="note-icon">[Your Button]</i>',
          keepHtml: false,
          keepOnlyTags: ['<p>', '<br>', '<ul>', '<li>', '<b>', '<strong>','<i>', '<a>'],
          keepClasses: false,
          badTags: ['style', 'script', 'applet', 'embed', 'noframes', 'noscript', 'html'],
          badAttributes: ['style', 'start'],
          limitChars: false,
          limitDisplay: 'both',
          limitStop: false
    }
});

    $("textarea.summernote-editor").summernote(options);

    $("label[for=message]").click(function () {


        $("#message").summernote("focus");
    });
});


</script>
<script src="{{asset ('js/summernote-cleaner.js') }}"></script>
@endsection
