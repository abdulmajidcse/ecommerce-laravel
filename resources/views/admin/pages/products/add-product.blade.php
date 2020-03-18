@extends('admin.layouts.app')

@section('title')
    {{ 'Add product' }}
@endsection

@section('content')
    
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Product</h1>
                    <a href="{{ URL::to('/') }}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-alt-circle-right"></i> Go to website</a>
                    </div>

                    <!-- Content Row -->

                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="contentWrapper">
                                <div class="card">
                                    <div class="card-header text-primary">Add new product</div>
                
                                    <div class="card-body">
                                        <form method="POST" action="{{ URL::to('admin/products/store') }}" enctype="multipart/form-data" class="was-validated">
                                            @csrf

                                            <div class="form-group row">
                                                <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                                                <div class="col-md-6">
                                                    <input type="text" id="title" class="form-control @error('title') is-invalid @enderror" name="title" required="">
                                                    @error('title')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            
                                            <div class="form-group row">
                                                <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                                                <div class="col-md-6">
                                                    <input type="text" id="description" class="form-control @error('description') is-invalid @enderror" name="description">
                                                    @error('description')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="category_id" class="col-md-4 col-form-label text-md-right">Category</label>

                                                <div class="col-md-6">
                                                    <select id="category_id" name="category_id" class="form-control @error('category_id') is-invalid @enderror" required="">
                                                        @foreach($parent_category as $parent)
                                                        <option value="{{ $parent->id }}" >{{ $parent->name }}</option>
                                                            @foreach(App\Category::orderBy('name', 'asc')->where('parent_id', $parent->id)->get() as $child)
                                                                <option value="{{ $child->id }}"> ---> {{ $child->name }}</option>
                                                            @endforeach

                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="brand_id" class="col-md-4 col-form-label text-md-right">Brand</label>

                                                <div class="col-md-6">
                                                    <select id="brand_id" name="brand_id" class="form-control @error('brand_id') is-invalid @enderror" required="">
                                                        @foreach($brand as $row)
                                                        <option value="{{ $row->id }}" >{{ $row->name }}</option>

                                                        @endforeach
                                                    </select>
                                                    @error('brand_id')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="slug" class="col-md-4 col-form-label text-md-right">Slug</label>

                                                <div class="col-md-6">
                                                    <input type="text" id="slug" class="form-control @error('slug') is-invalid @enderror" name="slug" required="">
                                                    @error('slug')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="quantity" class="col-md-4 col-form-label text-md-right">Quantity</label>

                                                <div class="col-md-6">
                                                    <input type="number" id="quantity" class="form-control @error('quantity') is-invalid @enderror" name="quantity" required="">
                                                    @error('quantity')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="price" class="col-md-4 col-form-label text-md-right">Price</label>

                                                <div class="col-md-6">
                                                    <input type="text" id="price" class="form-control @error('price') is-invalid @enderror" name="price" required="">
                                                    @error('price')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="offer_price" class="col-md-4 col-form-label text-md-right">Offer price</label>

                                                <div class="col-md-6">
                                                    <input type="text" id="offer_price" class="form-control @error('offer_price') is-invalid @enderror" name="offer_price">
                                                    @error('offer_price')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="image" class="col-md-4 col-form-label text-md-right">Product images</label>

                                                <div class="col-md-6">
                                                    <input type="file" id="image" class="form-control @error('image.*') is-invalid @enderror" name="image[]" multiple="multiple">
                                                    @error('image.*')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-4">
                                                    <button type="submit" class="btn btn-info">Add new</button>
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