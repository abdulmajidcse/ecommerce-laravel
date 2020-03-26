@extends('admin.layouts.app')

@section('title')
    {{ env('APP_NAME') . ' - Edit Profile' }}
@endsection

@section('content')
    
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    <a href="{{ URL::to('/') }}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-alt-circle-right"></i> Go to website</a>
                    </div>


                    <!-- Content Row -->

                    <div class="row">

                        <!-- profile edit option -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">{{ Auth::user()->name }}</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    @if (empty(Auth::user()->image))
                                        <i class="fas fa-user-shield" style="font-size:100px;"></i>
                                    @else
                                        <img src="{{ URL::to(Auth::user()->image) }}" class="rounded-circle" style="width: 200px;" alt="Admin Image">
                                    @endif
                                    
                                </div>
                                <div class="card-footer">
                                    <a href="{{ route('admin.editProfile', Auth::user()->id) }}" class="p-2">Edit Profile</a> <br/>
                                    <a href="{{ route('admin.changePassword') }}" class="p-2">Change Password</a>
                                </div>
                            </div>
                        </div>

                        <!-- profile details option -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h4 class="m-0 font-weight-bold text-primary">Edit Profile</h4>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <form method="POST" action="{{ route('admin.updateProfile', $admin->id) }}" enctype="multipart/form-data" class="was-validated">
                                        @csrf

                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                            <div class="col-md-6">
                                                <input type="text" value="{{ $admin->name }}" id="name" class="form-control @error('name') is-invalid @enderror" name="name" required="">
                                                @error('name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                                            <div class="col-md-6">
                                                <input type="text" value="{{ $admin->email }}" id="email" class="form-control @error('email') is-invalid @enderror" name="email" required="">
                                                @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>

                                            <div class="col-md-6">
                                                <input type="text" value="{{ $admin->phone_no }}" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="01XXXXXXXXX">
                                                @error('phone')
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
                                                
                                                @if (!empty($admin->image))
                                                    <img src="{{ URL::to($admin->image) }}" style="width: 100px;" class="mt-2">
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

                </div>
                <!-- Begin Page Content -->

@endsection