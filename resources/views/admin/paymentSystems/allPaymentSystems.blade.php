@extends('admin.layouts.app')

@section('title')
    {{ env('APP_NAME') . ' - Payment Systems' }}
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
                                    <h4 class="m-0 font-weight-bold text-primary"><a href="{{ URL::to('admin/payment-systems/add') }}" class="btn btn-outline-info btn-sm">Add new payment system</a></h4>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <!--all payment system table-->
                                    <table class="table table-hover table-striped table-bordered table-responsive-lg">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Short Name</th>
                                                <th>Number</th>
                                                <th>Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($payments) < 1)
                                            <tr>
                                                <td colspan="7"><p class="text-center text-danger"><em>Payment Method not available</em></p></td>
                                            </tr>
                                            @else
                                            @foreach($payments as $payment)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $payment->name }}</td>
                                                <td>
                                                    @if ($payment->image)
                                                        <img src="{{ URL::to($payment->image) }}" style="width: 150px;" alt="">
                                                    @endif
                                                </td>
                                                <td>{{ $payment->short_name }}</td>
                                                <td>{{ $payment->no }}</td>
                                                <td>{{ $payment->type }}</td>
                                                <td>
                                                    <a href="{{ URL::to('/admin/payment-systems/edit/'.$payment->id) }}" class="btn btn-sm btn-info">Edit</a>
                                                    <a id="delete" href="{{ URL::to('/admin/payment-systems/delete/'.$payment->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table><!--end of all payment system table-->
                                </div>
                            </div>
                        </div>

                       
                    </div>

                </div>
                <!-- Begin Page Content -->

@endsection