@if($errors->first() != '')
    <div class="container">
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
@if(Session::has('warning'))
<div class="container">
<div class="alert alert-danger alert-dismissible" role="alert">
    <div class="alert-icon">
        <i class="far fa-fw fa-bell"></i>
    </div>
    <div class="alert-message">
        <strong> {{ session('warning') }}</strong>
    </div>

    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
</div>
@endif
@if(Session::has('status'))
<div class="container">
<div class="alert alert-success alert-dismissible" role="alert">
    <div class="alert-icon">
        <i class="far fa-fw fa-bell"></i>
    </div>
    <div class="alert-message">
        <strong> {{ session('status') }}</strong>
    </div>

    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
</div>
@endif
