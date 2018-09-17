<div class="panels">
    <ul class="list-group categories-list">
        <li class="list-group-item selected-category">Clique na categoria para ligar ao produto</li>
        @foreach($categories as $category)
            <li class="list-group-item" id="category_{{$category->id}}" onclick="selectCategory('{{$category->id}}');">
                <span class="badge cat_status @if(in_array($category->id, $product_categories)) selected-category @endif"> @if(in_array($category->id, $product_categories))Sim @else Não @endif</span>
                <span class="cat_name @if(in_array($category->id, $product_categories)) active-selected-category @endif ">{{$category->name}}</span>
            </li>
         @endforeach
    </ul>
</div>