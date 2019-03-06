</div>
<script src="./assets/js/jquery.js"></script>
<script src="./assets/plugins/jquery-ui/jquery-ui.js"></script>
<script src="./assets/js/scripts.js"></script>

<script type="text/javascript">
    (function () {
        var options = {
            whatsapp: "+5543984880241", // Número do WhatsApp
            // company_logo_url:"", // URL com o logo da empresa
            greeting_message: "Olá Seja bem Vindo Ao Sistema De Cadastro da Suporte Informátika, o que podemos lhe ajudar?", // Texto principal
            call_to_action: " Esta Com Dúvidas? Clique Aqui.", // Chamada para ação
            position: "right", // Posição do widget na página 'right' ou 'left'
        };
        var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
        var s = document.createElement('script');
        s.type = 'text/javascript';
        s.async = true;
        s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () {
            WhWidgetSendButton.init(host, proto, options);
        };
        var x = document.getElementsByTagName('script')[0];
        x.parentNode.insertBefore(s, x);
    })();
</script>
</body>
</html>