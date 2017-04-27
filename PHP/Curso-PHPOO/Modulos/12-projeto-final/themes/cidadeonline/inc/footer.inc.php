<footer class="main-footer">
    <section class="container">                
        <nav>
            <h3 class="line_title"><span>Categorias:</span></h3>
            <ul>
                <li><a href="http://www.upinside.com.br/campus" title="Home">Conheça o curso</a></li>
                <li><a href="<?= BASE ?>/cadastra-empresa" title="Home">Cadastre Sua Empresa</a></li>
                <li><a href="http://www.facebook.com/upinside" target="_blank" title="Home">UpInside No Facebook</a></li>
                <li><a href="<?= BASE ?>" title="Home">Voltar ao início</a></li>
            </ul>
        </nav>

        <section>
            <h3 class="line_title"><span>Um resumo:</span></h3>
            <p>Este site foi desenvolvido no curso de PHP Orientado a Objetos da UPINSIDE TREINAMENTOS.</p>
            <p>O mesmo utiliza toda técnologia semântica do HTML5 e foi criado com as últimas técnologias disponíveis.</p>
            <p><a href="http://www.upinside.com.br/campus" title="Campus UpInside">Clique aqui e conheça o curso!</a></p>
        </section>

        <section class="footer_contact">
            <h3 class="line_title"><span>Contato:</span></h3>
            <form name="FormContato" action="" method="post">
                <label>
                    <span>nome:</span>
                    <input type="text" title="Informe seu nome" name="nome" required />
                </label>

                <label>
                    <span>e-mail:</span>
                    <input type="email" title="Informe seu e-mail" name="email" required />
                </label>

                <label>
                    <span>mensagem:</span>
                    <textarea title="Envie sua mensagem" required rows="3"></textarea>
                </label>

                <input type="submit" value="Enviar" class="btn">                        
            </form>
        </section>
        <div class="clear"></div>
    </section><!-- /ontainer -->

    <div class="footer_logo">Cidade Online - Eventos, Promoções e Novidades!</div><!-- footer logo -->
</footer>