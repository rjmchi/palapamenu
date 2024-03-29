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
    <h3>{{$order->date}}</h3>
    <p><strong>{{$order->apt}} {{$order->name}}</strong></p>

    <p>Hora de entrega: {{$order->delivery_time}}</p>
    <p>Entregar a: {{$order->location}}</p>
    <dl>
        @foreach ($order->orderItems as $item)
            <dt>{{$item->quantity}} {{$item->item->translate('es')->name}} <span>${{$item->price}}</span></dt>
                <dd>{{$item->item->translate('es')->description}}</dd>
            @if($item->choice)
                <dd>{{$item->choice->translate('es')->name}}</dd>
            @endif
            @if ($item->option)
                <dd>{{$item->option->translate('es')->name}}</dd>
            @endif
            @if ($item->selections)
            <p>
                @foreach($item->selections as $sel)
                    {{$sel->translate('es')->name}},
                @endforeach
            </p>
            @endif
            <dd>{{$item->special}}</dd>
            <dd>________________________</dd>
        @endforeach
    </dl>
    <p>Subtotal: ${{$order->subtotal}}</p>
    <p>Cuota por servicio: ${{$order->serviceCharge}}
    <p><strong>Total: ${{$order->total}}</strong></p>
    <p></p>
    <p></p>
    <p style="width:50%;border-bottom:1px solid #000;">Firma: </p>
</body>
</html>