@extends('sprintem.template.app')

@section('title', 'Sobre a Sprintem')

@section('content')
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{asset('templates/sprintem')}}/styles/main_styles.css">
        <link rel="stylesheet" type="text/css" href="{{asset('templates/sprintem')}}/styles/responsive.css">
    @endpush

    @include('sprintem.partials.header') {{--include header--}}


    <!-- About -->

    <div class="single_post">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="single_post_title">Sobre Nós</div>
                    <div class="single_post_text">
                        <p>Fundada em janeiro 2000. Atuamos no comércio de peças de reposição usadas para veículos utilitários, buscando sempre a satisfação do cliente com ótimo custo benefício e qualidade, além de oferecermos atendimento personalizado.</p>

                        <p><strong>Missão</strong></p>
                        <p>Oferecer produtos de qualidade, garantia de procedência, eficiência no atendimento e pronta entrega, visando assim um rápido retorno dos veículos a circulação e a satisfação de nossos clientes.</p>

                        <p><strong>Objetivos</strong></p>
                        <p>Ser reconhecida em nível Nacional, como a maior fornecedora de produtos para reposição em veículos utilitários e realizar o completo atendimento de toda a demanda nesse segmento no Brasil.</p>


                        <p><strong>Ética</strong></p>
                        <p>Compromisso com as normas vigentes e com a integridade em todos os negócios em que atuamos.</p>

                        <p><strong>Comprometimento</strong></p>
                        <p>Atenção total, as necessidades de todos os nossos clientes.</p>
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