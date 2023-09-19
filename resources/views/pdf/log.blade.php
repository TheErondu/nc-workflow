@extends('pdf.app')
@section('content')
  <div class="container">
    <div class="print" style="padding:20px">
        <img src="{{ asset('cot/img/logo.png') }}" width="170px" height="150px">
        <h2 class="mb-4" style="text-align: center;margin-top:70px;">EQUIPMENT / MATERIALS GATE PASS</h2>
        <div class="row justify-content-center">
            <h5 class="mb-4" style="text-align: center;">{{$log->created_at}}</h5>
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
                        <input type="text" value="{{$log->id}}" class="form-control" id="agency" placeholder="">
                    </div>
                    <label for="colFormLabel" class="col-sm-2">ISSUED TO:</label>
                    <div class="col-sm-4">
                        <input type="text" value="{{$log->user->name}}" class="form-control" id="address" placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">DEPARTMENT</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="in_respect_of" placeholder="">
                    </div>
                    <label for="colFormLabel" class="col-sm-2">PURPOSE:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="in_respect_of" placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-6 col-form-label">Allowed to take following items Out/In FROM:</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="in_respect_of" placeholder="">
                    </div>
                    <label for="colFormLabel" class="col-sm-2 col-form-label">TO</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="in_respect_of" placeholder="">
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
                <tdtest1</td>

            </tr>

            <tr>
                <td>N/A</td>
                <td>N/A</td>
                <td>N/A</td>
                <td>No Items Added</td>
                <td>N/A</td>
                <td>N/A</td>
             </tr>
        </tbody>
    </table>
    <div style="margin-top:40px ">
    <table class="display print" style="width:100%">
        <thead>
            <tr>
                <th>PREPARED BY:</th>
                <th>RECIEVED BY:</th>
                <th>HEAD OF DEPARTMENT:</th>
                <th>PASS IN/OUT:</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
            <tr>
                <td>___________________</td>
                <td>___________________</td>
                <td>__________________</td>
                <td>___________________</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
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
