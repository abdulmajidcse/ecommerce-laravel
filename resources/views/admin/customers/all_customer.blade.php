@extends('admin.layouts.app')

@section('title')
    {{ 'All Customer' }}
@endsection

@section('content')
    
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Customer</h1>
                    <a href="{{ URL::to('/') }}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-alt-circle-right"></i> Go to website</a>
                    </div>

                    <!-- Content Row -->

                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="contentWrapper">
                                <div class="card">
                                    <div class="card-header text-primary">All Customer</div>
                
                                    <div class="form-group m-2">
                                        <input type="text" name="search" placeholder="Type here to search..." class="form-control mt-2" id="liveSearch">
                                    </div>

                                    <div class="card-body">
                                        <!--all product table-->
                                        <table id="liveTable" class="table table-hover table-striped table-bordered table-responsive-lg">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Division</th>
                                                    <th>District</th>
                                                    <th>Street Address</th>
                                                    <th>Registration IP</th>
                                                    <th>Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i = $customers->perPage() * ($customers->currentPage()-1)
                                                @endphp
                                                @if(count($customers) < 1)
                                                <tr>
                                                    <td colspan="9"><p class="text-center text-danger"><em>No customer</em></p></td>
                                                </tr>
                                                @else
                                                @foreach($customers as $customer)
                                                <tr class="tr">
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $customer->first_name . ' ' . $customer->last_name }}</td>
                                                    <td>{{ $customer->email }}</td>
                                                    <td>{{ $customer->phone }}</td>
                                                    <td>{{ $customer->division->name }}</td>
                                                    <td>{{ $customer->district->name }}</td>
                                                    <td>{{ $customer->street_address }}</td>
                                                    <td>{{ $customer->ip_address }}</td>
                                                    <td>
                                                        @if ($customer->status == 0 OR $customer->status == 2)
                                                            <a href="{{ URL::to('admin/customers/change-status/'.$customer->id.'/active') }}" class="btn btn-sm btn-info">Active</a>
                                                        @else
                                                            <a href="{{ URL::to('admin/customers/change-status/'.$customer->id.'/block') }}" class="btn btn-sm btn-warning">Block</a>
                                                        @endif
                                                        <a id="delete" href="{{ URL::to('admin/customers/delete/'.$customer->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table><!--end of all product table-->
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div><!--end of content row-->

                    <!--pagination-->
                    <div class="float-right mt-4">
                        {{ $customers->links() }}
                    </div>

                </div>
                <!-- Begin Page Content -->

@endsection