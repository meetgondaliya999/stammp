@php
    $statusshow = $statusshow ?? false;
    $edit = $edit ?? false;
    $delete = $delete ?? false;
@endphp

@if ($statusshow)
    <a href='#' data-bs-toggle='modal' data-bs-target='#changestatusmodal' data-id='{{ $val->id }}'
        data-status='{{ $val->status == 1 ? 0 : 1 }}' class="btn btn-icon btn-outline-warning waves-effect">
        <i class="fa fa-lock"></i>
    </a>
@endif

@if ($edit)
    <a href="{{ route($routeName . '.edit', $val->id) }}" class="btn btn-icon btn-outline-primary waves-effect">
        <i class="fa fa-edit"></i>
    </a>
@endif

@if ($delete)
    <a href='#' data-bs-toggle='modal' data-bs-target='#deletemodal' data-id='{{ $val->id }}'
        class="btn btn-icon btn-outline-danger waves-effect">
        <i class="fa fa-trash"></i>
    </a>
@endif
