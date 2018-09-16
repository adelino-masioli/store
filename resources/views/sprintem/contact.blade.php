@extends('sprintem.template.app')

@section('title', 'Sobre a Sprintem')

@section('content')
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{asset('templates/sprintem')}}/styles/main_styles.css">
        <link rel="stylesheet" type="text/css" href="{{asset('templates/sprintem')}}/styles/responsive.css">
    @endpush

    @include('sprintem.partials.header') {{--include header--}}


    <!-- Contact -->
    <div class="contact_info">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="single_post_title">Sobre Nós</div>

                    <div class="contact_info_container d-flex flex-lg-row flex-column justify-content-between align-items-between">

                        <!-- Contact Item -->
                        <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                            <div class="contact_info_image"><img src="{{asset('templates/sprintem')}}/images/contact_1.png" alt=""></div>
                            <div class="contact_info_content">
                                <div class="contact_info_title">Phone</div>
                                <div class="contact_info_text">+38 068 005 3570</div>
                            </div>
                        </div>

                        <!-- Contact Item -->
                        <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                            <div class="contact_info_image"><img src="{{asset('templates/sprintem')}}/images/contact_2.png" alt=""></div>
                            <div class="contact_info_content">
                                <div class="contact_info_title">Email</div>
                                <div class="contact_info_text">fastsales@gmail.com</div>
                            </div>
                        </div>

                        <!-- Contact Item -->
                        <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                            <div class="contact_info_image"><img src="{{asset('templates/sprintem')}}/images/contact_3.png" alt=""></div>
                            <div class="contact_info_content">
                                <div class="contact_info_title">Address</div>
                                <div class="contact_info_text">10 Suffolk at Soho, London, UK</div>
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

                        <form action="#" id="contact_form">
                            <div class="contact_form_inputs d-flex flex-md-row flex-column justify-content-between align-items-between">
                                <input type="text" id="contact_form_name"  name="contact_form_name"  class="contact_form_name input_field" placeholder="Seu nome" required="required" data-error="Campo obrigatório.">
                                <input type="text" id="contact_form_email" name="contact_form_email" class="contact_form_email input_field" placeholder="Seu email" required="required" data-error="Campo obrigatório.">
                                <input type="text" id="contact_form_phone" name="contact_form_phone" class="contact_form_phone input_field" placeholder="Telefone">
                            </div>
                            <div class="contact_form_inputs">
                                <input type="text" id="contact_form_about"  name="contact_form_about"  class="input_field input_field_about" placeholder="Inform o assunto" required="required" data-error="Campo obrigatório.">
                            </div>
                            <div class="contact_form_text">
                                <textarea id="contact_form_message" name="contact_form_message" class="text_field contact_form_message" name="message" rows="4" placeholder="Informe a mensagem"></textarea>
                            </div>
                            <div class="contact_form_button">
                                <button type="submit" class="button contact_submit_button">Enviar</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>



    @include('sprintem.partials.brands') {{--include banner--}}

    @include('sprintem.partials.newsletter') {{--include newsletter--}}

    @include('sprintem.partials.footer') {{--include footer--}}

    @include('sprintem.partials.copyright') {{--include copyright--}}


@endsection