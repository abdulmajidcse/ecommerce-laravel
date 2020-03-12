@extends('frontend.layouts.app')

@section('title')
    {{ 'Checkout' }}
@endsection

@section('content')

            <div class="col-12">
                <!-- Main Content -->
                <div class="row">
                    <div class="col-12 mt-3 text-center text-uppercase">
                        <h2>Checkout</h2>
                    </div>
                </div>

                <main class="row">
                    <div class="col-12 bg-white py-3 mb-3">
                        <div class="row">
                            <div class="col-md-8 mx-auto table-responsive">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card mb-2">
                                            <div class="card-header text-info">Total Items</div>
                                            <div class="card-body">
                                                <table class="table table-striped table-hover table-sm">
                                                    <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $totalPrice = 0;
                                                        @endphp
                                                        @foreach ($carts as $cart)
                                                        @php
                                                            $totalPrice += $cart->product->price * $cart->product_quantity;
                                                        @endphp

                                                            <tr>
                                                                <td>
                                                                    <img src="{{ url($cart->product->productImages->first()->name) }}" class="img-fluid">
                                                                    <h6>{{ $cart->product->title}}</h6>
                                                                </td>
                                                                <td>
                                                                    Tk {{ $cart->product->price}}
                                                                </td>
                                                                <td>{{ $cart->product_quantity}}</td>
                                                                <td>
                                                                    Tk {{ $cart->product->price * $cart->product_quantity}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th colspan="3" class="text-right">Total price = </th>
                                                        <th>Tk {{ $totalPrice }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="3" class="text-right">Total price with shipping cost = </th>
                                                        <th>Tk {{ $totalPrice + App\Settings::first()->shipping_cost }}</th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        </div>
                                    
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="card mt-1">
                                            <div class="card-header text-info">Shipping Address</div>
                                            <div class="card-body">
                                                <form method="POST" action="{{ url('/checkout/confirm') }}">
                                                    @csrf
                                                    <div class="form-group row">
                                                        <label for="name" class="col-md-4 col-form-label text-md-right">Reciever Name</label>

                                                        <div class="col-md-6">
                                                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::check() ? Auth::user()->first_name  . ' ' . Auth::user()->last_name : '' }}" required="">
                                                            @error('name')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="email" class="col-md-4 col-form-label text-md-right">Email (Optional)</label>

                                                        <div class="col-md-6">
                                                            <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::check() ? Auth::user()->email : '' }}">
                                                            @error('email')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>

                                                        <div class="col-md-6">
                                                            <input type="text" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Example: 01XXXXXXXXX" value="{{ Auth::check() ? Auth::user()->phone : '' }}" required="">
                                                            @error('phone')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="shipping_address" class="col-md-4 col-form-label text-md-right">Shipping Address</label>

                                                        <div class="col-md-6">
                                                            <textarea id="shipping_address" class="form-control @error('shipping_address') is-invalid @enderror" name="shipping_address" required="">{{ Auth::check() ? Auth::user()->shipping_address : '' }}</textarea>
                                                            @error('shipping_address')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="message" class="col-md-4 col-form-label text-md-right">Message (Optional)</label>

                                                        <div class="col-md-6">
                                                            <textarea id="message" class="form-control @error('message') is-invalid @enderror" name="message">{{ Auth::check() ? Auth::user()->shipping_address : '' }}</textarea>
                                                            @error('message')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="payment_method_id" class="col-md-4 col-form-label text-md-right">Payment Method</label>

                                                        <div class="col-md-6">
                                                            <select name="payment_method_id" id="payment_method_id" class="form-control @error('payment_method_id') is-invalid @enderror">
                                                                <option>Select a payment method</option>
                                                                @foreach ($paymentMethods as $paymentMethod)
                                                                    <option value="{{ $paymentMethod->id }}">{{ $paymentMethod->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('payment_method_id')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                            
                                                            <!-- payment method details here -->
                                                            <div id="payment_box">
                                                                
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row mb-0">
                                                        <div class="col-md-6 offset-md-4">
                                                            <button type="submit" class="btn btn-info">Order Now</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </main>
                <!-- Main Content -->
            </div>

@endsection