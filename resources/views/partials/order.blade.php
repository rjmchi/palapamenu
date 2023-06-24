<div class="order w-2/5 mx-1 border-2 rounded text-center">
            <h2 class="text-center font-bold text-neutral-700 text-xl bg-neutral-200 w-full p-1.5 mb-2.5">{{$order->apt}} {{$order->name}}</h2>
            <h3>{{__('Your Order')}}</h3>
            <p class="mb-2 md:m-3">{{__('Requested delivery time')}}: {{$order->delivery_time? $order->delivery_time : __('Not specified')}}</p>
        @php
            $disabled = sizeof($order->orderItems) < 1 ? 'disabled':''
        @endphp
        <a href="/sendorder" class="btn btn-primary block mb-2 lg:inline {{$disabled}}">{{__('Send Order')}}</a>
            <a href="/cancel/{{$order->id}}" class="btn btn-danger block lg:inline">{{__('Cancel Order')}}</a>

            <div class="tipmsg mt-2 md:m-4 text-sm leading-3">{{__('A 15% service charge will be added to your bill.')}}</div>
            @php
                $total = 0;
            @endphp
            <dl class="border-t border-neutral-400 m-4">
            @foreach ($order->orderItems as $item)
            @php
                $total += $item->price;
            @endphp
                <dt class="mt-2.5">
                    {{$item->quantity}} &mdash;  {{$item->option ? $item->option->name : $item->item->name}}
                    $<span>{{$item->price}}</span>
                    <a href="/removeitem/{{$item->id}}" title="{{__('Remove item')}}" class="remove text-danger-500">X</span></a>
                </dt>

                @if ($item->choice)
                    <dd class="leading-5">{{$item->choice->name}}</dd>
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
            @php
                $serviceCharge = round($total * .15);
            @endphp
            <p>{{__('Service Charge')}}: ${{$serviceCharge}}
            <p><strong><em>{{__('Total')}}: ${{$total + $serviceCharge}}</em></strong></p>
        </div> <!-- order-->