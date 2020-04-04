@extends('admin.layouts.app')

@section('title')
    {{ env('APP_NAME') . ' - View custom page' }}
@endsection

@section('content')
    
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Custom page</h1>
                    <a href="{{ URL::to('/') }}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-alt-circle-right"></i> Go to website</a>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- settings control -->
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h4 class="m-0 font-weight-bold text-primary">View custom page</h4>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <h4 class="alert alert-success">{{ $custom_page->name }}</h4>
                                    <p class="text-info">Page Slug: {{ $custom_page->slug }}</p>
                                    <p>Page Type: {{ $custom_page->type == 1 ? 'Quick Link' : 'Help' }}</p>
                                    <img src="{{ URL::to($custom_page->image) }}" style="width: 200px;" class="img-fluid" alt="Page Image">
                                    <p class="h5 text-justify mt-2">{!! $custom_page->content !!}</p>
                                </div>
                            </div>
                        </div>

                       
                    </div>

                </div>
                <!-- Begin Page Content -->

@endsection