<!--HOME CONTENT-->
<div class="site-container">

    <section class="page_empresas">
        <header class="emp_header">
            <h2>ONDE COMER</h2>
            <p class="tagline">Conheça as empresas cadastradas no ramo de alimentos e veja onde comer em sua cidade! Encontra restaurantes, pizzarias, lancherias e muito mais!</p>
        </header>

        <?php for ($cat = 1; $cat <= 5; $cat++): ?>
            <article>
                <!--120x60-->
                <header>
                    <div class="img">
                        <img alt="UPINSIDE TECNOLOGIA" title="UPINSIDE TECNOLOGIA" src="<?= INCLUDE_PATH ?>/_tmp/emla_<?= $cat ?>.png" />
                    </div>
                    <hgroup>
                        <h1>UpInside Tecnologia</h1>
                        <h2>Treinamentos Profissionais em TI</h2>
                    </hgroup>
                </header>

                <address>Em: Soledade/RS</address>
                <a class="btn" href="<?= BASE ?>/empresa/nome_da_empresa" title="Ver detalhes de NOME_DA_EMPRESA">Ver Detalhes</a>
            </article>
        <?php endfor; ?>

        <footer>
            <nav class="paginator">
                <h2>Mais resultados para NOME DA CATEGORIA</h2>
                <ul>
                    <li><a href="">Primeira</a></li>
                    <li><a href="">1</a></li>
                    <li><a href="">2</a></li>
                    <li><span class="atv">3</span></li>
                    <li><a href="">4</a></li>
                    <li><a href="">5</a></li>
                    <li><a href="">Última</a></li>
                </ul>
            </nav>
        </footer>

    </section>

    <!--SIDEBAR-->
    <?php require(REQUIRE_PATH . '/inc/sidebar.inc.php'); ?>

    <div class="clear"></div>
</div><!--/ site container -->