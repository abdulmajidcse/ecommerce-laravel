@extends('frontend.layouts.app')

@section('title')
    {{ $product->title }}
@endsection

@section('content')

            <div class="col-12">
                <!-- Main Content -->
                <main class="row">
                    <div class="col-12 bg-white py-3 my-3">
                        <div class="row">

                            <!-- Product Images -->
                            <div class="col-lg-5 col-md-12 mb-3">
                                <div class="col-12 mb-3">
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($product->productImages as $image)
                                        @if ($i > 0)
                                            <div class="img-large border" style="background-image: url('{{ url($image->name) }}')"></div>
                                        @endif
                                        @php
                                            $i = 0;
                                        @endphp
                                    @endforeach
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        @foreach ($product->productImages as $image)
                                            <div class="col-sm-2 col-3">
                                                <div class="img-small border" style="background-image: url('{{ url($image->name) }}')" data-src="{{ url($image->name) }}"></div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- Product Images -->

                            <!-- Product Info -->
                            <div class="col-lg-5 col-md-9">
                                <div class="col-12 product-name large">
                                    {{ $product->title }}
                                    <small>By <a href="{{ url('/brand-product/'.$product->brands->name) }}">{{ $product->brands->name }}</a></small>
                                </div>
                                <div class="col-12 px-0">
                                    <hr>
                                </div>
                                <div class="col-12">
                                    {!! $product->short_details !!}

                                    <p class="alert alert-dark">In Stock: {{ $product->quantity }}</p>
                                </div>
                            </div>
                            <!-- Product Info -->

                            <!-- Sidebar -->
                            <div class="col-lg-2 col-md-3 text-center">
                                <div class="col-12 border-left border-top sidebar h-100">
                                    <div class="row">
                                        <div class="col-12">
                                            @if ($product->offer_price > 0)
                                                <span class="detail-price">
                                                    TK {{ $product->offer_price }}
                                                </span>
                                                <br>
                                                <span class="detail-price-old">
                                                    TK {{ $product->price }}
                                                </span>
                                            @else
                                                <span class="detail-price">
                                                    TK {{ $product->price }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-12 mt-3">
                                            @include('frontend.partials.cart-button')
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Sidebar -->

                        </div>
                    </div>

                    <div class="col-12 mb-3 py-3 bg-white text-justify">

                            <!-- Details -->
                            <div class="container-fluid">
                                <div class="text-uppercase">
                                    <h2><u>Details</u></h2>
                                </div>
                                <div class="row">
                                    <div class="col-md-10">
                                        {!! $product->full_details !!}
                                    </div>
                                </div>
                            </div>
                            <!-- Details -->
                    </div>

                    <!-- Similar Product -->
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 py-3">
                                <div class="row">
                                    @if (!$similarProducts)
                                        <div class="col-12 text-center text-uppercase">
                                            <h2>Similar Products</h2>
                                        </div>
                                    @endif
                                    
                                </div>
                                <div class="row">

                                    <!-- Product -->
                                    @foreach ($similarProducts as $product)
                                        <div class="col-lg-3 col-sm-6 my-3">
                                            <div class="col-12 bg-white text-center h-100 product-item">
                                                <div class="row h-100">
                                                    <div class="col-12 p-0 mb-3">
                                                        <a href="{{ url('/single-product/'.$product->slug) }}">
                                                            @php
                                                                $i = 1;
                                                            @endphp
                                                            @foreach ($product->productImages as $image)
                                                                @if ($i > 0)
                                                                    <img src="{{ url($image->name) }}" class="img-fluid">
                                                                @endif
                                                                @php
                                                                    $i = 0;
                                                                @endphp
                                                            @endforeach
                                                        </a>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <a href="{{ url('/single-product/'.$product->slug) }}" class="product-name">{{ $product->title }}</a>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        {{-- <span class="product-price-old">
                                                            
                                                        </span>
                                                        <br> --}}
                                                        <span class="product-price">
                                                            TK {{ $product->price }}
                                                        </span>
                                                    </div>
                                                    <div class="col-12 mb-3 align-self-end">
                                                        <button class="btn btn-outline-dark" type="button"><i class="fas fa-cart-plus mr-2"></i>Add to cart</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- Product -->

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Similar Products -->

                </main>
                <!-- Main Content -->
            </div>

@endsection