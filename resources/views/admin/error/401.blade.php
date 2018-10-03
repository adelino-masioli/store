@extends('admin.layouts.app')

@section('content')

    @component('admin.components.contentheader')
        @slot('title')
            Permissões
        @endslot
        @slot('small')
            Permissão negada
        @endslot
        @slot('link')
            Dashboard
        @endslot
    @endcomponent

    <section class="content text-center">
        <div class="error-page">
            <h2 class="headline text-red">401</h2>

            <div class="error-content">
                <h3><i class="fa fa-warning text-red"></i> Oops! Permissões insuficientes.</h3>

                <p class="text-center">Parece que você não pode acessar esta página ou executar o comando solicitado.</p>
                <p class="text-center">Clique <a href="{{route('dashboard')}}" class="text-red">aqui</a> para voltar para o dashboard, ou entre em contato com o administrador do sistema.</p>

            </div>
        </div>
        <!-- /.error-page -->
    </section>




@endsection
@push('scripts')

@endpush
