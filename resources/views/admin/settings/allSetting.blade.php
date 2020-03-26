@extends('admin.layouts.app')

@section('title')
    {{ env('APP_NAME') . ' - Settings' }}
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
                                    <h4 class="m-0 font-weight-bold text-primary">Settings Control</h4>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    @if (empty($settings))
                                    <a href="{{ URL::to('/admin/settings/add') }}" class="btn btn-info">Add New Settings</a>
                                    @else
                                    <table class="table table-responsive-sm">
                                        <tr>
                                            <th>Company Name: </th>
                                            <td>{{ $settings->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Company Logo: </th>
                                            <td><img src="{{ URL::to($settings->logo) }}" style="width: 100px;" alt=""></td>
                                        </tr>
                                        <tr>
                                            <th>Company Email Address: </th>
                                            <td>{{ $settings->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Company Phone Number: </th>
                                            <td>{{ $settings->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th>Company Address: </th>
                                            <td>{{ $settings->address }}</td>
                                        </tr>
                                        <tr>
                                            <th>Shipping Cost: </th>
                                            <td>{{ $settings->shipping_cost }} Tk</td>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <td><a href="{{ URL::to('/admin/settings/edit/'.$settings->id) }}" class="btn btn-info btn-sm">Edit</a></td>
                                        </tr>
                                    </table>
                                    @endif
                                </div>
                            </div>
                        </div>

                       
                    </div>

                </div>
                <!-- Begin Page Content -->

@endsection