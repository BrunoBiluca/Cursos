<!--HOME CONTENT-->
<div class="site-container">

    <article class="empresa_article">

        <div class="emp_content">

            <!--CABEÇALHO GERAL-->
            <header>
                <div class="img capa">
                    <!--w = 578px  [ CRIAR THUMB ]-->
                    <img src="<?= INCLUDE_PATH ?>/_tmp/emp_large.png" width="578" alt="" title="">
                </div>

                <hgroup>
                    <div class="views"><span>1247</span></div>
                    <h1>UpInside Tecnologia</h1>
                    <h2>Treinamentos Profissionais em TI</h2>
                </hgroup>
            </header>

            <address>
                Empresa de TI e treinamentos, atua no mercado desde 2006 e tem os melhores treinamentos em TI do mercado EAD. Conheça nossos treinamentos e aprenda de verdade!                   
            </address>

            <h3 class="uicon site"><a href="http://www.upinside.com.br/campus" target="_blank" rel="nofollow">Visite nosso site</a></h3>
            <h3 class="uicon face"><a href="http://www.facebook.com/upinside" target="_blank" rel="nofollow">Upinside Treinamentos no Facebook</a></h3>
            <h3 class="uicon share"><a onclick="return !window.open(this.href, 'Facebook', 'width=640,height=300')" href="https://www.facebook.com/sharer/sharer.php?u=<?= BASE ?>/empresa/upinside-tecnologia" target="_blank" rel="nofollow">Compartilhe Isso</a></h3>

<!--<iframe width="578" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com.br/maps?q=ENDERECO&amp;ie=UTF8&amp;hq=&amp;hnear=ENDERECO&amp;t=m&amp;z=16&amp;ll=&amp;hl=pt-BR&amp;iwloc=A&amp;output=embed" style="text-align:left; margin-top: 20px;"></iframe>-->

            <div class="clear"></div>
        </div>

        <!--RELACIONADOS-->
        <footer>
            <nav>
                <h3>Veja também:</h3>
                <?php for ($emp = 1; $emp <= 4; $emp++): ?>
                    <article>
                        <!--120x60-->
                        <h1>
                            Locais para comer: NOME DA EMPRESA
                            <a href="<?= BASE ?>/empresa/nome_da_empresa" title="UPINSIDE TECNOLOGIA" class="img">
                                <img alt="UPINSIDE TECNOLOGIA" title="UPINSIDE TECNOLOGIA" src="<?= INCLUDE_PATH; ?>/_tmp/emp0<?= $emp; ?>.png" />
                            </a>
                        </h1>
                    </article>
                <?php endfor; ?>
            </nav>
            <div class="clear"></div>
        </footer>

        <!--Comentários aqui-->
    </article>
    <!--SIDEBAR-->

    <?php require(REQUIRE_PATH . '/inc/sidebar.inc.php'); ?>

    <div class="clear"></div>
</div><!--/ site container -->