@extends('layouts.app')

@push('styles')
    <link href="{{ asset('plugins/summernote/dist/summernote.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Editando o produto: <strong>{{$product->name}}</strong></div>

                <div class="panel-body">
                    <div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#product" aria-controls="product" role="tab" data-toggle="tab">Produto</a></li>
                            <li role="presentation"><a href="#category" aria-controls="category" role="tab" data-toggle="tab">Categorias</a></li>
                            <li role="presentation"><a href="#images" aria-controls="images" role="tab" data-toggle="tab">Imagens</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="product">@include('admin.product.partials.form')</div>
                            <div role="tabpanel" class="tab-pane" id="category">@include('admin.product.partials.category')</div>
                            <div role="tabpanel" class="tab-pane" id="images">@include('admin.product.partials.image')</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="{{ asset('plugins/summernote/dist/summernote.min.js') }}"></script>
    <script src="{{ asset('plugins/summernote/dist/lang/summernote-pt-BR.min.js') }}"></script>
    <script src="{{ asset('plugins/mask/jquery.mask.min.js') }}"></script>

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

            //money
            $('.money').mask('#.##0,00', {reverse: true});
        });

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

            var vUrl = '{{url('product-category')}}';
            var vData = { product_id:'{{$product->id}}', category_id:id, _token:token};
            $.post(
                vUrl,
                vData,
                function(response,status){
                    console.log('Ok');
                }
            );
        }
    </script>
@endpush
