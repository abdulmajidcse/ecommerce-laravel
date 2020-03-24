<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $order->name }}</title>
    <style>
        h1, h2, h3, h4, h5, h6, p, img, table{
            padding: 0;
            margin: 0;
        }
        table{
            width: 100%;
            text-align: center;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        img{
            width: 100px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div>
        <h2 style="text-transform: uppercase;color: tomato;"><strong>Invoice</strong></h2>
        <hr>
        <h4><strong>{{ env('APP_NAME') }}</strong></h4>
        <h4><strong>{{ 'Mirpur 10, Dhaka-1216' }}</strong></h4>
        <h4><strong>{{ 'admin@ecommerce.com' }}</strong></h4>
        <h4><strong>{{ env('APP_URL') }}</strong></h4>
        <hr>
        <p><strong>Order ID: </strong>#LE{{ $order->id }}</p>
        <p><strong>Orderer Name: </strong>{{ $order->name }}</p>
        <p><strong>Orderer Phone: </strong>{{ $order->phone }}</p>
        @if($order->email)
        <p><strong>Orderer Email: </strong>{{ $order->email }}</p>
        @endif
        <p><strong>Orderer Shipping Address: </strong>{{ $order->shipping_address }}</p>
        <p><strong>Orderer Payment Method: </strong>{{ $order->payment->name }}</p>
        @if($order->payment->short_name != 'cash_in')
        <p><strong>Payment Transaction ID: </strong>{{ $order->transaction_id }}</p>
        @endif
    </div>
    <hr>
    <div>
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
                @foreach ($order->carts as $cart)
                @php
                    $totalPrice += $cart->product->price * $cart->product_quantity;
                @endphp

                <tr>
                    <td>
                        <img src="{{ $cart->product->productImages->first()->name }}">
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
                <th colspan="3" class="text-right">Total = </th>
                <th>Tk {{ $totalPrice }}</th>
            </tr>
            </tfoot>
        </table>
        
        <div style="margin: 10px;">
            <p>Thank you for your purchase!</p>
            <p> - {{ env('APP_NAME') }}</p>
            <p> {{ env('APP_URL') }}</p>
        </div>

    </div>
</body>
</html>