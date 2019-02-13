<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Редактировать заказ</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
<div class="container">
    <div class="row">
        <form action="{{route("update-order")}}" method="post">
            @csrf
            @method("put")
            <div class="form-group">
                <label for="email">Email клиента</label>
                <input value="{{$order->client_email}}" type="email" class="form-control" id="email"
                       placeholder="Email клиента">
            </div>

            <div class="form-group">
                <label for="partner">Партнер</label>
                <select class="form-control" id="status">
                    @foreach($partners as $partner)
                        <option {{$partner->id === $order->partner_id ? "selected" : ""}} value="{{$partner->id}}">{{$partner->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="">Продукты</label>
                <ul class="list-group">
                    @foreach($order->products as $product)
                        <li class="list-group-item">{{$product->name}}: {{$product->pivot->quantity}} шт.</li>
                    @endforeach
                </ul>
            </div>

            <div class="form-group">
                <label for="status">Статус заказа</label>
                <select class="form-control" id="status">
                    <option {{$order->status === 0 ? "selected" : ""}} value="0">новый</option>
                    <option {{$order->status === 10 ? "selected" : ""}} value="10">подтвержден</option>
                    <option {{$order->status === 20 ? "selected" : ""}} value="20">завершен</option>
                </select>
            </div>

            <div class="form-group">
                <label for="">Стоимость: {{$order->getSum()}}</label>
            </div>


            <button type="submit" class="btn btn-primary">Сохранение изменений в заказе</button>
        </form>
    </div>
</div>
</body>
</html>