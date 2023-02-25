<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <title>Document</title>

</head>

<body>
    <p>Your order has been successfully completed.</p>

    <div>Name : {{ auth()->user()->name }}</div>
    <table class="table table-striped table-bordered" style="border-style: solid; border-spacing: 15px;">
        <thead>
            <tr>
                <th>S.N</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
            <div>
            </div>
            @foreach ($myOrders as $myOrderItem)
                @foreach ($myOrderItem->products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->name }}</td>
                        <td>Rs.{{ $product->orders()->where('order_id', $myOrderItem->id)->first()->pivot->price }}
                        </td>
                        <td> {{ $product->orders()->where('order_id', $myOrderItem->id)->first()->pivot->quantity }}
                        </td>
                        <td>Rs.{{ $product->orders()->where('order_id', $myOrderItem->id)->first()->pivot->price *$product->orders()->where('order_id', $myOrderItem->id)->first()->pivot->quantity }}
                        </td>

                    </tr>
                @endforeach
                <tr class="total-row" style="font-weight: bold;">
                    <td colspan="4">Total</td>
                    <td>Rs{{ $myOrderItem->total_amount }}</td>
                </tr>
            @endforeach
            </div>
        </tbody>
    </table>

</body>

</html>
