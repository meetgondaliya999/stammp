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
                            <h2 class="content-header-title float-start mb-0">Blog Details</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">All Blog</a>
                                    </li>
                                    <li class="breadcrumb-item active">Blog Details
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
                                <h4 class="card-title">{{ !empty($blog->title) ? ucfirst($blog->title) : '' }}</h4>
                                <h5 class="card-title">Publication Date :-
                                    {{ !empty($blog->publication_date) ? \Carbon\Carbon::parse($blog->publication_date)->format('d-m-Y') : date('d-m-Y') }}
                                </h5>
                            </div>
                        </div>

                        <div class="row">
                            @if (!empty($blog->blog_image))
                                @foreach ($blog->blog_image as $blogImage)
                                    <div class="col-xl-3 col-md-3 col-sm-3">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <img src="{{ \Storage::url($blogImage->image) }}"
                                                    style="height: 160px;width: 235px;">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-xl-3 col-md-3 col-sm-3">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <img src="{{ asset('app-assets/images/no-image.jpeg') }}"
                                                style="height: 160px;width: 235px;">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{!! !empty($blog->description) ? $blog->description : '' !!}</h4>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
