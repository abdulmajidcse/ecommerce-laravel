@extends('admin.layouts.app')

@section('title')
    {{ 'All Brand' }}
@endsection

@section('content')
    
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Brand</h1>
                    <a href="{{ URL::to('/') }}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-alt-circle-right"></i> Go to website</a>
                    </div>

                    <!-- Content Row -->

                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="contentWrapper">
                                <div class="card">
                                    <div class="card-header text-primary">All brand</div>
                
                                    <div class="form-group m-2">
                                        <input type="text" name="search" placeholder="Type here to search..." class="form-control mt-2" id="liveSearch">
                                    </div>

                                    <div class="card-body">
                                        <!--all brand table-->
                                        <table id="liveTable" class="table table-hover table-striped table-bordered table-responsive-lg">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Image</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i = 0; @endphp
                                                @if(count($brand) < 1)
                                                <tr>
                                                    <td colspan="5"><p class="text-center text-danger"><em>No brand</em></p></td>
                                                </tr>
                                                @else
                                                @foreach($brand as $row)
                                                <tr class="tr">
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $row->name }}</td>
                                                    <td>{{ $row->description }}</td>
                                                    <td><img src="{{ URL::to($row->image) }}" style="height: 50px;"></td>
                                                    <td>
                                                        <a href="{{ URL::to('/admin/brands/edit/'.$row->id) }}" class="btn btn-sm btn-info">Edit</a>
                                                        <a id="delete" href="{{ URL::to('/admin/brands/delete/'.$row->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table><!--end of all brand table-->
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div><!--end of content row-->

                </div>
                <!-- Begin Page Content -->

@endsection