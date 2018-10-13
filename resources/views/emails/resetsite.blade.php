@include('emails.partial.footer')
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f1f1f1">
    <tr>
        <td>
            <table class="container" width="600" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr><td><p></p></td></tr>
                <tr><!-- modulo row pre-header -->
                    <td valign="top" class="preheader" bgcolor="#7ebdc9">

                        <table cellspacing="0" cellpadding="10" border="0" width="100%" align="center" class="width100p">
                            <tr>
                                <td valign="center" align="center"
                                    style="font-family: Arial, Helvetica, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-align: center;">
                                    ALTERAR SENHA
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr><!-- fim modulo row pre-header -->
                <tr><!-- modulo row logo -->
                    <td valign="top" class="logo" bgcolor="#ffffff" style="" height="60" align="center">
                        <table align="center" border="0" cellpadding="20" cellspacing="0">
                            <tr>
                                <td>
                                    <a href="https://www.manazer.com" target="_blank" style="text-decoration: none;" title="">
                                        <img src="{{ url('/assets/images/brand.ng') }}" alt="" border="0" style="border:none; display: block;">
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr><!-- fim modulo row logo -->
                <tr><!-- modulo row box cta -->
                    <td valign="top" align="center" class="main-content" bgcolor="#ffffff">
                        <table cellspacing="0" cellpadding="30" border="0" style="width: 100%;">

                            <tr>
                                <td>
                                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="" style="border-spacing:0;border-collapse:collapse">
                                        <tbody>

                                        <!--dados do cliente!-->
                                        <tr>
                                            <td colspan="4" align="center" class="h2" style="padding: 5px 0 0 0; font-family: Arial,Helvetica, sans-serif; line-height: 14px; font-size: 14px;">
                                                <h3>Olá {{ $user->name }}</h3>
                                                <h3>você solicitou a alteração de sua senha ;)</h3>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="font-family: Arial,Helvetica, sans-serif; line-height: 14px; font-size: 14px;">
                                                <p>Caso não foi você, favor desconsiderar este email acessar sua conta e alterar a senha por motivos de segurança.</p>
                                                <p>Se foi uma solicitação sua, clique <a href="{{route('frontend-register-activate', [$user->active_token])}}">aqui</a> para fazer modificar sua credencial segura.</p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                        </table>
                    </td>
                </tr><!-- fim modulo row fim box cta -->


                <tr><!-- modulo row rodape -->
                    <td valign="top" bgcolor="#7ebdc9" class="rodape">


                        <table class="rodape-telefone" width="100%" align="center" border="0" cellpadding="10"
                               cellspacing="0" class="width100p">
                            <tr>
                                <td valign="top" align="center" style="color: #ffffff; font-family: Arial,Helvetica, sans-serif; line-height: 14px; font-size: 14px;">
                                    WhatsApp: (31) 99809-5410
                                </td>
                            </tr>
                        </table>

                        <table cellspacing="0" cellpadding="10" border="0" width="100%" align="left" class="width100p">
                            <tr>
                                <td valign="center" style="text-align: center; font-family: Arial, Helvetica, sans-serif;font-size: 12px; line-height: 12px;color: #ffffff;">
                                    <p>Dúvidas ou sugestões, envie email para contato@manazer.com.br</p>
                                    <p style="font-size: 12px">Respeitamos sua privacidade e somos contra o spam na rede. <br/> Consulte nossa política de privacidade para mais informações.</p>
                                </td>
                            </tr>

                            <tr>
                                <td valign="center" style="text-align: center; font-family: Arial, Helvetica, sans-serif;font-size: 12px; line-height: 12px;color: #ffffff;">
                                    &copy; {{ date('Y') }} - manažer
                                </td>
                            </tr>

                            <tr>
                                <td valign="center" style="text-align: center; font-family: Arial, Helvetica, sans-serif;font-size: 12px; line-height: 12px;color: #ffffff;">
                                    Atenção: Esta é uma mensagem automática, não é necessário respondê-la.
                                </td>
                            </tr>


                        </table>

                    </td>
                </tr><!-- fim modulo row rodape -->
                <tr><td><p></p></td></tr>
            </table>
        </td>
    </tr>
</table>
@include('emails.partial.footer')