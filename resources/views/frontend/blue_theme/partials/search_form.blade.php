<form action="{{route('frontend-product-result')}}" method="get" class="search-form">
    <div class="input-group">
        <div class="input-group-prepend">
            <button class="btn dropdown-category dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="selected-category">Categorias</span>
            </button>
            <div class="dropdown-menu">
                @foreach($categories as $category)
                    <a class="dropdown-item" href="javascript:void(0);" onclick="selectCategory('{{$category->slug}}', '{{$category->name}}')">{{$category->name}}</a>
                @endforeach
            </div>
        </div>
        <input type="hidden" name="categoria" class="category-id">

        <input type="text" class="form-control"  name="q" placeholder="Informe sua busca" aria-describedby="basic-addon3" required autofocus>
        <div class="input-group-prepend">
            <button class="btn btn-search"><i class="fa fa-search"></i></button>
        </div>
    </div>
</form>
@push('scripts')
    <script>
        function selectCategory(category_slug, category){
            $('.selected-category').html('');
            $('.selected-category').html(category);
            $('.category-id').val('');
            $('.category-id').val(category_slug);
        }
    </script>
@endpush
