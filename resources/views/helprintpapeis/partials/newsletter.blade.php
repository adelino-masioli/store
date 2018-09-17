<!-- Newsletter -->
<div class="newsletter" id="newsletter">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
                    <div class="newsletter_title_container">
                        <div class="newsletter_icon"><img src="{{asset('templates/'.config('app.template'))}}/images/send.png" alt=""></div>
                        <div class="newsletter_title">Assine nossa Newsletter</div>
                        <div class="newsletter_text"><p>...e receba novidades em seu email.</p></div>
                    </div>
                    <div class="newsletter_content clearfix">
                        <form action="{{route('post-newsletter')}}" method="post" class="newsletter_form">
                            {{ csrf_field() }}
                            <input type="text" class="newsletter_input" required="required" id="txt_name_newsletter" name="name" placeholder="Nome">
                            <input type="email" class="newsletter_input" required="required" id="txt_email_newsletter" name="email" placeholder="Email">
                            <button type="submit" class="newsletter_button">Inscrever</button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @include(config('app.template').'.messages.messages_register')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>