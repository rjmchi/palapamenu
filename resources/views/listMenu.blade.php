<div class="listmenu">
    <h1>Menu List</h1>
    <table>
    @foreach ($menus as $menu)
        @foreach($menu->categories as $category)
            @foreach ($category->items as $item)
                <tr><td>{{$item->name}}</td><td class="price">{{$item->price}}</td></tr>
                @foreach($item->options as $option)
                    <tr><td>{{$option->name}}</td> <td class="price">{{$option->price}}</td></tr>
                @endforeach
            @endforeach
        @endforeach
    @endforeach   
    </table>             
</div><!-- menu -->