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
    @include('customer.dashboard.partials.box')

    <div class="row">
        @include('customer.dashboard.partials.approval')
        @include('customer.dashboard.partials.several')
    </div>

    <div class="row">
        @include('customer.dashboard.partials.financial')
        @include('customer.dashboard.partials.support')
    </div>
</section>




@endsection
@push('scripts')

@endpush
