@extends('pdf.app')
@section('content')
  <div class="container">
    <div class="print" style="padding:20px">
        <img src="{{ asset('cot/img/multi_choice_logo.png') }}" width="170px" height="150px">
        <h2 class="mb-4" style="text-align: center;margin-top:70px;">EQUIPMENT / MATERIALS GATE PASS</h2>
        <div class="row justify-content-center">
            <h5 class="mb-4" style="text-align: center;">{{$data['time']}}</h5>
        </div>
        <hr style="width:100%;height:2px" , size="10" , color=black>
        <div class="details" style="font-weight: 750;">
            <div class="row justify-content-center">
                <h5 class="mb-4" style="text-align: center;">Note: This gate pass is to be used only for internal purposes</h5>
            </div>
            <form>
                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2">GATEPASS NO:</label>
                    <div class="col-sm-4">
                        <p>{{$data['gatepass_id']}}</p>
                    </div>
                    <label for="colFormLabel" class="col-sm-2">ISSUED TO:</label>
                    <div class="col-sm-4">
                      <p>{{$data['issued_to']}}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">DEPARTMENT:</label>
                    <div class="col-sm-4">
                       <p>{{$data['department']}}</p>
                    </div>
                    <label for="colFormLabel" class="col-sm-2">Location:</label>
                    <div class="col-sm-4">
                        <p>{{$data['location']}}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-6 col-form-label">Allowed to take following items Out/In FROM:</label>
                    <div class="col-sm-2">
                       <p>{{$data['from']}}</p>
                    </div>
                    <label for="colFormLabel" class="col-sm-2 col-form-label">TO</label>
                    <div class="col-sm-2">
                        <p>{{$data['to']}}<p>
                    </div>
                </div>
            </form>

        </div>
    </div>

      <table id="example" class="cell-border table-bordered print" style="width:100%">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Item name</th>
                <th>Description</th>
                <th>Unit</th>
                <th>qty.</th>
                <th>remarks</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>{{ $data['item'] }}</td>
                <td width="30%">{{ $data['description'] }}</td>
                <td>{{ $data['unit'] }}</td>
                <td>{{ $data['qty'] }}</td>
                <td width="30%" contenteditable=true></td>
            </tr>
        </tbody>
    </table>
    <div style="margin-top:40px ">
    <table class="display print" style="width:100%">
        <thead>
            <tr>
                <th>PREPARED BY:</th>
                <th>RECIEVED BY:</th>
                <th>PASS IN/OUT:</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
            <tr>
                <td>___________________</td>
                <td>__________________</td>
                <td>___________________</td>
            </tr>
            <tr>
                <td><strong>{{ $data['user'] }}</strong></td>
                <td><strong>{{ $data['issued_to'] }}</strong></td>
                <td><strong>SECURITY</strong></td>
            </tr>
        </tbody>
    </table>
    </div>
    <div class="row justify-content-center">
        <button style="background-color: black; width:10%" class="btn btn-primary" onclick="print()">Print</button>
    </div>
    </div>
</div>
@section('javascript')
@endsection
@endsection
