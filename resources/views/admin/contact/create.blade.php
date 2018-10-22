@extends('admin.layouts.app')

@push('styles')
@endpush
@section('content')
    @component('admin.components.contentheader')
        @slot('title')
            Contato
        @endslot
        @slot('small')
            Novo contato
        @endslot
        @slot('link')
            Novo  contato
        @endslot
    @endcomponent

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        @include('admin.contact.partials.menu')
                    </div>

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                @include('admin.messages.messages_register')
                            </div>


                            <div class="col-xs-12 col-md-3">

                                <form action="{{route('contact-store')}}" method="post" id="formsubmit">
                                    @include('admin.contact.partials.form')
                                </form>

                            </div>

                            <div class="col-xs-12 col-md-9">
                                <!-- Custom Tabs -->
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab_note" data-toggle="tab"><i class="fa fa-pencil"></i> Anotações</a></li>
                                        <li><a href="#tab_attachment" data-toggle="tab"><i class="fa fa-paperclip"></i> Arquivos</a></li>
                                        <li><a href="#tab_quote" data-toggle="tab"><i class="fa fa-dollar"></i> Orçamentos</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_note">
                                            @if(isset($contact))
                                                @include('admin.contact.partials.form_note')
                                            @else
                                                <p class="text-center"><i class="fa fa-exclamation-triangle"></i> Aguardando criar o contato.</p>
                                            @endif
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="tab_attachment">2</div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="tab_quote">3</div>
                                        <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.tab-content -->
                                </div>
                                <!-- nav-tabs-custom -->
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection