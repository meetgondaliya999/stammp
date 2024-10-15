@extends('layouts.app')
@section('css')
@endsection
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Blogs</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">All Blogs</a>
                                    </li>
                                    <li class="breadcrumb-item active">blogs
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                        <a href="{{ route('blog.create') }}" class=" create-new btn btn-primary" type="button"><span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>Add New Blog</span></a>
                    </div>
                </div>
            </div>
            <div class="content-body">
                @include('layouts.message')
                <div class="row">
                    <div class="col-12">
                        <div class="card datatable_card">
                            <section id="client">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            {{-- Filter Start --}}
                                            {{-- Filter End --}}
                                            <table id="blog_datatable" class="table">
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- change status Modal-->
    <div class="modal fade" id="changestatusmodal" tabindex="-1" role="dialog" aria-labelledby="changestatusmodal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changestatusmodal">Change status client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="form" id="status_model_model" action="{{ route('blog.change.status') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Are you sure to change this blog status..?</p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id">
                        <input type="hidden" name="status">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal-->
    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="deletemodal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletemodal">Delete client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="form" id="delete_model" action="{{ route('blog.delete') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Are you delete this client..?</p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- Datatable init js -->
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $("#blog_datatable");
            // datatable
            oTable = table.DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('blog.listing') }}",
                    data: function(data) {}
                },
                columns: [{
                        data: 'no'
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'description'
                    },
                    {
                        data: 'publication_date'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'action',
                        responsivePriority: -1
                    },
                ],
                columnDefs: [
                    // columns titles here
                    {
                        targets: 0,
                        title: "#",
                        orderable: false
                    },
                    {
                        targets: 1,
                        title: 'Title',
                        orderable: true
                    },
                    {
                        targets: 2,
                        title: 'Description',
                        orderable: true
                    },
                    {
                        targets: 3,
                        title: 'Publication Date',
                        orderable: true
                    },
                    {
                        targets: 4,
                        title: 'Status',
                        orderable: true
                    },
                    {
                        targets: -1,
                        title: 'Action',
                        orderable: false
                    },
                ],
                "order": [
                    [1, 'asc']
                ],
                lengthMenu: [
                    [10, 20, 50, 100],
                    [10, 20, 50, 100]
                ],
                pageLength: 10,
            });
        });
    </script>

    <script type="text/javascript">
        //  change status js
        $(document).ready(function() {
            $('#changestatusmodal').on('show.bs.modal', function(e) {
                if (e.namespace === 'bs.modal') {
                    var opener = e.relatedTarget;
                    var id = $(opener).attr('data-id');
                    var status = $(opener).attr('data-status');
                    $('#status_model_model').find('[name="id"]').val(id);
                    $('#status_model_model').find('[name="status"]').val(status);
                }
            });
        });

        //  delete js
        $(document).ready(function() {
            $('#deletemodal').on('show.bs.modal', function(e) {
                if (e.namespace === 'bs.modal') {
                    var opener = e.relatedTarget;
                    var id = $(opener).attr('data-id');
                    $('#delete_model').find('[name="id"]').val(id);
                }
            });
        });
    </script>
@endsection
