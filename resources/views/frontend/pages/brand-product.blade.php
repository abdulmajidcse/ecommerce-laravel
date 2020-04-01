@extends('frontend.layouts.app')

@section('title')
    {{ 'Brand: ' . $brandName->name }}
@endsection

@section('content')

        <div class="col-12">
            <!-- Main Content -->
            <main class="row">

                <!-- Brand Products -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 py-3">
                            <div class="row">
                                <div class="col-12 text-center text-uppercase">
                                    <h2>Brand: <span class="text-muted">{{ $brandName->name }}</span></h2>
                                </div>
                            </div>
                            <div class="row">

                                <!-- Product -->
                                @foreach ($products as $product)
                                    <div class="col-xl-2 col-lg-3 col-sm-6 my-3">
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
                                                    @if ($product->offer_price > 0)
                                                        <span class="product-price-old">
                                                            TK {{ $product->price }}
                                                        </span>
                                                        <br>
                                                        <span class="product-price">
                                                            TK {{ $product->offer_price }}
                                                        </span>
                                                    @else
                                                        <span class="product-price">
                                                            TK {{ $product->price }}
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="col-12 mb-3 align-self-end">
                                                    @include('frontend.partials.cart-button')
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
                <!-- Brand Products -->

                <div class="col-12 pagination justify-content-center">
                    {{ $products->links() }}
                </div>

            </main>
            <!-- Main Content -->
        </div>

@endsection
