@extends('admin.layouts.app')

@section('title')
    {{ env('APP_NAME') . ' - Edit Settings' }}
@endsection

@section('content')
    
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Settings</h1>
                    <a href="{{ URL::to('/') }}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-alt-circle-right"></i> Go to website</a>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- settings control -->
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h4 class="m-0 font-weight-bold text-primary">Edit Settings</h4>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <form method="POST" action="{{ URL::to('/admin/settings/update/'.$settings->id) }}" enctype="multipart/form-data" class="was-validated">
                                        @csrf

                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">Company Name</label>

                                            <div class="col-md-6">
                                                <input type="text" id="name" value="{{ $settings->name }}" class="form-control @error('name') is-invalid @enderror" name="name" required="">
                                                @error('name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="logo" class="col-md-4 col-form-label text-md-right">Company Logo</label>

                                            <div class="col-md-6">
                                                <input type="file" id="logo" class="form-control @error('logo') is-invalid @enderror" name="logo">
                                                @error('logo')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <img src="{{ URL::to($settings->logo) }}" style="width: 100px;" class="mt-2 ml-2" alt="">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">Company Email Address</label>

                                            <div class="col-md-6">
                                                <input type="email" value="{{ $settings->email }}" id="email" class="form-control @error('email') is-invalid @enderror" name="email" required="">
                                                @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="phone" class="col-md-4 col-form-label text-md-right">Company Phone Number</label>

                                            <div class="col-md-6">
                                                <input type="text" value="{{ $settings->phone }}" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" required="">
                                                @error('phone')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="address" class="col-md-4 col-form-label text-md-right">Company Address</label>

                                            <div class="col-md-6">
                                                <textarea name="address" id="address" cols="30" rows="4" class="form-control @error('address') is-invalid @enderror" name="address" required="">{{ $settings->address }}</textarea>
                                                @error('address')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="shipping_cost" class="col-md-4 col-form-label text-md-right">Shipping Cost</label>

                                            <div class="col-md-6">
                                                <input type="number" value="{{ $settings->shipping_cost }}" id="shipping_cost" class="form-control @error('shipping_cost') is-invalid @enderror" name="shipping_cost" required="">
                                                @error('shipping_cost')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
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

                </div>
                <!-- Begin Page Content -->

@endsection