<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Palapa Order</title>
</head>
<body>
    <h1>Palapa Order</h1>
    <p>{{$order->apt}} {{$order->name}}</p>
    <p>Requested Delivery Time: {{$order->delivery_time}}</p>
    <dl>
        @foreach ($order->orderItems as $item)
            <dt>{{$item->quantity}} {{$item->item}}</dt>
            <dd>{{$item->choice}}</dd>
            <dd>{{$item->special}}</dd>
        @endforeach
    </dl>
</body>
</html>