@extends('admin.layouts.app')

@section('title')
    {{ 'All district' }}
@endsection

@section('content')
    
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">District</h1>
                    <a href="{{ URL::to('/') }}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-alt-circle-right"></i> Go to website</a>
                    </div>

                    <!-- search table row -->
                    <div class="form-group m-2">
                        <input type="text" name="search" placeholder="Type here to search..." class="form-control mt-2" id="liveSearch">
                    </div> <!-- end of search table row -->

                    <!-- Content Row -->

                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="contentWrapper">
                                <div class="card">
                                    <div class="card-header text-primary">All district</div>
                
                                    <div class="card-body">
                                        <!--all district table-->
                                        <table id="liveTable" class="table table-hover table-striped table-bordered table-responsive-lg">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>District</th>
                                                    <th>Division</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i = $districts->perPage() * ($districts->currentPage()-1)
                                                @endphp
                                                @if(count($districts) < 1)
                                                <tr>
                                                    <td colspan="4"><p class="text-center text-danger"><em>No district</em></p></td>
                                                </tr>
                                                @else
                                                @foreach($districts as $district)
                                                <tr class="tr">
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $district->name }}</td>
                                                    <td>{{ $district->division->name }}</td>
                                                    <td>
                                                        <a href="{{ URL::to('/admin/districts/edit/'.$district->id) }}" class="btn btn-sm btn-info">Edit</a>
                                                        <a id="delete" href="{{ URL::to('/admin/districts/delete/'.$district->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table><!--end of all division table-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end of content row-->

                    <!--pagination-->
                    <div class="float-right mt-4">
                        {{ $districts->links() }}
                    </div>

                </div>
                <!-- Begin Page Content -->

@endsection