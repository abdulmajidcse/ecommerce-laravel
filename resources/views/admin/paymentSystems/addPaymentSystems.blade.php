@extends('admin.layouts.app')

@section('title')
    {{ env('APP_NAME') . ' - Add Payment Systems' }}
@endsection

@section('content')
    
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Payment Systems</h1>
                    <a href="{{ URL::to('/') }}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-alt-circle-right"></i> Go to website</a>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- settings control -->
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h4 class="m-0 font-weight-bold text-primary">Add Payment Systems</h4>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <form method="POST" action="{{ URL::to('/admin/payment-systems/store/') }}" enctype="multipart/form-data" class="was-validated">
                                        @csrf

                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">Payment System Name</label>

                                            <div class="col-md-6">
                                                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" required="">
                                                @error('name')
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
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="short_name" class="col-md-4 col-form-label text-md-right">Short Name</label>

                                            <div class="col-md-6">
                                                <input type="text" id="short_name" class="form-control @error('short_name') is-invalid @enderror" name="short_name" required="">
                                                @error('short_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="number" class="col-md-4 col-form-label text-md-right">Phone Number</label>

                                            <div class="col-md-6">
                                                <input type="number" id="number" class="form-control @error('number') is-invalid @enderror" name="number">
                                                @error('number')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="type" class="col-md-4 col-form-label text-md-right">Type</label>

                                            <div class="col-md-6">
                                                <input type="text" id="type" class="form-control @error('type') is-invalid @enderror" name="type">
                                                @error('type')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="priority" class="col-md-4 col-form-label text-md-right">Priority</label>

                                            <div class="col-md-6">
                                                <input type="number" id="priority" class="form-control @error('priority') is-invalid @enderror" name="priority" required="">
                                                @error('priority')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-info">Add</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                       
                    </div>

                </div>
                <!-- Begin Page Content -->

@endsection