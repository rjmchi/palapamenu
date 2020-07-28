@extends('layouts.app')

@section('content')
<div class="container">
    <div class="menupage">
        <div class="menu">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
                @foreach ($menus as $menu)
                <div class="title">
                    <h2>{{$menu->name}}</h2>
                </div>
                    @foreach($menu->categories as $category)
                        <div class="category">
                        <h3>{{$category->name}}</h3>
                        <h4>{{$category->description}}</h4>
                        </div>
                        @foreach ($category->items as $item)
                            <a href="/order/{{$item->id}}">
                                <div class="item">
                                <span>{{$item->name}}</span><span class="price">{{$item->price}}</span>
                                </div>
                                <p>{{$item->description}}</p>
                            </a>
                            @foreach($item->options as $option)
                                <a href="/order/{{$item->id}}/{{$option->id}}">
                                    <div class="option">
                                    <span>{{$option->name}}</span> <span class="price">{{$option->price}}</span>
                                    </div>
                                </a>
                            @endforeach
                        @endforeach
                    @endforeach
                @endforeach
        </div><!-- menu -->
        <div class="order">
            <h2>{{$order->apt}} {{$order->name}}</h2>
            <h3>{{__('Your Order')}}</h3>
            <p>{{__('Requested delivery time')}}: {{$order->delivery_time? $order->delivery_time : __('Not specified')}}</p>
        
            <a href="/sendorder" class="btn btn-primary">{{__('Send Order')}}</a>
            <a href="/cancel/{{$order->id}}" class="btn btn-danger">{{__('Cancel Order')}}</a>

            <div class="tipmsg">{{__('Tips are not included in the menu prices.  Please tip in cash at the time of service')}}</div>

            <dl>
            @foreach ($order->orderItems as $item)
                <dt>{{$item->quantity}} -  {{$item->item}} <a href="/removeitem/{{$item->id}}" title="{{__('Remove item')}}" class="remove">X</span></a></dt>
                <dd>{{$item->option}}</dd>
                <dd>{{$item->choice}}</dd>
                <dd>{{$item->special}}</dd>
            @endforeach
            </dl>
        </div> <!-- order-->
    </div>
</div><!-- container-->
@endsection
