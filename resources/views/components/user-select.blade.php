@props([
    'name',
    'label',
    'users',
    'id' => null,
    'placeholder' => 'Select value',
    'departmentIds' => null,
    'selected' => null,
    'required' => false,
    'colClass' => 'col-md-4',
])

@php
    $fieldId = $id ?? $name;
    $deptFilter = $departmentIds;
    if ($deptFilter !== null && !is_array($deptFilter)) {
        $deptFilter = [$deptFilter];
    }
    // Check if selected value exists in the filtered user list
    $selectedInList = false;
    if ($selected !== null) {
        foreach ($users as $user) {
            if (($deptFilter === null || in_array($user->department_id, $deptFilter)) && $user->name === $selected) {
                $selectedInList = true;
                break;
            }
        }
    }
@endphp

<div class="mb-3 {{ $colClass }}">
    <label for="{{ $fieldId }}">{{ $label }}</label>
    <select class="form-control select2" name="{{ $name }}" id="{{ $fieldId }}" data-placeholder=" {{ $placeholder }}" data-tags="true">
        <option value="">select</option>
        @if($selected !== null && !$selectedInList)
            <option value="{{ $selected }}" selected="selected">{{ $selected }}</option>
        @endif
        @foreach($users as $user)
            @if($deptFilter === null || in_array($user->department_id, $deptFilter))
                <option value="{{ $user->name }}" @if($selected !== null && $selected === $user->name) selected="selected" @endif>{{ $user->name }}</option>
            @endif
        @endforeach
    </select>
</div>
