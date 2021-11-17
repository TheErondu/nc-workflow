@extends('dashboard.reports.cots.app')
@section('content')
    <div class="container mt-5">
        <div class="print" style="padding:20px">
            <img src="{{ asset('cot/img/logo.png') }}" width="150px" height="150px">
            <h2 class="mb-4" style="text-align: center;margin-top:70px;">NTV Kenya</h2>
            <div class="row justify-content-center">
                <h5 class="mb-4" style="text-align: center;">Turning On Your World...</h5>
            </div>
            <hr style="width:100%;height:2px" , size="10" , color=black>
            <div class="details" style="font-weight: 750;">
                <div class="row justify-content-center">
                    <h5 class="mb-4" style="text-align: center;">Certificate of Broadcast</h5>
                </div>
                <form>
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2">AGENCY:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="agency" placeholder="">
                        </div>
                        <label for="colFormLabel" class="col-sm-2">TIN:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="address" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">ADDRESS</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="in_respect_of" placeholder="">
                        </div>
                        <label for="colFormLabel" class="col-sm-2">INVOICE NO:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="in_respect_of" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">ADVERTISER:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="in_respect_of" placeholder="">
                        </div>
                        <label for="colFormLabel" class="col-sm-2 col-form-label">DATE:</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" value="{{ date('d/m/Y') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">PRODUCT:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="product" placeholder="">
                        </div>
                        <label for="colFormLabel" class="col-sm-2">SPOT START DATE</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="in_respect_of" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">ORDER NO:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="order_no" placeholder="">
                        </div>
                        <label for="colFormLabel" class="col-sm-2">SPOT END DATE</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="in_respect_of" placeholder="">
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12">
                @if (null !== request()->query('name'))
                    @isset($results)
                        <strong> Showing search results for {{ request()->query('name') }}, from :
                            {{ request()->query('start_date') }}, to
                            {{ request()->query('end_date') }} .</strong>
                    @endisset
                    <div class="row justify-content-center">
                        <button class="btn btn-primary"><a style="color:white;" href="{{ route('cot.index') }}">Search
                                Again</a></button>
                    </div>
                @else
                    <div class="row justify-content-between">
                        <div class="col-8 card">
                            <div class="card-header">
                                @if (null !== request()->query('name'))
                                    <strong> Showing search results for {{ request()->query('name') }}, from :
                                        {{ request()->query('start_date') }}, to
                                        {{ request()->query('end_date') }} .</strong>
                                @else
                                @endif
                                <h5>Select by Date</h5>
                            </div>
                            <div class="card-body">
                                <form method="GET" action="{{ route('cot.index') }}">
                                    <div class="row justify-content-center">
                                        <div class="mb-3 col-md-4 date">
                                            <label for="date">AD Name</label>
                                            <input name="name" type="text" class="form-control" required
                                                placeholder="Enter the Ad video name ">
                                        </div>
                                        <div class="mb-3 col-md-4 date">
                                            <label for="date">Start Date</label>
                                            <input name="start_date" type="text" class="form-control datepicker"
                                                id="datepicker" required placeholder="">
                                        </div>
                                        <div class="mb-3 col-md-4 date">
                                            <label for="date">End Date</label>
                                            <input name="end_date" type="text" class="form-control datepicker"
                                                id="datepicker" required placeholder="">
                                        </div>
                                    </div>




                                    <div class="row justify-content-between">
                                        <div class="mb-3 col-md-6">
                                            <a href="{{ route('cot.index') }}"
                                                style="background-color: rgb(53, 54, 55) !important;"
                                                class="btn btn-primary">Cancel</a>
                                        </div>
                                        <div class="mb-3 col-md-2">
                                            <button style="background-color: rgb(37, 38, 38) !important;" type="submit"
                                                class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <br>
        <div class="print">
            <div>
                @if (!empty($results))

                        <table class="table table-bordered search-results">
                            <thead>
                                <tr>
                                    <th width=5%>S/N</th>
                                    <th width=15%>Name</th>
                                    <th width=15%>Time</th>
                                    <th width=15%>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results as $result)
                                    <tr>

                                        <td>{{ $result->id}}</td>
                                        <td>{{ $result->name}}</td>
                                        <td>{{ $result->time}}</td>
                                        <td>{{ $result->date}}</td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                        <div class="row d-flex remove justify-content-center"
                        style="float: right;padding-right: 180px; padding-top: 50px;">
                        <input type="button" value="Print Report" onclick="sendEmail(); window.print();" />
                    </div>
                        <div class="row justify-content-center">
                            <br>
                            <div class="col-8">
                                <p style="width: 100%;">This is to certify that the above matter/advertisement was Broadcast
                                    over the transmitter of NTV Kenya on the date shown in accordance
                                    with the terms of your contract except as noted </p>
                            </div>
                            <br>
                            <br>
                        </div>
                        <br>

                        <footer>
                            <div class="print">
                                <div class="row justify-content-center">
                                    <div class="col-6" style="margin-left: 0px">
                                        <p>Prepared By :_________________</p>
                                        <br>
                                        <br>
                                        <p>Signature:_________________</p>
                                        <br>
                                        <p>Date:_________________</p>
                                    </div>

                                </div>
                            </div>
                        </footer>
            </div>
            @elseif (null !== request()->query('name'))
                <div class="row justify-content-center">
                    <div class="card">
                        <div class="card-body">
                            <h5>Sorry, we couldn't find any records for search criteria and range selected</h5>
                        </div>
                    </div>
                </div>
        @else
           <div style="margin-bottom: 30px" class="card">
               <div class="card-header">
                   <h5>Enter AD name to Search</h5>
               </div>
               <div class="card-body">
                   <p> Type in a unique keyword or phrase from the AD video file and select the <strong> Date range </strong> to get all records macthing your search criteria</p>
               </div>
           </div>
           @endif
            {{-- <div class="row d-flex remove justify-content-center" style="float: right;padding-right: 180px; padding-top: 50px;">
               <a href="{{route('reports.download')}}">Export PDF</a>
            </div> --}}

        @endsection
        @section('javascript')
        <script src="{{asset('js/smtp.js')}}">
        </script>
            <script>
                $('.datepicker').datepicker({
                    format: "yyyy-mm-dd",
                    // startView: "months",
                    // minViewMode: "months"
                });
            </script>
            <script>
    function sendEmail() {

        Email.send({
    Host : "smtp.mailtrap.io",
    Port:"2525",
    Username : "99bc973fc3bca4",
    Password : "3e44e06e47226f",
    To : 'nbdengineers@ke.nationmedia.com',
    From : "no-reply@bravetech.media",
    Subject : "A Certificate of Broadcast was Printed",
    Body : "<html><body><h1>{{ Auth::User()->name}} has printed a Certificate of Broadcast!</h1><p> Showing Search results for {{ request()->query('name') }} from the period:</p><p>{{ request()->query('start_date') }} to {{ request()->query('end_date')}} </p></body></html>"
})
    }
</script>
        @endsection
