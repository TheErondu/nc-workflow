@extends('ticketit::layouts.master')
@section('page', trans('ticketit::lang.create-ticket-title'))
@section('page_title', trans('ticketit::lang.create-new-ticket'))

@section('ticketit_content')
    {!! CollectiveForm::open([
    'route' => $setting->grab('main_route') . '.store',
    'method' => 'POST',
]) !!}
    <div class="form-group row">
        {!! CollectiveForm::label('subject', trans('ticketit::lang.subject') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 col-form-label']) !!}
        <div class="col-lg-10">
            {!! CollectiveForm::text('subject', null, ['class' => 'form-control', 'required' => 'required']) !!}
            <small class="form-text text-muted">{!! trans('ticketit::lang.create-ticket-brief-issue') !!}</small>
        </div>
    </div>
    <div class="form-group row">
        {!! CollectiveForm::label('content', trans('ticketit::lang.description') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 col-form-label']) !!}
        <div class="col-lg-10">
            {!! CollectiveForm::textarea('content', null, ['class' => 'form-control summernote-editor', 'rows' => '5', 'required' => 'required']) !!}
            <small class="form-text text-muted">{!! trans('ticketit::lang.create-ticket-describe-issue') !!}</small>
        </div>
    </div>
    <div class=" row justify-content-evenly">
        <div class="mb-3 col-md-3">
            {!! CollectiveForm::label('priority', trans('ticketit::lang.priority') . trans('ticketit::lang.colon'), ['class' => 'col-lg-6 col-form-label']) !!}

            {!! CollectiveForm::select('priority_id', $priorities, null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="mb-3 col-md-3">
            {!! CollectiveForm::label('category', trans('ticketit::lang.category') . trans('ticketit::lang.colon'), ['class' => 'col-lg-6 col-form-label']) !!}

            {!! CollectiveForm::select('category_id', $categories, null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        {!! CollectiveForm::hidden('agent_id', 'auto') !!}
    </div>
    <br>
    <div class=" row justify-content-evenly">
        <div class="mb-3 col-md-3">
            {!! link_to_route($setting->grab('main_route') . '.index', trans('ticketit::lang.btn-back'), null, ['class' => 'btn btn-primary']) !!}
            &nbsp;
            {!! CollectiveForm::submit(trans('ticketit::lang.btn-submit'), ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    {!! CollectiveForm::close() !!}
@endsection

@section('footer')
    @include('ticketit::tickets.partials.summernote')
@append
