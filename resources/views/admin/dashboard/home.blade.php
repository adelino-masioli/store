@extends('admin.layouts.app')

@section('content')

@component('admin.components.contentheader')
    @slot('title')
        Dashboard
    @endslot
    @slot('small')
        Acessos rápidos
    @endslot
    @slot('link')
        Dashboard
    @endslot
@endcomponent

<section class="content">
    @include('admin.dashboard.partials.box')

    <div class="row">
        @include('admin.dashboard.partials.datatablelastcontacts')
        @include('admin.dashboard.partials.datatablelastbudgets')
        @include('admin.dashboard.partials.datatablelastorders')
    </div>
</section>




@endsection
@push('scripts')

@endpush
