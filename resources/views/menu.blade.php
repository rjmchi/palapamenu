<div class="menupage">
    
        <div class="menu">
            <ul class="menu-nav">
                @foreach($menus as $menu)
                    <li><a href="#menu{{$menu->id}}">{{$menu->name}}</a></li>
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