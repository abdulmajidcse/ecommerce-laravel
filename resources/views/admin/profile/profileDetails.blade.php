@extends('admin.layouts.app')

@section('title')
    {{ env('APP_NAME') . ' - Profile Information' }}
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
                                    <h4 class="m-0 font-weight-bold text-primary">Profile Information</h4>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <table class="table table-responsive-sm">
                                        <tr>
                                            <th>Name: </th>
                                            <td>{{ Auth::user()->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email: </th>
                                            <td>{{ Auth::user()->email }}</td>
                                        </tr>
                                        @if(Auth::user()->phone_no)
                                        <tr>
                                            <th>Phone: </th>
                                            <td>{{ Auth::user()->phone_no }}</td>
                                        </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>

                       
                    </div>

                </div>
                <!-- Begin Page Content -->

@endsection