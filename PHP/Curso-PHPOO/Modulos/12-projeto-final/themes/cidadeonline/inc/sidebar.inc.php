<aside class="main-sidebar">
    <article class="ads">
        <header>
            <h1>Anúncio Patrocinado:</h1>
            <a href="http://www.upinside.com.br/campus" title="Campus UpInside - Treinamentos em TI 100% em Vídeo aulas">
                <img src="<?= INCLUDE_PATH; ?>/_tmp/banner_large.png" alt="UPINSIDE TEINAMENTOS" title="UPINSIDE TEINAMENTOS" />
            </a>
        </header>
    </article>

    <section class="widget art-list last-publish">
        <h2 class="line_title"><span class="oliva">Últimas Atualizações:</span></h2>
        <?php for ($ul = 5; $ul <= 7; $ul++): ?>
            <article>
                <div class="img">
                    <!--120x80-->
                    <img alt="" title="" src="<?= INCLUDE_PATH; ?>/_tmp/0<?= $ul; ?>.jpg" />
                </div>

                <header>
                    <h1><a href="#">Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</a></h1>
                    <time datetime="2013-11-11" pubdate><?= date('d/m/Y H:i'); ?>Hs</time>
                </header>
            </article>
        <?php endfor; ?>
    </section>

    <section class="widget art-list most-view">
        <h2 class="line_title"><span class="vermelho">Destaques:</span></h2>
        <?php for ($ul = 9; $ul >= 7; $ul--): ?>
            <article>
                <div class="img">
                    <!--120x80-->
                    <img alt="" title="" src="<?= INCLUDE_PATH; ?>/_tmp/0<?= $ul; ?>.jpg" />
                </div>

                <header>
                    <h1><a href="#">Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</a></h1>
                    <time datetime="2013-11-11" pubdate><?= date('d/m/Y H:i'); ?>Hs</time>
                </header>
            </article>
        <?php endfor; ?>
    </section>
</aside>