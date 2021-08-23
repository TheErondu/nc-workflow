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
                        <form method="POST" enctype="multipart/form-data" action="{{ route('messages.store') }}">
                            @csrf
                            <div class="row">
                                <div class="mb-3">
                                    <label for="title">title</label>
                                    <input name="title" type="text" class="form-control" id="title" placeholder="title">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <label>Type</label>
                                    <select name="type" class="form-control mb-3" required>
                                        <option value="">Choose message type</option>
                                        <option value="message">Messages</option>
                                        <option value="notification">Notification</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group row">
                                    <label for="message" class="col-lg-2 col-form-label">Message Body: </label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control summernote-editor" rows="5" name="message" cols="50" id="message"></textarea>
                                        <small class="form-text text-muted">Format text as you want it to appear</small>
                                    </div>
                                </div>

                            </div>
                            <div class="mb-3">
                                <label class="form-label">Upload file</label>
                                <input id="file" name="file" class="form-control" type="file">
                            </div>
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-6">
                                    <a href="{{ route('messages.index') }}" style="background-color: red !important;"
                                        class="btn btn-primary">Cancel</a>
                                </div>
                                <div class="mb-3 col-md-1">
                                    <button style="background-color: green !important;" type="submit"
                                        class="btn btn-primary">Create</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.4/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.4/mode/xml/xml.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.min.js"></script>
<script>


$(function() {

    var options = $.extend(true, {lang: '' , codemirror: {theme: 'monokai', mode: 'text/html', htmlMode: true, lineWrapping: true} } , {
        
"toolbar": [
    ["style", ["style"]],
    ["font", ["bold", "underline", "italic", "clear"]],
    ["fontsize", ["fontsize"]],
    ["fontname", ["fontname"]],
    ["color", ["color"]],
    ["para", ["ul", "ol", "paragraph"]],
    ["table", ["table"]],
    ["height", ["height"]],
    ["insert", ["link", "picture", "video"]],
    ["view", ["fullscreen", "codeview", "help"]]
    ["style", ["style"]],
    ["help", ["help"]]
]
});

    $("textarea.summernote-editor").summernote(options);

    $("label[for=message]").click(function () {
        $("#message").summernote("focus");
    });
});


</script>
@endsection
