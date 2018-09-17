@extends(config('app.template').'.template.app')

@section('title', 'Sobre a Sprintem')

@section('content')
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{asset('templates/'.config('app.template'))}}/styles/main_styles.css">
        <link rel="stylesheet" type="text/css" href="{{asset('templates/'.config('app.template'))}}/styles/responsive.css">
    @endpush

    @include(config('app.template').'.partials.header') {{--include header--}}


    <!-- Contact -->
    <div class="contact_info">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="single_post_title">Fale conosco</div>

                    <div class="contact_info_container d-flex flex-lg-row flex-column justify-content-between align-items-between">

                        <!-- Contact Item -->
                        <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                            <div class="contact_info_image"><img src="{{asset('templates/'.config('app.template'))}}/images/contact_1.png" alt=""></div>
                            <div class="contact_info_content">
                                <div class="contact_info_title">Telefone</div>
                                <div class="contact_info_text">{{$configuration['phone']}}</div>
                            </div>
                        </div>

                        <!-- Contact Item -->
                        <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                            <div class="contact_info_image"><img src="{{asset('templates/'.config('app.template'))}}/images/contact_2.png" alt=""></div>
                            <div class="contact_info_content">
                                <div class="contact_info_title">Email</div>
                                <div class="contact_info_text">{{$configuration['email']}}</div>
                            </div>
                        </div>

                        <!-- Contact Item -->
                        <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                            <div class="contact_info_image"><img src="{{asset('templates/'.config('app.template'))}}/images/contact_3.png" alt=""></div>
                            <div class="contact_info_content">
                                <div class="contact_info_title">Endereço</div>
                                <div class="contact_info_text">{{$configuration['address']}}</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Form -->

    <div class="contact_form">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="contact_form_container">
                        <div class="contact_form_title">Favor preencher o formulário</div>

                        <form action="{{route('post-contact')}}" method="post" id="contact_form">
                            {{ csrf_field() }}
                            <div class="contact_form_inputs d-flex flex-md-row flex-column justify-content-between align-items-between">
                                <input type="text" id="contact_form_name"  name="name"  class="contact_form_name input_field" placeholder="Seu nome" required="required" data-error="Campo obrigatório.">
                                <input type="text" id="contact_form_email" name="email" class="contact_form_email input_field" placeholder="Seu email" required="required" data-error="Campo obrigatório.">
                                <input type="text" id="contact_form_phone" name="phone" class="contact_form_phone input_field" placeholder="Telefone">
                            </div>
                            <div class="contact_form_inputs">
                                <input type="text" id="contact_form_about"  name="about"  class="input_field input_field_about" placeholder="Inform o assunto" required="required" data-error="Campo obrigatório.">
                            </div>
                            <div class="contact_form_text">
                                <textarea id="contact_form_message" name="message" class="text_field contact_form_message" name="message" rows="4" placeholder="Informe a mensagem"></textarea>
                            </div>
                            <div class="contact_form_button">
                                <button type="submit" class="button contact_submit_button">Enviar</button>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    @include(config('app.template').'.messages.messages_register_contact')
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>



    @include(config('app.template').'.partials.brands') {{--include banner--}}

    @include(config('app.template').'.partials.newsletter') {{--include newsletter--}}

    @include(config('app.template').'.partials.footer') {{--include footer--}}

    @include(config('app.template').'.partials.copyright') {{--include copyright--}}


@endsection