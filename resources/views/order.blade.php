 <div class="order">
            <h2>{{$order->apt}} {{$order->name}}</h2>
            <h3>{{__('Your Order')}}</h3>
            <p>{{__('Requested delivery time')}}: {{$order->delivery_time? $order->delivery_time : __('Not specified')}}</p>
        @php 
            $disabled = sizeof($order->orderItems) < 1 ? 'disabled':''
        @endphp
        <a href="/sendorder" class="btn btn-primary {{$disabled}}" >{{__('Send Order')}}</a>
            <a href="/cancel/{{$order->id}}" class="btn btn-danger">{{__('Cancel Order')}}</a>

            <div class="tipmsg">{{__('Tips are not included in the menu prices.  Please tip in cash at the time of service.')}}</div>
            @php
                $total = 0;
            @endphp
            <dl>
            @foreach ($order->orderItems as $item)
            @php
                $total += $item->price;
            @endphp
                <dt>
                    {{$item->quantity}} &mdash;  {{$item->option ? $item->option->name : $item->item->name}}
                    $<span>{{$item->price}}</span>
                    <a href="/removeitem/{{$item->id}}" title="{{__('Remove item')}}" class="remove">X</span></a>
                </dt>

                @if ($item->choice)
                    <dd>{{$item->choice->name}}</dd>
                @endif
                @if($item->selections)
                    <p>
                    @foreach ($item->selections as $sel)
                        {{$sel->name}}, 
                    @endforeach 
                    </p>
                @endif
                <dd>{{$item->special}}</dd>
            @endforeach
            </dl>
            <p><strong><em>{{__('Total')}}: ${{$total}}</em></strong></p>
        </div> <!-- order-->