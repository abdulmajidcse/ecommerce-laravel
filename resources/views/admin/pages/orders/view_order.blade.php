@extends('admin.layouts.app')

@section('title')
    {{ 'View Order' }}
@endsection

@section('content')
    
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Order</h1>
                    <a href="{{ URL::to('/') }}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-alt-circle-right"></i> Go to website</a>
                    </div>

                    <!-- Content Row -->

                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="contentWrapper">
                                <div class="card">
                                    <div class="card-header text-primary">Order Information</div>

                                    <div class="card-body">
                                        <p><strong>Order ID: </strong>#LE{{ $order->id }}</p>
                                        <p><strong>Orderer Name: </strong>{{ $order->name }}</p>
                                        <p><strong>Orderer Phone: </strong>{{ $order->phone }}</p>
                                        <p><strong>Orderer Email: </strong>{{ $order->email }}</p>
                                        <p><strong>Orderer Shipping Address: </strong>{{ $order->shipping_address }}</p>
                                        <p><strong>Orderer Payment Method: </strong>{{ $order->payment->name }}</p>
                                        @if($order->payment->short_name != 'cash_in')
                                        <p><strong>Payment Transaction ID: </strong>{{ $order->transaction_id }}</p>
                                        @endif

                                        <hr>
                                        
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
                                                @endphp
                                                @foreach ($order->carts as $cart)
                                                
                                                @if (is_null($cart->product->offer_price))
                                                    @php
                                                        $totalPrice += $cart->product->price * $cart->product_quantity;
                                                    @endphp
                                                @else
                                                    @php
                                                        $totalPrice += $cart->product->offer_price * $cart->product_quantity;
                                                    @endphp
                                                @endif

                                                    <tr>
                                                        <td>
                                                            @if ($cart->product->productImages->first())
                                                                <img src="{{ url($cart->product->productImages->first()->name) }}" height="100px;">
                                                            @endif
                                                            
                                                            <h6>{{ $cart->product->title}}</h6>
                                                        </td>
                                                        <td>
                                                            Tk 
                                                            @if (is_null($cart->product->offer_price))
                                                                {{ $cart->product->price}}
                                                            @else
                                                                {{ $cart->product->offer_price}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <form action="{{ url('admin/orders/cart/update/'.$cart->id) }}" method="POST">
                                                                @csrf
                                                                <input type="number" min="1" value="{{ $cart->product_quantity}}" name="product_quantity">
                                                                <button type="submit" class="btn btn-outline-dark"><i class="far fa-plus-square"></i></button>
                                                            </form>
                                                            
                                                        </td>
                                                        <td>
                                                            Tk 
                                                            @if (is_null($cart->product->offer_price))
                                                                {{ $cart->product->price * $cart->product_quantity}}
                                                            @else
                                                                {{ $cart->product->offer_price * $cart->product_quantity}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a id="delete" href="{{ url('admin/orders/cart/delete/'.$cart->id) }}" class="btn btn-link text-danger"><i class="fas fa-times"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th colspan="3" class="text-right">Total+Shipping Cost(Tk {{ App\Settings::get()->first()->shipping_cost }}) = </th>
                                                <th colspan="2">Tk {{ $totalPrice+App\Settings::get()->first()->shipping_cost }}</th>
                                            </tr>
                                            <tr>
                                                <th colspan="3" class="text-right">Custom Offer(%) = </th>
                                                <th colspan="2">
                                                    <form action="{{ URL::to('admin/orders/offer/'.$order->id) }}" method="POST" class="was-validated col-6-md ml-auto">
                                                        @csrf
                                                        <input type="number" min="0" value="{{ $order->offer }}" name="offer">
                                                        <button type="submit" class="btn btn-outline-dark"><i class="far fa-plus-square"></i></button>
                                                    </form>
                                                </th>
                                            </tr>
                                            @if ($order->offer > 0)
                                            <tr>
                                                <th colspan="3" class="text-right">Total Price With Offer = </th>
                                                <th colspan="2">
                                                    @php
                                                        $discount = (($totalPrice+App\Settings::get()->first()->shipping_cost)*$order->offer)/100;
                                                    @endphp
                                                    TK {{ $totalPrice-$discount }}
                                                </th>
                                            </tr>
                                            @endif
                                            </tfoot>
                                        </table>

                                        <hr>

                                        @if($order->is_completed)
                                        <a href="{{ url('admin/orders/complete/'.$order->id) }}" class="btn btn-danger btn-sm">Cancel Order</a>
                                        @else
                                        <a href="{{ url('admin/orders/complete/'.$order->id) }}" class="btn btn-success btn-sm">Complete Order</a>
                                        @endif

                                        @if($order->is_paid)
                                        <a href="{{ url('admin/orders/paid/'.$order->id) }}" class="btn btn-danger btn-sm">Cancel Payment</a>
                                        @else
                                        <a href="{{ url('admin/orders/paid/'.$order->id) }}" class="btn btn-success btn-sm">Paid Order</a>
                                        @endif

                                        <a href="{{ url('admin/orders/invoice/'.$order->id) }}" class="btn btn-success btn-sm">Download Invoice</a>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div><!--end of content row-->

                </div>
                <!-- Begin Page Content -->

@endsection