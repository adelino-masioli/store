<!-- row -->
    <div class="row">
        <div class="col-md-12">
            <!-- The time line -->
            <ul class="timeline">

                <!-- first timeline time label -->
                <li class="time-label">
                  <span class="bg-green">
                    {{date_only_br($support->created_at)}}
                  </span>
                </li>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <li>
                    <i class="fa fa-envelope bg-green-active"></i>

                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> {{date_br($support->created_at)}}</span>

                        <h3 class="timeline-header">{{$support->title}}</h3>

                        <div class="timeline-body">
                            {!! $support->description !!}
                        </div>
                        @if($support->file)
                            <div class="timeline-footer">
                                <a href="{{route('customer-support-download', base64_encode($support->file))}}" class="btn btn-default btn-xs btn-flat"><i class="fa fa-download"></i> Baixar arquivo</a>
                            </div>
                        @endif
                    </div>
                </li>
                <!-- END first timeline item -->


                @if($support_answers->count() > 0)
                    @foreach($support_answers as $support_answer)
                        <!-- timeline item -->
                        <li>
                            @if($support_answer->user_id == Auth::user()->id)
                                <i class="fa fa-comment-o bg-gray"></i>
                            @else
                                <i class="fa fa-comment-o bg-aqua"></i>
                            @endif

                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> {{date_br($support_answer->created_at)}}</span>

                                <h3 class="timeline-header">{{$support_answer->name}}</h3>

                                <div class="timeline-body">{!! $support_answer->description !!}</div>
                                @if($support_answer->file)
                                <div class="timeline-footer">
                                    <a href="{{route('customer-support-download', base64_encode($support_answer->file))}}" class="btn btn-default btn-xs btn-flat"><i class="fa fa-download"></i> Baixar arquivo</a>
                                </div>
                                @endif
                            </div>
                        </li>
                        <!-- END timeline item -->
                    @endforeach
                @endif


                <li>
                    <i class="fa fa-comment-o bg-gray"></i>
                </li>
            </ul>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->


   @if($support->status_id != statusOrder('closed'))
    <div class="row no-print" style="margin-top: 30px;">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h2 class="page-header">
                    <i class="fa fa-comment"></i> Responda no formulário abaixo
                </h2>
            </div>

            <form action="{{route('customer-support-answer')}}" method="post" class="panels" id="formsubmit" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="support_id" value="{{$support->id}}">
            <input type="hidden" name="id" value="{{Auth::user()->id}}">
            <input type="hidden" name="name" value="{{Auth::user()->name}}">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">Resposta<span class="text-danger">*</span></label>
                        <textarea class="form-control editor" id="description" name="description" placeholder="Descrição" required></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Arquivo[JPG,JPEG,PNG,PDF,DOC,DOCX]</label>
                        <input type='file' id="image" name="file"  class="filestyle" data-btnClass="btn-default"  data-text="Selecionar arquivo"/>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-flat pull-right bg-green" style="margin-right: 5px;">
               Responder
            </button>
            </form>
        </div>
    </div>
    @endif


