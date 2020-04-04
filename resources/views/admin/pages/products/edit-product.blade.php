@extends('admin.layouts.app')

@section('title')
    {{ 'Edit product' }}
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
                                    <div class="card-header text-primary">Edit product</div>
                
                                    <div class="card-body">
                                        <form method="POST" action="{{ URL::to('/admin/products/update/'.$product->id) }}" enctype="multipart/form-data" class="was-validated">
                                            @csrf

                                            <div class="form-group row">
                                                <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                                                <div class="col-md-6">
                                                    <input type="text" id="title" class="form-control @error('title') is-invalid @enderror" name="title" required="" value="{{ $product->title }}">
                                                    @error('title')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            
                                            <div class="form-group row">
                                                <label for="short_details" class="col-md-4 col-form-label text-md-right">Short details</label>

                                                <div class="col-md-6">
                                                    <textarea name="short_details" id="editor" class="form-control editor1 @error('short_details') is-invalid @enderror">{!! $product->short_details !!}</textarea>
                                                </div>
                                                @error('short_details')
                                                    <div class="text-danger col-md-6 offset-md-4">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group row">
                                                <label for="full_details" class="col-md-4 col-form-label text-md-right">Full details</label>

                                                <div class="col-md-6">
                                                    <textarea name="full_details" id="editor" class="form-control editor2 @error('full_details') is-invalid @enderror">{!! $product->full_details !!}</textarea>
                                                </div>
                                                @error('full_details')
                                                    <div class="text-danger col-md-6 offset-md-4">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group row">
                                                <label for="category_id" class="col-md-4 col-form-label text-md-right">Category</label>

                                                <div class="col-md-6">
                                                    <select id="category_id" name="category_id" class="form-control @error('category_id') is-invalid @enderror" required="">
                                                        @foreach($parent_category as $parent)
                                                        <option value="{{ $parent->id }}" 
                                                            @if($parent->id == $product->category_id)
                                                                {{ 'selected' }}
                                                            @endif
                                                            >{{ $parent->name }}</option>
                                                            @foreach(App\Category::orderBy('name', 'asc')->where('parent_id', $parent->id)->get() as $child)
                                                                <option value="{{ $child->id }}"
                                                                @if($child->id == $product->category_id)
                                                                    {{ 'selected' }}
                                                                @endif
                                                                > ---> {{ $child->name }}</option>
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
                                                        <option value="{{ $row->id }}" 
                                                        @if($row->id == $product->brand_id)
                                                            {{ 'selected' }}
                                                        @endif
                                                        >{{ $row->name }}</option>

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
                                                    <input type="text" id="slug" class="form-control @error('slug') is-invalid @enderror" name="slug" required="" value="{{ $product->slug }}">
                                                    @error('slug')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="quantity" class="col-md-4 col-form-label text-md-right">Quantity</label>

                                                <div class="col-md-6">
                                                    <input type="number" id="quantity" class="form-control @error('quantity') is-invalid @enderror" name="quantity" required="" value="{{ $product->quantity }}">
                                                    @error('quantity')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="price" class="col-md-4 col-form-label text-md-right">Price</label>

                                                <div class="col-md-6">
                                                    <input type="text" id="price" class="form-control @error('price') is-invalid @enderror" name="price" required="" value="{{ $product->price }}">
                                                    @error('price')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="offer_price" class="col-md-4 col-form-label text-md-right">Offer price</label>

                                                <div class="col-md-6">
                                                    <input type="text" id="offer_price" class="form-control @error('offer_price') is-invalid @enderror" name="offer_price" value="{{ $product->offer_price }}">
                                                    @error('offer_price')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="image" class="col-md-4 col-form-label text-md-right">Product image</label>

                                                <div class="col-md-6">
                                                    <input type="file" id="image" class="form-control @error('image.*') is-invalid @enderror" name="image[]" multiple="multiple">
                                                    @error('image.*')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror

                                                    <!--product images-->
                                                    @if(count($product->productImages) > 0)
                                                        @foreach($product->productImages as $image)
                                                        <img src="{{ URL::to($image->name) }}" style="height: 60px;" class="mt-2 img-thumbnail">
                                                        @endforeach
                                                    @endif
                                                    
                                                </div>
                                            </div>

                                            @if(count($product->productImages) > 0)
                                            <div class="form-group row">
                                                <div class="col-md-4"></div>
                                                <div class="col-md-8">
                                                    <input class="form-check-input" type="checkbox" id="image_del_check" name="image_del_check">
                                                    <label for="image_del_check">Delete old images</label>
                                                </div>
                                            </div>
                                            @endif

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
                    </div><!--end of content row-->

                </div>
                <!-- Begin Page Content -->

@endsection