    {{ csrf_field() }}
    <div class="row">
        @if(isset($status))
            <div class="col-md-12">
                <div class="form-group">
                    <label for="status_id">Status</label>
                    <select class="form-control select2" id="status_id" name="status_id" style="width: 100%;">
                        @foreach($status as $status)
                            <option @if(isset($contact)) @if($contact->status_id == $status->id) selected @endif @endif value="{{$status->id}}">{{$status->status}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
        <div class="col-md-12">
            <div class="form-group">
                <label for="name">Nome completo</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Nome completo" value="@if(isset($contact)){{$contact->name}}@else{{old('name')}}@endif">
            </div>
        </div>
    </div>

    <div class="row">
        @if(isset($contact->phones))
            <?php $i=0; ?>
            @foreach ($contact->phones as $phone)
                <div class="col-xs-12 col-md-5 email_{{$phone->id}}">
                    <div class="form-group">
                        <label for="type">Tipo</label>
                        <select class="form-control select2" id="type" name="type[]" style="width: 100%;">
                            <option @if($phone->type == 'Fixo') selected @endif value="Fixo">Fixo</option>
                            <option @if($phone->type == 'Ramal') selected @endif value="Ramal">Ramal</option>
                            <option @if($phone->type == 'Celular') selected @endif value="Celular">Celular</option>
                            <option @if($phone->type == 'WhatsApp') selected @endif value="WhatsApp">WhatsApp</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-md-7 email_{{$phone->id}}">
                    <div class="form-group">
                        <label for="phone">Telefone</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="phone[]" id="phone" placeholder="Telefone" onkeypress="maskCellphone('#phone');" value="@if(isset($phone)){{$phone->phone}}@endif">
                            <div class="input-group-btn">
                                @if($i==0)
                                    <button class="btn btn-outline-secondary btn-flat" type="button" onclick="addPhone();"><i class="fa fa-plus-circle"></i></button>
                                @else
                                    <button class="btn bg-red btn-flat" type="button" onclick="removeRow('.email_{{$phone->id}}');"><i class="fa fa-trash"></i></button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            <?php $i++; ?>
            @endforeach
        @else
            <div class="col-xs-12 col-md-5">
                <div class="form-group">
                    <label for="type">Tipo</label>
                    <select class="form-control select2" id="type" name="type[]" style="width: 100%;">
                        <option value="Fixo">Fixo</option>
                        <option value="Ramal">Ramal</option>
                        <option value="Celular">Celular</option>
                        <option value="WhatsApp">WhatsApp</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-md-7">
                <div class="form-group">
                    <label for="phone">Telefone</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="phone[]" id="phone" placeholder="Telefone" onkeypress="maskCellphone('#phone');">
                        <div class="input-group-btn">
                            <button class="btn btn-outline-secondary btn-flat" type="button" onclick="addPhone();"><i class="fa fa-plus-circle"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="wrapper-phone"></div>
    </div>

    <div class="row">
        @if(isset($contact->emails))
            <?php $i=0; ?>
            @foreach ($contact->emails as $email)
                <div class="col-xs-12 col-md-12" id="email_{{$email->id}}">
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <div class="input-group">
                            <input type="email" class="form-control" name="email[]" id="email" placeholder="E-mail" value="@if(isset($email)){{$email->email}}@endif">
                            <div class="input-group-btn">
                                @if($i==0)
                                    <button class="btn btn-outline-secondary btn-flat" type="button" onclick="addEmail();"><i class="fa fa-plus-circle"></i></button>
                                @else
                                    <button class="btn bg-red btn-flat" type="button" onclick="removeRow('#email_{{$email->id}}');"><i class="fa fa-trash"></i></button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
             <?php $i++; ?>
            @endforeach
        @else
            <div class="col-xs-12 col-md-12">
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <div class="input-group">
                        <input type="email" class="form-control" name="email[]" id="email" placeholder="E-mail">
                        <div class="input-group-btn">
                            <button class="btn btn-outline-secondary btn-flat" type="button" onclick="addEmail();"><i class="fa fa-plus-circle"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="wrapper-email"></div>
    </div>

    @include('admin.contact.partials.form_company')



@push('scripts')
    <script>
        function removeRow(div) {
            $(div).remove();
        }

        function addPhone(){
            var fields = '<div class="col-xs-12 col-md-5">\n' +
                '            <div class="form-group">\n' +
                '                <label for="type">Tipo</label>\n' +
                '                <select class="form-control select2" id="type" name="type[]" style="width: 100%;">\n' +
                '                    <option value="Fixo">Fixo</option>\n' +
                '                    <option value="Ramal">Ramal</option>\n' +
                '                    <option value="Celular">Celular</option>\n' +
                '                    <option value="WhatsApp">WhatsApp</option>\n' +
                '                </select>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="col-xs-12 col-md-7">\n' +
                '            <div class="form-group">\n' +
                '                <label for="phone">Telefone</label>\n' +
                '                <div class="input-group">\n' +
                '                    <input type="text" class="form-control the_phone" name="phone[]" id="phone" placeholder="Telefone" onkeypress="maskCellphone(\'.the_phone\');">\n' +
                '                    <div class="input-group-btn">\n' +
                '                        <button class="btn bg-red btn-flat remove-button-phone" type="button"><i class="fa fa-trash"></i></button>\n' +
                '                    </div>\n' +
                '                </div>\n' +
                '            </div>\n' +
                '        </div>';

            $('.wrapper-phone').append('<div class="wrapper-phone-div">'+fields+'</div>');
        }

        $( document ).delegate(".remove-button-phone", "click", function(e) {
            e.preventDefault();
            $(this).parent().parent().parent().parent().parent('.wrapper-phone-div').remove();
        });


        function addEmail() {
            var fields_email = '<div class="col-xs-12 col-md-12">\n' +
                '            <div class="form-group">\n' +
                '                <label for="email">E-mail</label>\n' +
                '                <div class="input-group">\n' +
                '                    <input type="email" class="form-control" name="email[]" id="email" placeholder="E-mail">\n' +
                '                    <div class="input-group-btn">\n' +
                '                        <button class="btn bg-red btn-flat remove-button-email" type="button"><i class="fa fa-trash"></i></button>\n' +
                '                    </div>\n' +
                '                </div>\n' +
                '            </div>\n' +
                '        </div>';

            $('.wrapper-email').append('<div class="wrapper-email-div">'+fields_email+'</div>');
        }

        $( document ).delegate(".remove-button-email", "click", function(e) {
            e.preventDefault();
            $(this).parent().parent().parent().parent().parent('.wrapper-email-div').remove();
        });
    </script>
@endpush