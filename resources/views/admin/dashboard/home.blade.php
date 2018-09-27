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
        @include('admin.dashboard.partials.datatablelastquotes')
        @include('admin.dashboard.partials.datatablelastcontacts')
    </div>

    <div class="row">
        @include('admin.dashboard.partials.datatablelastdocuments')
    </div>
</section>




@endsection
@push('scripts')

@endpush
