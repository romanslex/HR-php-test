<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Заказы</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
<div class="container">
    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Партнер</th>
                <th scope="col">Стоимость</th>
                <th scope="col">Состав заказа</th>
                <th scope="col">Статус заказа</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td><a target="_blank" href="{{route("edit-order", ["id" => $order->id])}}">{{$order->id}}</a></td>
                    <td>{{$order->partner->name}}</td>
                    <td>{{$order->getSum()}}</td>
                    <td style="font-size: 12px">
                        @foreach($order->products as $product)
                            <div>{{$product->name}}: {{$product->pivot->quantity}}</div>
                        @endforeach
                    </td>
                    <th>{{$order->getStatusString()}}</th>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $orders->links() }}
    </div>
</div>
</body>
</html>