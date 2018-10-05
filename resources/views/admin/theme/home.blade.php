@extends('admin.layouts.app')

@push('styles')
@endpush
@section('content')
    @component('admin.components.contentheader')
        @slot('title')
            Temas e templates
        @endslot
        @slot('small')
            Selecione o seu tema
        @endslot
        @slot('link')
            Temas
        @endslot
    @endcomponent

    <section class="content">
        <div class="row">
            <!-- /.col -->


            @foreach($themes as $theme)
            <div class="col-md-3">
                <!-- Widget: user widget style 1 -->
                <div class="box box-widget widget-user" style="min-height: 300px;">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-black" style="background: url('{{url('/')}}/templates/{{$theme->slug}}/{{$theme->image}}') center center;">
                        <h3 class="widget-user-username">{{$theme->name}}</h3>
                        <h5 class="widget-user-desc">{{$theme->status->status}}</h5>
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-12 border-right">
                                <div class="description-block">
                                    <span class="description-text">{{$theme->description}}</span>

                                    @if($config_site->theme_id == $theme->id)
                                        <p style="margin-top: 9px;"><span  class="badge bg-info">Tema selecionado</span></p>
                                    @else
                                        <p style="margin-top: 9px;"><a href="{{route('theme-update', [base64_encode($config_site->id), base64_encode($theme->id)])}}" class="btn bg-green">Selecionar tema</a></p>
                                    @endif
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
            <!-- /.col -->
            @endforeach

        </div>
    </section>


@endsection
@push('scripts')
    <script>
    </script>
@endpush
