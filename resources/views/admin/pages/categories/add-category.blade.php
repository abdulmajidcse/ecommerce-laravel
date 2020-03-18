@extends('admin.layouts.app')

@section('title')
    {{ 'Add category' }}
@endsection

@section('content')
    
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Category</h1>
                    <a href="{{ URL::to('/') }}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-alt-circle-right"></i> Go to website</a>
                    </div>

                    <!-- Content Row -->

                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="contentWrapper">
                                <div class="card">
                                    <div class="card-header text-primary">Add new category</div>
                
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('category-store') }}" enctype="multipart/form-data" class="was-validated">
                                            @csrf
                
                                            <!--
                                            |--------------------------------
                                            | category name
                                            |---------------------------------
                                            -->
                                            <div class="form-group row">
                                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                
                                                <div class="col-md-6">
                                                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Category name" required="">
                                                    @error('name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            <!--
                                            |--------------------------------
                                            | category description
                                            |---------------------------------
                                            -->
                                            <div class="form-group row">
                                                <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
                
                                                <div class="col-md-6">
                                                    <input type="text" id="description" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Category description">
                                                    @error('description')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            <!--
                                            |--------------------------------
                                            | category image
                                            |---------------------------------
                                            -->
                                            <div class="form-group row">
                                                <label for="image" class="col-md-4 col-form-label text-md-right">Image</label>
                
                                                <div class="col-md-6">
                                                    <input type="file" id="image" class="form-control @error('image') is-invalid @enderror" name="image">
                                                    @error('image')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            <!--
                                            |--------------------------------
                                            | category image
                                            |---------------------------------
                                            -->
                                            <div class="form-group row">
                                                <label for="parent_id" class="col-md-4 col-form-label text-md-right">Parent category</label>
                
                                                <div class="col-md-6">
                                                    <select name="parent_id" id="parent_id" class="form-control">
                                                        <option value="" selected="">None</option>
                                                        @foreach($category as $row)
                                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                
                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-4">
                                                    <button type="submit" class="btn btn-primary">Add new</button>
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