@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __("Enter Today's log") }}</div>

                <div class="card-body">
                    <div>
                        <form method="POST" enctype="multipart/form-data" action="{{ route('engineers.store') }}">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="mb-3 col-md-4">
                                    <label for="assigned_department"> Date</label>
                                    <div class="input-group date" id="datetimepicker-minimum"
                                        data-target-input="nearest">
                                        <input name="log_date" type="text" class="form-control datetimepicker-input"
                                            data-target="#datetimepicker-minimum" />
                                        <div class="input-group-text" data-target="#datetimepicker-minimum"
                                            data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                                <div class="row justify-content-around">
                                <div class="mb-3 col-md-12">
                                    <label for="problems">Problems Encountered ( Numbered: Problem .1 should match Resolution .1)</label>
                                    <textarea placeholder="What techincal issues occured today?" name="problems" type="text" class="form-control" required id="problems"></textarea>
                                </div>
                            </div>
                            <div class="row justify-content-around">
                                <div class="mb-3 col-md-12">
                                    <label for="resolutions">Solutions</label>
                                    <textarea placeholder="How were the Problems Solved?" required name="resolutions" type="text" class="form-control" id="resolutions"></textarea>
                                </div>
                            </div>
                            <div class="row justify-content-around">
                                <div class="mb-3 col-md-12">
                                    <label for="new_development">New Development</label>
                                    <textarea placeholder="What new Development happened Today? " name="new_development" required type="text" class="form-control" id="new_development"></textarea>
                                </div>
                            </div>
                            <div class="row justify-content-around">
                                <div class="mb-3 col-md-12">
                                    <label for="comments">Comments/Recommendations</label>
                                    <textarea placeholder="Remarks about the Shift in General..." name="comments" type="text" required class="form-control" id="comments"></textarea>
                                </div>
                                <button class="btn btn-primary" type="submit" style="width: 55%;" onclick="return confirm('Confirm you want to Submit ?')">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // Select2
            $(".select2").each(function() {
                $(this)
                    .wrap("<div class=\"position-relative\"></div>")
                    .select2({
                        placeholder: "Select value",
                        dropdownParent: $(this).parent()
                    });
            })
            // Datetimepicker
            $('#datetimepicker-minimum').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#datetimepicker-minimum2').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
            $('#datetimepicker-view-mode').datetimepicker({
                viewMode: 'years'
            });
            $('#datetimepicker-time').datetimepicker({
                format: 'LT'
            });
            $('#datetimepicker-date').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
        });
    </script>

@endsection

