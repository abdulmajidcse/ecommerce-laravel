@extends('admin.layouts.app')

@section('title')
    {{ 'All category' }}
@endsection

@section('content')
    
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Category</h1>
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
                                    <div class="card-header text-primary">All category</div>
                
                                    <div class="card-body">
                                        <!--all category table-->
                                        <table id="liveTable" class="table table-hover table-striped table-bordered table-responsive-lg">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Image</th>
                                                    <th>Parent category</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i = $category->perPage() * ($category->currentPage()-1)
                                                @endphp
                                                
                                                @if(count($category) < 1)
                                                <tr>
                                                    <td colspan="6"><p class="text-center text-danger"><em>No category</em></p></td>
                                                </tr>
                                                @else
                                                @foreach($category as $row)
                                                <tr class="tr">
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $row->name }}</td>
                                                    <td>{{ $row->description }}</td>
                                                    <td>
                                                        @if(!is_null($row->image))
                                                            <img src="{{ URL::to($row->image) }}" style="height: 50px;">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if(!is_null($row->parent_id))
                                                            {{ $row->parent->name }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ URL::to('/admin/categories/edit/'.$row->id) }}" class="btn btn-sm btn-info">Edit</a>
                                                        <a id="delete" href="{{ URL::to('/admin/categories/delete/'.$row->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table><!--end of all category table-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end of content row-->

                    <!--pagination-->
                    <div class="float-right mt-4">
                        {{ $category->links() }}
                    </div>

                </div>
                <!-- Begin Page Content -->

@endsection