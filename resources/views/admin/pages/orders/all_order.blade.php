@extends('admin.layouts.app')

@section('title')
    {{ 'All Order' }}
@endsection

@section('content')
    
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Order</h1>
                    <a href="{{ URL::to('/') }}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-alt-circle-right"></i> Go to website</a>
                    </div>

                    <!-- Content Row -->

                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="contentWrapper">
                                <div class="card">
                                    <div class="card-header text-primary">All Order</div>
                
                                    <div class="form-group m-2">
                                        <input type="text" name="search" placeholder="Type here to search..." class="form-control mt-2" id="liveSearch">
                                    </div>

                                    <div class="card-body">
                                        <!--all product table-->
                                        <table id="liveTable" class="table table-hover table-striped table-bordered table-responsive-lg">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Order ID</th>
                                                    <th>Orderer Name</th>
                                                    <th>Phone Number</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i = $orders->perPage() * ($orders->currentPage()-1)
                                                @endphp
                                                @if(count($orders) < 1)
                                                <tr>
                                                    <td colspan="6"><p class="text-center text-danger"><em>No order</em></p></td>
                                                </tr>
                                                @else
                                                @foreach($orders as $row)
                                                <tr class="tr">
                                                    <td>{{ ++$i }}</td>
                                                    <td>#LE{{ $row->id }}</td>
                                                    <td>{{ $row->name }}</td>
                                                    <td>{{ $row->phone }}</td>
                                                    <td>
                                                        @if($row->is_seen_by_admin)
                                                        <button type="button" class="btn btn-success btn-sm">Seen</button>
                                                        @else
                                                        <button type="button" class="btn btn-danger btn-sm">Unseen</button>
                                                        @endif

                                                        @if($row->is_paid)
                                                        <button type="button" class="btn btn-success btn-sm">Paid</button>
                                                        @else
                                                        <button type="button" class="btn btn-danger btn-sm">Unpaid</button>
                                                        @endif

                                                        @if($row->is_completed)
                                                        <button type="button" class="btn btn-success btn-sm">Complete</button>
                                                        @else
                                                        <button type="button" class="btn btn-danger btn-sm">Not complete</button>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ URL::to('/admin/orders/view/'.$row->id) }}" class="btn btn-sm btn-info">View</a>
                                                        <a id="delete" href="{{ URL::to('/admin/orders/delete/'.$row->id) }}" class="btn btn-sm btn-danger">Delete</a>
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
                        {{ $orders->links() }}
                    </div>

                </div>
                <!-- Begin Page Content -->

@endsection