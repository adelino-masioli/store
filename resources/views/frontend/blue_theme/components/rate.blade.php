<ul>
    @if($is_rate > 0 || !Auth::user())
        <li class="@if($rate[0] == 'r1' || $rate[0] == 'r2' || $rate[0] == 'r3' || $rate[0] == 'r4' || $rate[0] == 'r5') active-rate-vote @endif"><i class="fa fa-star"></i></li>
        <li class="@if($rate[0] == 'r2' || $rate[0] == 'r3' || $rate[0] == 'r4' || $rate[0] == 'r5') active-rate-vote @endif"><i class="fa fa-star"></i></li>
        <li class="@if($rate[0] == 'r3' || $rate[0] == 'r4'|| $rate[0] == 'r5') active-rate-vote @endif"><i class="fa fa-star"></i></li>
        <li class="@if($rate[0] == 'r4' || $rate[0] == 'r5') active-rate-vote @endif"><i class="fa fa-star"></i></li>
        <li class="@if($rate[0] == 'r5') active-rate-vote @endif"><i class="fa fa-star"></i></li>
    @else
        <li><a title="Clique para avaliar" class="rate_product rate_1" href="{{route('frontend-product-rate', [base64_encode(str_slug($product->id)),  base64_encode('one')])}}"><i class="fa fa-star" onmouseover="hoverRate('1');"></i></a></li>
        <li><a title="Clique para avaliar" class="rate_product rate_2" href="{{route('frontend-product-rate', [base64_encode(str_slug($product->id)),  base64_encode('two')])}}"><i class="fa fa-star" onmouseover="hoverRate('2');"></i></a></li>
        <li><a title="Clique para avaliar" class="rate_product rate_3" href="{{route('frontend-product-rate', [base64_encode(str_slug($product->id)),  base64_encode('three')])}}"><i class="fa fa-star" onmouseover="hoverRate('3');"></i></a></li>
        <li><a title="Clique para avaliar" class="rate_product rate_4" href="{{route('frontend-product-rate', [base64_encode(str_slug($product->id)),  base64_encode('fuor')])}}"><i class="fa fa-star" onmouseover="hoverRate('4');"></i></a></li>
        <li><a title="Clique para avaliar" class="rate_product rate_5" href="{{route('frontend-product-rate', [base64_encode(str_slug($product->id)),  base64_encode('five')])}}"><i class="fa fa-star" onmouseover="hoverRate('5');"></i></a></li>
    @endif
</ul>
<span>({{$product->rate->count()}} Avaliações)</span>