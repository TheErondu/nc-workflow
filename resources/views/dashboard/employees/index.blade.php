@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card table-card">
                    <div class="card-header" style="margin-bottom: 1.0rem;">
                        <span>Employee </span>
                        <a href="{{ route('employees.create') }}" style="background-color: rgb(0, 0, 0) !important;"
                            type="submit" class="btn btn-primary create-button">Add New Employee <i
                                class="fas fa-plus"></i></a>
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
                    @if (count($employees) > 0)

                    <div style="overflow-y: auto; height:400px; ">
                        <table class="table table-bordered datatable dtr-inline" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Department</th>
                                    <th>Created At</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td><a href="{{ route('employees.edit', $employee->id) }}"><i
                                                    class="far fa-edit"></i></a></td>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->department->name }}</td>
                                        <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $employee->created_at)->format('d-M-Y') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                        <div class="modal fade" id="smallModal" role="dialog" aria-labelledby="smallModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" id="smallBody">
                                        <div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @else
                        <div class="card">
                            <div class="card-body card-black">
                                <p>No Vehicles Have Been Added yet, Click <a href="{{ route('employees.create') }}"
                                        data-toggle="tooltip" title="" data-original-title="Add Vehicles">Here</a> to add
                                    employees
                                <p>
                                <p><a class="btn btn-primary" href="{{ route('employees.create') }}">Add Employee</a>
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection
@section('javascript')
    <script>
        // display a modal (small modal)
        $(document).on('click', '#smallButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#smallModal').modal("show");
                    $('#smallBody').html(result).show();
                },
                complete: function() {
                    $('#modal-body').trigger('click');
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').remove();
                },
                timeout: 8000
            })
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            /* = NOTE : don't add "id" in <table> if not necessary, is added than replace each "id" here = */
            $('.table').DataTable({
                responsive: false,
                "sAutoWidth": true,
                "bDestroy": true,
                "sPaginationType": "bootstrap", // full_numbers
                "iDisplayStart ": 10,
                "iDisplayLength": 10,
                "bPaginate": false, //hide pagination
                "bFilter": true, //hide Search bar
                "bInfo": tru,
            });
            /* =========================================================================================== */
            /* ============================ BOOTSTRAP 3/4 EVENT ========================================== */
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();
            });
        });
    </script>


@endsection
