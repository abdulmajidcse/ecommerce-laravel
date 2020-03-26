@extends('admin.layouts.app')

@section('title')
    {{ env('APP_NAME') . ' - Change Password' }}
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
                                    <h4 class="m-0 font-weight-bold text-primary">Change Password</h4>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <form method="POST" action="{{ route('admin.updatePassword') }}" class="was-validated">
                                        @csrf

                                        <div class="form-group row">
                                            <label for="old_password" class="col-md-4 col-form-label text-md-right">{{ __('Old password') }}</label>
                                            <div class="col-md-6">
                                                <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" required>
                                                @error('old_password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="new_password" class="col-md-4 col-form-label text-md-right">{{ __('New password') }}</label>
                                            <div class="col-md-6">
                                                <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required>
                                                @error('new_password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="confirm_password" class="col-md-4 col-form-label text-md-right">{{ __('Confirm password') }}</label>
                                            <div class="col-md-6">
                                                <input id="confirm_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="confirm_password" required>
                                                @error('confirm_password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">Change</button>
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