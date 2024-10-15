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
                            <h2 class="float-start mb-0">Blogs</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Dashboard Ecommerce Starts -->
                @include('layouts.message')
                <section id="dashboard-ecommerce">
                    <div class="row match-height">

                        @if ($blogs->isEmpty())
                            <div class="col-12 text-center">
                                <p>No blogs found.</p>
                            </div>
                        @else
                            @foreach ($blogs as $key => $blog)
                                <div class="col-xl-3 col-md-3 col-sm-3">
                                    <div class="card text-center">
                                        <a href="{{ route('bolg.details', $blog->slug) }}">
                                            <div class="card-body">
                                                <img src="{{ !empty($blog->blog_image->first()) ? \Storage::url($blog->blog_image->first()->image) : asset('app-assets/images/no-image.jpeg') }}"
                                                    style="height: 160px;width: 235px;">
                                                <h2 class="fw-bolder mt-1">{{ ucfirst($blog->title) }}</h2>
                                                <b class="card-text">{!! Str::limit($blog->description, 100, '...') !!}</b>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endif


                    </div>
                </section>
                <!-- Dashboard Ecommerce ends -->
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
