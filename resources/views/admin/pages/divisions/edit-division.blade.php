@extends('admin.layouts.app')

@section('title')
    {{ 'Edit division' }}
@endsection

@section('content')
    
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Division</h1>
                    <a href="{{ URL::to('/') }}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-alt-circle-right"></i> Go to website</a>
                    </div>

                    <!-- Content Row -->

                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="contentWrapper">
                                <div class="card">
                                    <div class="card-header text-primary">Edit division</div>
                
                                    <div class="card-body">
                                        <form method="POST" action="{{ url('/admin/divisions/update/'.$division->id) }}">
                                            @csrf

                                            <div class="form-group row">
                                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                
                                                <div class="col-md-6">
                                                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $division->name }}" placeholder="Divsion name" required="">
                                                    @error('name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            <div class="form-group row">
                                                <label for="priority" class="col-md-4 col-form-label text-md-right">Priority</label>
                
                                                <div class="col-md-6">
                                                    <input type="number" id="priority" class="form-control @error('priority') is-invalid @enderror" name="priority" value="{{ $division->priority }}" placeholder="1, 2, 3 ..." required="">
                                                    @error('priority')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                
                
                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-4">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end of content row-->

                </div>
                <!-- Begin Page Content -->

@endsection