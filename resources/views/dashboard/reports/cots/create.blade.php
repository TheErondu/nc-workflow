@extends('dashboard.reports.cots.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card-opaque">
                    <div class="card-header" style="background-color: #272727;">
                        <h5 class="card-title" style="color: white;">Enter  Date</h5>

                    </div>

                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('reports.dump') }}">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="mb-3 col-md-4 date">
                                    <label for="date">Date</label>
                                    <input name="date" type="text" class="form-control datepicker" id="datepicker" required placeholder="">
                                </div>
                            </div>




                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-6">
                                    <a href="{{ route('reports') }}" style="background-color: rgb(53, 54, 55) !important;"
                                        class="btn btn-primary">Cancel</a>
                                </div>
                                <div class="mb-3 col-md-1">
                                    <button style="background-color: rgb(37, 38, 38) !important;" type="submit"
                                        class="btn btn-primary">Dump</button>
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
<script>
    $('.datepicker').datepicker({
    format: 'dd-mm-yyyy'
 });
    </script>
@endsection
