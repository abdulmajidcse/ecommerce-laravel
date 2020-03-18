@extends('admin.layouts.app')

@section('title')
    {{ 'Edit Brand' }}
@endsection

@section('content')
    
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Brand</h1>
                    <a href="{{ URL::to('/') }}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-alt-circle-right"></i> Go to website</a>
                    </div>

                    <!-- Content Row -->

                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="contentWrapper">
                                <div class="card">
                                    <div class="card-header text-primary">Edit brand</div>
                
                                    <div class="card-body">
                                        <form method="POST" action="{{ url('/admin/brands/update/'.$brand->id) }}" enctype="multipart/form-data" class="was-validated">
                                            @csrf

                                            <div class="form-group row">
                                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                                <div class="col-md-6">
                                                    <input type="text" value="{{ $brand->name }}" id="name" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Brand name" required="">
                                                    @error('name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                                                <div class="col-md-6">
                                                    <input type="text" value="{{ $brand->description }}" id="description" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Brnad description">
                                                    @error('description')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="image" class="col-md-4 col-form-label text-md-right">Image</label>

                                                <div class="col-md-6">
                                                    <input type="file" id="image" class="form-control @error('image') is-invalid @enderror" name="image">
                                                    @error('image')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror

                                                    @if(!is_null($brand->image))
                                                        <img src="{{ URL::to($brand->image) }}" style="height: 50px;" class="mt-1">
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-4">
                                                    <button type="submit" class="btn btn-info">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end of content row-->

                </div>
                <!-- Begin Page Content -->

@endsection