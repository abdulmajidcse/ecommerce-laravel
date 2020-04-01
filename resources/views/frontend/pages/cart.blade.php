@extends('frontend.layouts.app')

@section('title')
    {{ 'Cart Items' }}
@endsection

@section('content')

            <div class="col-12">
                <!-- Main Content -->
                <div class="row">
                    <div class="col-12 mt-3 text-center text-uppercase">
                        <h2>Shopping Cart</h2>
                    </div>
                </div>

                <main class="row">
                    <div class="col-12 bg-white py-3 mb-3">
                        <div class="row">
                            <div class="col-md-10 mx-auto table-responsive">
                                <div class="row">
                                    <div class="col-12">
                                        @if ($errors->any())
                                            @foreach ($errors->all() as $error)
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                  <strong>Error!</strong> {{ $error }}
                                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                            @endforeach
                                        @endif
                                        {{-- if product quantity not available in our stock --}}
                                        @if (Session::has('stock'))
                                            @php
                                                $product_stock = Session::get('stock');
                                            @endphp
                                            @foreach ($product_stock as $message)
                                                  <p class="alert alert-warning alert-dismissible fade show m-0" role="alert">
                                                    {{ $message['product_name'] }} has available only {{ $message['product_quantity'] }} products. Please decreament the product quantity for your order.
                                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                  </p>
                                            @endforeach
                                        @endif
                                        <table class="table table-striped table-hover table-sm">
                                            <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $totalPrice = 0;
                                                    $i = 0;
                                                @endphp
                                                @foreach ($carts as $cart_id => $cart)
                                                    @php
                                                        $totalPrice += $products[$i]->price * $cart['product_quantity'];
                                                    @endphp

                                                    <tr>
                                                        <td>
                                                            <img src="{{ URL::to($products[$i]->productImages->first()->name) }}" class="img-fluid">
                                                            <h6>{{ $products[$i]->title}}</h6>
                                                        </td>
                                                        <td>
                                                            Tk {{ $products[$i]->price}}
                                                        </td>
                                                        <td>
                                                            <form action="{{ url('/carts/update/'.$cart_id) }}" method="POST" class="was-validated">
                                                                @csrf
                                                                <input type="number" min="1" value="{{ $cart['product_quantity'] }}" name="product_quantity" required="">
                                                                <button type="submit" class="btn btn-outline-dark"><i class="far fa-plus-square"></i></button>
                                                            </form>
                                                            
                                                        </td>
                                                        <td>
                                                            Tk {{ $products[$i]->price * $cart['product_quantity'] }}
                                                        </td>
                                                        <td>
                                                            <a id="delete" href="{{ url('/carts/delete/'.$cart_id) }}" class="btn btn-link text-danger"><i class="fas fa-times"></i></a>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        ++$i;
                                                    @endphp
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th colspan="3" class="text-right">Total = </th>
                                                <th colspan="2">Tk {{ $totalPrice }}</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="col-12 text-right">
                                        <a href="{{ url('/') }}" class="btn btn-outline-info mr-3" type="submit">Continue Shopping</a>
                                        <a href="{{ url('/checkout') }}" class="btn btn-outline-success">Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </main>
                <!-- Main Content -->
            </div>

@endsection