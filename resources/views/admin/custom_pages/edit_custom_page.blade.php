@extends('admin.layouts.app')

@section('title')
    {{ env('APP_NAME') . ' - Edit custom page' }}
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
                                    <h4 class="m-0 font-weight-bold text-primary">Edit custom page</h4>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <form method="POST" action="{{ URL::to('/admin/custom-pages/update/'.$custom_page->id) }}" enctype="multipart/form-data" class="was-validated">
                                        @csrf

                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">Page Name</label>

                                            <div class="col-md-6">
                                                <input type="text" id="name" value="{{ $custom_page->name }}" class="form-control @error('name') is-invalid @enderror" name="name" required="">
                                                @error('name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="slug" class="col-md-4 col-form-label text-md-right">Page Slug</label>

                                            <div class="col-md-6">
                                                <input type="text" id="slug" value="{{ $custom_page->slug }}" class="form-control @error('slug') is-invalid @enderror" name="slug" placeholder="example-page" required="">
                                                @error('slug')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="type" class="col-md-4 col-form-label text-md-right">Page Type</label>

                                            <div class="col-md-6">
                                                <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required="">
                                                    <option {{ $custom_page->type == 1 ? 'selected' : '' }} value="1">Quick Link</option>
                                                    <option {{ $custom_page->type == 2 ? 'selected' : '' }} value="2">Help</option>
                                                </select>
                                                @error('type')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="image" class="col-md-4 col-form-label text-md-right">Page Image</label>

                                            <div class="col-md-6">
                                                <input type="file" id="image" class="form-control @error('image') is-invalid @enderror" name="image">
                                                @error('image')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <img src="{{ URL::to($custom_page->image) }}" style="width: 100px;" class="mt-2 img-fluid" alt=" ">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="content" class="col-md-4 col-form-label text-md-right">Page Content</label>

                                            <div class="col-md-6">
                                                <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" required="">{{ $custom_page->content }}</textarea>
                                                @error('content')
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