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
                            <h2 class="content-header-title float-start mb-0">Blog @if (isset($blog))
                                    Edit
                                @else
                                    Create
                                @endif
                            </h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('blogs') }}">blogs</a>
                                    </li>
                                    <li class="breadcrumb-item active">blog @if (isset($blog))
                                            Edit
                                        @else
                                            Create
                                        @endif
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    @if (isset($blog))
                                        Update
                                    @else
                                        Add New
                                    @endif blog
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('save.blog') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" class="form-control" id="blog_id" name="blog_id"
                                            value="{{ isset($blog) ? $blog->id : '' }}" />

                                        <div class="row">

                                            <div class="col-xl-4 col-md-4 col-4">
                                                <div class="mb-1">
                                                    <label class="form-label" for="title">Title <span
                                                            class="required_sign">*</span></label>
                                                    <input type="text" class="form-control" id="title" name="title"
                                                        placeholder="Enter blog Title"
                                                        value="{{ old('title', isset($blog->title) ? $blog->title : '') }}" />
                                                    @error('title')
                                                        <strong style="color: red;">{{ $message }}</strong>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-xl-4 col-md-4 col-4">
                                                <div class="mb-1">
                                                    <label class="form-label" for="publication-date">Publication Date
                                                        <input type="date" class="form-control" id="publication-date"
                                                            name="publication_date"
                                                            value="{{ old('publication_date', isset($blog->publication_date) ? $blog->publication_date : '') }}"
                                                            min="{{ date('Y-m-d', strtotime('+1 day')) }}" />
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-xl-6 col-md-6 col-6">
                                                <div class="mb-1">
                                                    <label class="form-label" for="description">Description <span
                                                            class="required_sign">*</span></label>
                                                    <textarea name="description" id="description" class="form-control" required>{{ old('question', isset($blog->description) ? $blog->description : '') }}</textarea>
                                                    @error('description')
                                                        <strong style="color: red;">{{ $message }}</strong>
                                                    @enderror
                                                </div>
                                            </div>


                                            @if (isset($blog->blog_image))
                                                <div class="col-xl-3 col-md-3 col-3">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="image">Image</label> <br>
                                                        @foreach ($blog->blog_image as $key => $image)
                                                            <div class="column">
                                                                <img src="{{ \Storage::url($image->image) }}"
                                                                    height="80px" width="80px">
                                                                <a href='#' data-bs-toggle='modal'
                                                                    data-bs-target='#deleteBlogImage'
                                                                    data-image-id="{{ $image->id }}"
                                                                    class="btn btn-icon btn-outline-danger waves-effect">
                                                                    <i class="fa fa-trash "></i>
                                                                </a>
                                                            </div>
                                                            <br>
                                                        @endforeach
                                                        <div class="mb-1">
                                                            <br />
                                                            <input type="file" class="form-control" id="image"
                                                                name="image[]" placeholder="Select image" multiple>
                                                            @error('image.*')
                                                                <strong style="color: red;">{{ $message }}</strong>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-xl-3 col-md-3 col-3">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="image">Image</label>
                                                        <input type="file" class="form-control" id="image"
                                                            name="image[]" placeholder="Select image" multiple>
                                                        @error('image.*')
                                                            <strong style="color: red;">{{ $message }}</strong>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <button class="btn btn-primary" type="submit">Submit</button>
                                    <a href="{{ route('blogs') }}" class="btn btn-secondary" type="button">Cancel</a>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="deleteBlogImage" tabindex="-1" role="dialog" aria-labelledby="deleteBlogImage"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteBlogImage">Delete Blog Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="form" id="status_model_model" action="{{ route('delete.blog.image') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Are you sure to Delete this blog image..?</p>
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
    <script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>

    <script type="text/javascript">
        CKEDITOR.replace('description');

        $(document).ready(function() {
            $('#deleteBlogImage').on('show.bs.modal', function(e) {
                if (e.namespace === 'bs.modal') {
                    var opener = e.relatedTarget;
                    var id = $(opener).attr('data-image-id');
                    $('#status_model_model').find('[name="id"]').val(id);
                }
            });
        });
    </script>
@endsection
