@extends('admin.layouts.app')

@section('title')
    {{ env('APP_NAME') . ' - Edit social contact' }}
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
                                    <h4 class="m-0 font-weight-bold text-primary">Edit social contact</h4>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <form method="POST" action="{{ URL::to('/admin/social-contacts/update/'.$social_contact->id) }}" enctype="multipart/form-data" class="was-validated">
                                        @csrf

                                        <div class="form-group row">
                                            <label for="social_url" class="col-md-4 col-form-label text-md-right">Social URL</label>

                                            <div class="col-md-6">
                                                <input type="url" id="social_url" value="{{ $social_contact->social_url }}" class="form-control @error('social_url') is-invalid @enderror" name="social_url" placeholder="https:://example.com/something" required="">
                                                @error('social_url')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="icon" class="col-md-4 col-form-label text-md-right">Social Icon</label>

                                            <div class="col-md-6">
                                                <input type="file" id="icon" class="form-control @error('icon') is-invalid @enderror" name="icon">
                                                @error('icon')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <img src="{{ URL::to($social_contact->icon) }}" style="width: 60px;" alt=" ">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="priority" class="col-md-4 col-form-label text-md-right">Priority</label>

                                            <div class="col-md-6">
                                                <input type="number" id="priority" value="{{ $social_contact->priority }}" class="form-control @error('priority') is-invalid @enderror" name="priority" placeholder="Example: 1, 2, 3 ..." required="">
                                                @error('priority')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-info">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                       
                    </div>

                </div>
                <!-- Begin Page Content -->

@endsection