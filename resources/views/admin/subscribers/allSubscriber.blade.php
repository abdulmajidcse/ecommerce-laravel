@extends('admin.layouts.app')

@section('title')
    {{ env('APP_NAME') . ' - All Subscriber' }}
@endsection

@section('content')
    
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Subscriber</h1>
                    <a href="{{ URL::to('/') }}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-alt-circle-right"></i> Go to website</a>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- settings control -->
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h4 class="m-0 font-weight-bold text-primary">All Subscriber</h4>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <!--all payment system table-->
                                    <table class="table table-hover table-striped table-bordered table-responsive-lg">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Email</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($subscribers) < 1)
                                            <tr>
                                                <td colspan="3"><p class="text-center text-danger"><em>Subscriber not available</em></p></td>
                                            </tr>
                                            @else
                                            @foreach($subscribers as $subscriber)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $subscriber->email }}</td>
                                                <td>
                                                    <a id="delete" href="{{ URL::to('/admin/subscribers/delete/'.$subscriber->id) }}" class="btn btn-sm btn-danger">Delete</a>
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