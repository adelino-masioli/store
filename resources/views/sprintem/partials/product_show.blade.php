<!-- Single Product -->
<div class="single_product">
    <div class="container">
        <div class="row">

            <!-- Selected Image -->
            <div class="col-lg-6 order-lg-2 order-1">
                <div class="image_selected text-center"><img class="img-fluid" src="{{asset('catalog/'.config('app.template'))}}/{{\App\Models\ProductImage::getCoverImage($product->id)}}" alt="{{$product->name}}"></div>

                <div class="product_text"><p>{!! $product->description !!}</p></div>
            </div>

            <!-- Description -->
            <div class="col-lg-6 order-3">
                <div class="product_description">
                    <div class="product_category">Categoria: <strong class="text-uppercase">{{$category->name}}</strong></div>
                    <div class="product_name">{{$product->name}}</div>

                    <div class="order_info box-shadow">
                        <legend>SOLICITAR ORÇAMENTO</legend>
                        <form action="{{route('post-quote')}}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" id="txt_product_id_quote" name="product_name" value="{{$product->name}}">
                            <div class="form-group">
                                <label for="txt_name_quote">Nome</label>
                                <input type="text" class="form-control" id="txt_name_quote" name="name" placeholder="Informe seu nome" required="required">
                            </div>
                            <div class="form-group">
                                <label for="txt_email_quote">E-mail</label>
                                <input type="email" class="form-control" id="txt_email_quote" name="email"  placeholder="Informe seu e-mail" required="required">
                            </div>
                            <div class="form-group">
                                <label for="txt_phone_quote">Telefone</label>
                                <input type="text" class="form-control" id="txt_phone_quote" name="phone"  placeholder="Informe seu telefone" required="required">
                            </div>
                            <div class="form-group">
                                <label for="txt_about_quote">Assunto</label>
                                <input type="text" class="form-control" id="txt_about_quote"  name="about"  placeholder="Informe o assunto" required="required">
                            </div>
                            <div class="form-group">
                                <label for="txt_message_quote">Mensagem</label>
                                <textarea  class="form-control" id="txt_message_quote" name="message"  placeholder="Informe a mensagem" required="required"></textarea>
                            </div>
                            <div class="button_container">
                                <div class="row">
                                    @if($configuration['whatsapp'] != '')
                                        <div class="col-xs-12 col-md-4">
                                            <button type="submit" class="button cart_button btn-block">ENVIAR</button>
                                        </div>
                                        <div class="col-xs-12 col-md-8">
                                            <a href="https://api.whatsapp.com/send?phone={{$configuration['whatsapp']}}" target="_blank"  class="button whats_button btn-block">
                                                <img class="img-fluid" src="{{asset('templates/'.config('app.template'))}}/images/whatsapp.png" alt="WhatsApp">
                                                CONTATO PELO WHATSAPP
                                            </a>
                                        </div>
                                    @else
                                        <div class="col-xs-12 col-md-12">
                                            <button type="submit" class="button cart_button btn-block">ENVIAR</button>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    @include('sprintem.messages.messages_register_quote')
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>