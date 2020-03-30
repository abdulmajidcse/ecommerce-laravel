@extends('admin.layouts.app')

@section('title')
    {{ env('APP_NAME') . ' - Social contact' }}
@endsection

@section('content')
    
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Social contact</h1>
                    <a href="{{ URL::to('/') }}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-alt-circle-right"></i> Go to website</a>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- settings control -->
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h4 class="m-0 font-weight-bold text-primary">All social contact <a href="{{ URL::to('admin/social-contacts/add') }}" class="btn btn-outline-info btn-sm">Add New</a></h4>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <table class="table table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>URL</th>
                                                <th>Icon</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($social_contacts as $social_contact)
                                                <tr>
                                                    <td>{{ $loop->index+1 }}</td>
                                                    <td>{{ $social_contact->social_url }}</td>
                                                    <td><img src="{{ URL::to($social_contact->icon) }}" style="width: 60px;" alt="Icon"></td>
                                                    <td>
                                                        <a href="{{ URL::to('admin/social-contacts/edit/'.$social_contact->id) }}" class="btn btn-outline-success btn-sm">Edit</a>
                                                        <a href="{{ URL::to('admin/social-contacts/delete/'.$social_contact->id) }}" id="delete" class="btn btn-outline-danger btn-sm">Delete</a>
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