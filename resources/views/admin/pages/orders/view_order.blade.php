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
                                                @php
                                                    $totalPrice += $cart->product->price * $cart->product_quantity;
                                                @endphp

                                                    <tr>
                                                        <td>
                                                            <img src="{{ url($cart->product->productImages->first()->name) }}" height="100px;">
                                                            <h6>{{ $cart->product->title}}</h6>
                                                        </td>
                                                        <td>
                                                            Tk {{ $cart->product->price}}
                                                        </td>
                                                        <td>
                                                            <form action="{{ url('/carts/update/'.$cart->id) }}" method="POST">
                                                                @csrf
                                                                <input type="number" min="1" value="{{ $cart->product_quantity}}" name="product_quantity">
                                                                <button type="submit" class="btn btn-outline-dark"><i class="far fa-plus-square"></i></button>
                                                            </form>
                                                            
                                                        </td>
                                                        <td>
                                                            Tk {{ $cart->product->price * $cart->product_quantity}}
                                                        </td>
                                                        <td>
                                                            <a id="delete" href="{{ url('/carts/delete/'.$cart->id) }}" class="btn btn-link text-danger"><i class="fas fa-times"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th colspan="3" class="text-right">Total = </th>
                                                <th colspan="2">Tk {{ $totalPrice }}</th>
                                            </tr>
                                            </tfoot>
                                        </table>

                                        <hr>

                                        @if($order->is_completed)
                                        <a href="{{ url('admin/orders/complete/'.$order->id) }}" class="btn btn-danger">Cancel Order</a>
                                        @else
                                        <a href="{{ url('admin/orders/complete/'.$order->id) }}" class="btn btn-success">Complete Order</a>
                                        @endif

                                        @if($order->is_paid)
                                        <a href="{{ url('admin/orders/paid/'.$order->id) }}" class="btn btn-danger">Cancel Payment</a>
                                        @else
                                        <a href="{{ url('admin/orders/paid/'.$order->id) }}" class="btn btn-success">Paid Order</a>
                                        @endif

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div><!--end of content row-->

                </div>
                <!-- Begin Page Content -->

@endsection