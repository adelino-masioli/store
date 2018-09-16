<!-- Single Product -->
<div class="single_product">
    <div class="container">
        <div class="row">

            <!-- Selected Image -->
            <div class="col-lg-6 order-lg-2 order-1">
                <div class="image_selected text-center"><img class="img-fluid" src="{{asset('catalog/sprintem')}}/{{\App\Models\ProductImage::getCoverImage($product->id)}}" alt="{{$product->name}}"></div>

                <div class="product_text"><p>{!! $product->description !!}</p></div>
            </div>

            <!-- Description -->
            <div class="col-lg-6 order-3">
                <div class="product_description">
                    <div class="product_category">Categoria: <strong class="text-uppercase">{{$category->name}}</strong></div>
                    <div class="product_name">{{$product->name}}</div>

                    <div class="order_info box-shadow">
                        <legend>SOLICITAR ORÇAMENTO</legend>
                        <form action="#">
                            <input type="hidden" id="txt_product_id_quote" name="txt_product_id_quote" value="{{$product->id}}">
                            <div class="form-group">
                                <label for="txt_name_quote">Nome</label>
                                <input type="text" class="form-control" id="txt_name_quote" name="txt_name_quote" placeholder="Informe seu nome">
                            </div>
                            <div class="form-group">
                                <label for="txt_email_quote">E-mail</label>
                                <input type="email" class="form-control" id="txt_email_quote" name="txt_email_quote"  placeholder="Informe seu e-mail">
                            </div>
                            <div class="form-group">
                                <label for="txt_about_quote">Assunto</label>
                                <input type="email" class="form-control" id="txt_about_quote"  name="txt_about_quote"  placeholder="Informe o assunto">
                            </div>
                            <div class="form-group">
                                <label for="txt_message_quote">Mensagem</label>
                                <textarea  class="form-control" id="txt_message_quote" name="txt_message_quote"  placeholder="Informe o assunto"></textarea>
                            </div>
                            <div class="button_container">
                                <div class="row">
                                    <div class="col-xs-12 col-md-4">
                                        <button type="submit" class="button cart_button btn-block">ENVIAR</button>
                                    </div>
                                    <div class="col-xs-12 col-md-8">
                                        <button type="button" class="button whats_button btn-block">
                                            <img class="img-fluid" src="{{asset('templates/sprintem')}}/images/whatsapp.png" alt="WhatsApp">
                                            CONTATO PELO WHATSAPP
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>