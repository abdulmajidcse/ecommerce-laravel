@extends('admin.layouts.app')

@section('title')
    {{ env('APP_NAME') . ' - All custom page' }}
@endsection

@section('content')
    
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Custom page</h1>
                    <a href="{{ URL::to('/') }}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-alt-circle-right"></i> Go to website</a>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- settings control -->
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h4 class="m-0 font-weight-bold text-primary">All custom page</h4>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <table class="table table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Content</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($custom_pages as $custom_page)
                                                <tr>
                                                    <td>{{ $loop->index+1 }}</td>
                                                    <td>{{ $custom_page->name }}</td>
                                                    <td>{!! substr($custom_page->content, 0, 200) . '...' !!}</td>
                                                    <td>
                                                        <a href="{{ URL::to('admin/custom-pages/view/'.$custom_page->id) }}" class="btn btn-outline-info btn-sm">View</a>
                                                        <a href="{{ URL::to('admin/custom-pages/edit/'.$custom_page->id) }}" class="btn btn-outline-success btn-sm">Edit</a>
                                                        <a href="{{ URL::to('admin/custom-pages/delete/'.$custom_page->id) }}" id="delete" class="btn btn-outline-danger btn-sm">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                       
                    </div>

                </div>
                <!-- Begin Page Content -->

@endsection