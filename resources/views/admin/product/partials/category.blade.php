<div class="panels">
    <ul class="list-group categories-list">
        <li class="list-group-item categories-list-header">Clique na categoria e subcategoria para ligar ao produto</li>
        @foreach($categories as $category)
            <li class="list-group-item">

                <div id="category_{{$category->id}}" onclick="selectCategory('{{$category->id}}');">
                    <span class="badge cat_status @if(in_array($category->id, $product_categories)) selected-category @endif"> @if(in_array($category->id, $product_categories))Sim @else Não @endif</span>
                    <span class="cat_name @if(in_array($category->id, $product_categories)) active-selected-category @endif ">{{$category->name}}</span>
                </div>

                @if(\App\Models\SubCategory::subcategory($category->id)->count() > 0)
                    <h4 class="title-subcategory">Subcategorias</h4>
                    <ul class="list-group subcategories-list">
                        @foreach(\App\Models\SubCategory::subcategory($category->id) as $subcategory)
                            <li class="list-group-item" id="subcategory_{{$subcategory->id}}" onclick="selectSubCategory('{{$subcategory->id}}');">
                                <i class="fa fa-arrow-right pull-left"></i> <span class="badge subcat_status @if(in_array($subcategory->id, $product_subcategories)) selected-subcategory @endif"> @if(in_array($subcategory->id, $product_subcategories))Sim @else Não @endif</span>
                                <span class="subcat_name @if(in_array($subcategory->id, $product_subcategories)) active-selected-category @endif ">{{$subcategory->name}}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif

            </li>
         @endforeach
    </ul>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.editor').summernote({
                lang: 'pt-BR',
                height: 100,
                minHeight: 100,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['paragraph']]
                ]
            });
        });

        //money
        masMoney();

        //select category
        function selectCategory(id) {
            let token = $('input[name=_token]').val()
            let caetetory_selected = '#category_'+id;
            if($(caetetory_selected + ' .cat_name').hasClass('active-selected-category')){
                $(caetetory_selected + ' .cat_name').removeClass('active-selected-category');
                $(caetetory_selected + ' .cat_status').removeClass('selected-category');
                $(caetetory_selected + ' .cat_status').text('Não');
            }else{
                $(caetetory_selected + ' .cat_name').addClass('active-selected-category');
                $(caetetory_selected + ' .cat_status').addClass('selected-category');
                $(caetetory_selected + ' .cat_status').text('Sim');
            }

            var vUrl = '{{route('product-category')}}';
            var vData = { product_id:'{{$product->id}}', category_id:id, _token:token};
            $.post(
                vUrl,
                vData,
                function(response,status){
                    toast('Importante', 'Salvo com sucesso!', 'top-right', '#2594ff')
                }
            );
        }

        //select subcategory
        function selectSubCategory(id) {
            let token = $('input[name=_token]').val()
            let subcatetory_selected = '#subcategory_'+id;
            if($(subcatetory_selected + ' .subcat_name').hasClass('active-selected-category')){
                $(subcatetory_selected + ' .subcat_name').removeClass('active-selected-category');
                $(subcatetory_selected + ' .subcat_status').removeClass('selected-subcategory');
                $(subcatetory_selected + ' .subcat_status').text('Não');
            }else{
                $(subcatetory_selected + ' .subcat_name').addClass('active-selected-category');
                $(subcatetory_selected + ' .subcat_status').addClass('selected-subcategory');
                $(subcatetory_selected + ' .subcat_status').text('Sim');
            }

            var vUrl = '{{route('product-subcategory')}}';
            var vData = { product_id:'{{$product->id}}', subcategory_id:id, _token:token};
            $.post(
                vUrl,
                vData,
                function(response,status){
                    toast('Importante', 'Salvo com sucesso!', 'top-right', '#2594ff')
                }
            );
        }
    </script>
@endpush