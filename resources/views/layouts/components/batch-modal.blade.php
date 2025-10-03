@php
    $sessionBatch = Session::get('allRequestedItems', []);
@endphp

<div class="modal fade" id="batch-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="row justify-content-center">

                <strong style="padding:1rem">You can View and edit items in the batch before submitting. </strong>
                <div class="modal-body m-3">

                    <form action="{{ route('store.requests.batch.store') }}"method="post">
                        @csrf
                        <table class="table table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th style="width:20%">Action</th>
                                    <th style="width:50%">Item name</th>
                                    <th>State</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($sessionBatch as $key => $item)
                                    <tr>
                                        <td>
                                            <a href="{{ route('store.requests.batch.remove', ['id' => $item['id']]) }}"><i
                                                    class=" fas fa-ban">&nbsp;remove</i></a>
                                        </td>
                                        <td>{{ $item['item_name'] }}</td>
                                        @if ($item['state'] = 0)
                                            <td>New item</td>
                                        @elseif ($item['state'] = 1)
                                            <td>In circulation</td>
                                        @elseif ($item['state'] = 2)
                                            <td>Borrowed</td>
                                        @elseif ($item['state'] = 3)
                                            <td>Under repair</td>
                                        @elseif ($item['state'] = 4)
                                            <td>Out of order</td>
                                        @else
                                            <td>Unknown</td>
                                        @endif

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>


                        <div class="row justify-content-center">
                            <div class="mb-3 col-md-4">
                                <label for="location">Location</label>
                                <input class="form-control" name="location" required type="text">
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="assigned_department">Return Date</label>
                                <div class="input-group date" id="datetimepicker-minimum" data-target-input="nearest">
                                    <input name="return_date" type="text" class="form-control datetimepicker-input"
                                        data-target="#datetimepicker-minimum" required />
                                    <div class="input-group-text" data-target="#datetimepicker-minimum"
                                        data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            <input type="hidden" name="item_ids"
                                value="{{ implode(',', array_column($sessionBatch, 'id')) }}">
                            <div class="mb-3 col-md-4">
                                <button style="margin-top:2rem;margin-bottom:2rem" class=" btn-primary" type="submit"
                                    name="button">Submit Request</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {// Datetimepicker
            $('#datetimepicker-minimum').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
        });
    </script>
