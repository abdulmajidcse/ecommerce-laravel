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
            width: 150px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div>
        <h2 style="text-transform: uppercase;color: tomato;"><strong>Invoice</strong></h2>
        <hr>
        <h4 style="margin-bottom: 10px;">Company: <img src="{{ $settings->logo }}" style="width: 30px; height: 30px;"> <strong>{{ $settings->name }}</strong></h4>
        <h4>Address: <strong>{{ $settings->address }}</strong></h4>
        <h4>Email: <strong>{{ $settings->email }}</strong></h4>
        <h4>Phone: <strong>{{ $settings->phone }}</strong></h4>
        <h4>Website: <strong>{{ env('APP_URL') }}</strong></h4>
        <hr>
        <p><strong>Order ID: </strong>#LE{{ $order->id }}</p>
        <p><strong>Orderer Name: </strong>{{ $order->name }}</p>
        <p><strong>Orderer Phone: </strong>{{ $order->phone }}</p>
        @if($order->email)
        <p><strong>Orderer Email: </strong>{{ $order->email }}</p>
        @endif
        <p><strong>Orderer Shipping Address: </strong>{{ $order->shipping_address }}</p>
        <p><strong>Orderer Payment Method: </strong>{{ $order->payment->name }}</p>
        @if($order->transaction_id)
        <p><strong>Payment Transaction ID: </strong>{{ $order->transaction_id }}</p>
        @endif
        <p><strong>Order Date: </strong>{{ date_format($order->created_at, 'h:i a, F d, Y') }}</p>
    </div>

    <div style="margin-top: 10px;">
        <table>
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
                        <img src="{{ $cart->product->productImages->first()->name }}">
                        @endif
                        <h4 style="padding: 5px; margin-top: 10px;">{{ $cart->product->title}}</h4>
                    </td>
                    <td>
                        Tk 
                        @if (is_null($cart->product->offer_price))
                            {{ $cart->product->price}}
                        @else
                            {{ $cart->product->offer_price}}
                        @endif
                    </td>
                    <td>{{ $cart->product_quantity}}</td>
                    <td>
                        Tk 
                        @if (is_null($cart->product->offer_price))
                            {{ $cart->product->price * $cart->product_quantity}}
                        @else
                            {{ $cart->product->offer_price * $cart->product_quantity}}
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th colspan="3" class="text-right">
                    Total+Shipping Cost(Tk {{ $settings->shipping_cost }}) = 
                </th>
                <th>
                    Tk {{ $totalPrice+$settings->shipping_cost }}
                </th>
            </tr>
            </tfoot>
        </table>
        
        <div style="margin: 10px;">
            <p>Thank you for your order!</p>
            <p> - {{ $settings->name }}</p>
            <p> {{ env('APP_URL') }}</p>
        </div>

    </div>
</body>
</html>