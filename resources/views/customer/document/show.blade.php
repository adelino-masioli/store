@extends('admin.layouts.app')

@section('content')
    @component('admin.components.contentheader')
        @slot('title')
            Documento
        @endslot
        @slot('small')
            Editando o documento: {{$document->name}}
        @endslot
        @slot('link')
            Edição de documento
        @endslot
    @endcomponent

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        @include('customer.document.partials.menu')
                    </div>

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="nav-tabs-custom">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist" id="tabs">
                                        <li role="presentation" class="active"><a href="#singletabs" aria-controls="singletabs" role="tab" data-toggle="tab">Documento</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="singletabs">
                                            @include('customer.document.partials.show')
                                        </div>
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