
    <div class="mb-3 col-md-4">
        <label for="state">State</label>
        <select class="form-control select2" name="state" id="state">
            <option value=""></option>
            @if ($type ?? '' == 'edit')
                @foreach ($states as $key => $state)
                    @if ($key == 'is_new_item')
                        <option value={{ $state }}@if ($store_item->state === $state) selected='selected' @endif>
                            New item</option>
                    @elseif ($key == 'is_in_circulation')
                        <option value={{ $state }}@if ($store_item->state === $state) selected='selected' @endif>
                            In Circulation</option>
                    @elseif ($key == 'is_borrowed')
                        <option value={{ $state }}@if ($store_item->state === $state) selected='selected' @endif>
                            Borrowed</option>
                    @elseif ($key == 'is_under_repair')
                        <option value={{ $state }}@if ($store_item->state === $state) selected='selected' @endif>
                            Under repair</option>
                    @elseif ($key == 'is_out_of_order')
                        <option value={{ $state }}@if ($store_item->state === $state) selected='selected' @endif>
                            Out of order</option>
                    @elseif ($key == 'is_newly_verified')
                        <option value={{ $state }}@if ($store_item->state === $state) selected='selected' @endif>
                            Newly verified</option>
                    @endif
                @endforeach
            @else
                @foreach ($states as $key => $state)
                    @if ($key == 'is_new_item')
                        <option value={{ $state }}>New item</option>
                    @elseif ($key == 'is_in_circulation')
                        <option value={{ $state }}>In circulation</option>
                    @elseif ($key == 'is_borrowed')
                        <option value={{ $state }}>Borrowed</option>
                    @elseif ($key == 'is_under_repair')
                        <option value={{ $state }}>Under repairs</option>
                    @elseif ($key == 'is_out_of_order')
                        <option value={{ $state }}>Out of order</option>
                    @elseif ($key == 'is_newly_verified')
                        <option value={{ $state }}>Newly verified</option>
                    @elseif ($key == 'unknown')
                        <option value={{ $state }}>All items</option>
                    @endif
                @endforeach
            @endif
        </select>
    </div>
</div>
