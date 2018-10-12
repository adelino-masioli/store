<div class="row register-form">
    <div class="col col-xs-12 col-sm-12 col-md-12 col-lg-8 offset-lg-0" data-aos="fade-right" data-aos-delay="50" data-aos-easing="ease-in-out">
        <h1 class="customer-title">Meus dados</h1>

        <small class="text-info text-right">(*) Campos obrigatórios.</small>
        <form>
            <div class="form-group row">
                <label for="name" class="col d-sm-none d-md-block col-sm-3 col-md-3 col-lg-3 col-form-label text-right">Nome <span class="text-danger">*</span></label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="text" class="form-control" name="name"  placeholder="Nome" required autofocus>
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col d-sm-none d-md-block col-sm-3 col-md-3 col-lg-3 col-form-label text-right">Telefone <span class="text-danger">*</span></label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="text" class="form-control" name="phone"  placeholder="Telefone" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="whatsapp" class="col d-sm-none d-md-block col-sm-3 col-md-3 col-lg-3 col-form-label text-right">WhatsApp</label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="text" class="form-control" name="whatsapp" id="whatsapp" placeholder="WhatsApp">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label text-right">Email <span class="text-danger">*</span></label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="email" class="form-control" name="email"  placeholder="Email" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="email_confirmation" class="col col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label text-right">Confirme o Email <span class="text-danger">*</span></label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="email" class="form-control" name="email_confirmation" id="email_confirmation" placeholder="Confirme o Email" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label text-right">Senha <span class="text-danger">*</span></label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Senha" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="password_confirmation" class="col col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label text-right">Confirme a Senha <span class="text-danger">*</span></label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirme a Senha" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="zipcode" class="col col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label text-right">CEP <span class="text-danger">*</span></label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="text" class="form-control" name="zipcode" id="zipcode" placeholder="CEP" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="street" class="col col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label text-right">Rua</label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="text" class="form-control" name="street" id="street" placeholder="Rua">
                </div>
            </div>
            <div class="form-group row">
                <label for="number" class="col col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label text-right">Número</label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="text" class="form-control" name="number" id="number" placeholder="Número">
                </div>
            </div>
            <div class="form-group row">
                <label for="district" class="col col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label text-right">Bairro</label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="text" class="form-control" name="district" id="district" placeholder="Bairro">
                </div>
            </div>
            <div class="form-group row">
                <label for="city" class="col col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label text-right">Cidade</label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="text" class="form-control" name="city" id="city" placeholder="Cidade">
                </div>
            </div>
            <div class="form-group row">
                <label for="state" class="col col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label text-right">Estado</label>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <input type="text" class="form-control" name="state" id="state" placeholder="Estado" maxlength="2">
                </div>
            </div>


            <div class="form-group row">
                <div class="col-xs-12 col-xs-12 col-sm-12 col-md-9 col-lg-9 offset-sm-3 col-md-9 offset-md-3 col-lg-9 offset-lg-3">
                    <button class="btn btn-primary btn-flat btn-register">ATUALIZAR</button>

                    <div class="alert alert-success alert-dismissible fade show section-margin-top" role="alert">
                        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div><!-- /.row -->