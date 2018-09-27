@extends('admin.layouts.app')

@push('styles')
    <link href="{{ asset('plugins/summernote/dist/summernote.css') }}" rel="stylesheet">
@endpush
@section('content')
    @component('admin.components.contentheader')
        @slot('title')
            Produto
        @endslot
        @slot('small')
            Editando o produto: {{$product->name}}
        @endslot
        @slot('link')
            Edição de produto
        @endslot
    @endcomponent

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        @include('admin.product.partials.menu')
                    </div>

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                @include('admin.messages.messages_register')
                            </div>


                            <div class="col-md-12">
                                <div class="nav-tabs-custom">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist" id="tabs">
                                        <li role="presentation" class="active"><a href="#product" aria-controls="product" role="tab" data-toggle="tab">Produto</a></li>
                                        <li role="presentation"><a href="#category" aria-controls="category" role="tab" data-toggle="tab">Categorias</a></li>
                                        <li role="presentation"><a href="#images" aria-controls="images" role="tab" data-toggle="tab">Imagens</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="product">
                                            <form action="{{route('product-update')}}" method="post" class="panels" id="formsubmit">
                                                <input type="hidden" name="id" value="{{$product->id}}">
                                                @include('admin.product.partials.form')
                                            </form>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="category">@include('admin.product.partials.category')</div>
                                        <div role="tabpanel" class="tab-pane" id="images">@include('admin.product.partials.image')</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


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
    </script>
@endpush
