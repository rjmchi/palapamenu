        <div class="menu border-r border-2 w-3/5 mx-1">
            <ul class="menu-nav flex justify-center mb-5">
                @foreach($menus as $menu)
                    <li><a href="#menu{{$menu->id}}" class="font-semibold pt-0 px-3 pb-3 mx-1 text-neutral-800 rounded-b-lg  border-2 border-t-0 hover:bg-neutral-200">{{$menu->name}}</a></li>
                @endforeach
            </ul>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
                @foreach ($menus as $menu)
                <a id="menu{{$menu->id}}"></a>
                <div class="title">
                    <h2>{{$menu->name}}</h2>
                </div>
                    @foreach($menu->categories as $category)
                        <div class="category">
                        <h3>{{$category->name}}</h3>
                        <h4>{{$category->description}}</h4>
                        </div>
                        @foreach ($category->items as $item)
                            <div class="hover:bg-neutral-100 border-b border-nuetral-700 rounded-sm pl-2">
                            <a href="/order/{{$item->id}}" class="text-neutral-700 py-1">
                                <div class="item text-lg">
                                    <span>{{$item->name}}</span><span class="price">{{$item->price}}</span>
                                </div>
                                <p class="mb-2">{{$item->description}}</p>
                            </a>
                            </div>
                            @foreach($item->options as $option)
                                <div class="hover:bg-neutral-100 border-b border-nuetral-700 rounded-sm">
                                    <a href="/order/{{$item->id}}/{{$option->id}}" class="text-neutral-700 py-1 text-lg">
                                        <div class="option">
                                            <span>{{$option->name}}</span> <span class="price">{{$option->price}}</span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach

                        @endforeach
                    @endforeach
                @endforeach
        </div><!-- menu -->