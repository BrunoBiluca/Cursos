<!--HOME CONTENT-->
<div class="site-container">

    <article class="page_article">


        <div class="art_content">

            <!--CABEÇALHO GERAL-->
            <header>
                <hgroup>
                    <h1>Este é o titulo do meu artigo na Cidade Online</h1>
                    <div class="img capa">
                        <!--w = 578px  [ CRIAR THUMB ]-->
                        <img src="<?= INCLUDE_PATH ?>/_tmp/13.jpg" width="578" alt="" title="">
                    </div>
                    <time datetime="2013-11-12" pubdate>Enviada em: <?= date('d/m/Y H:i'); ?>Hs</time>
                </hgroup>
            </header>


            <!--CONTEUDO-->
            <div class="htmlchars">
                <h2>Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed laoreet, sapien eu bibendum pellentesque, mi neque sodales mi, in tristique sapien enim sit amet massa. In vulputate sollicitudin velit nec lobortis</p>
                <p>Fusce ullamcorper, nulla nec viverra pharetra, velit mauris volutpat magna, sed dapibus leo ipsum at lorem.</p>

                <h3>Índice de artigo:</h3>

                <img src="<?= INCLUDE_PATH ?>/_tmp/13.jpg" width="1024" height="724" alt="" title="">
                <pre>Sed laoreet, sapien eu bibendum pellentesque, mi neque sodales mi, in tristique sapien enim sit amet massa</pre>

                <p>Fusce ullamcorper, nulla nec viverra pharetra, velit mauris volutpat magna, sed dapibus leo ipsum at lorem. Sed tincidunt elementum ipsum ut mollis</p>
                <h4>Avelit mauris volutpat magna, sed dapibus leo ipsum at lorem.</h4>
                <p>Lorem ipsum dolor sit amet, <a href="#">consectetur adipiscing elit</a>. Sed laoreet, sapien eu bibendum pellentesque, mi neque sodales mi, in tristique sapien enim sit amet massa. In vulputate sollicitudin velit nec lobortis</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed laoreet, sapien eu bibendum pellentesque, mi neque sodales mi, in tristique sapien enim sit amet massa. In vulputate sollicitudin velit nec lobortis. Sed ullamcorper elit quis lacinia elementum. Nulla facilisi.</p>

                <h3>Veja o vídeo:</h3>
                <iframe width="960" height="720" src="//www.youtube.com/embed/gcs5PRxEXq4" frameborder="0" allowfullscreen></iframe>

                <blockquote>velit mauris volutpat magna, sed dapibus leo ipsum at lorem, sapien eu bibendum pellentesque, mi neque sodales mi, in tristique</blockquote>
                <p>Morbi eget arcu sed erat feugiat ullamcorper. Fusce id purus vitae enim euismod suscipit. Morbi et lorem blandit, dapibus lacus nec, adipiscing ipsum!</p>

                <!--GALERIA-->
                <section class="gallery">
                    <hgroup>
                        <h3>
                            GALERIA:
                            <p class="tagline">Veja fotos em <mark>Este é o titulo do meu artigo na Cidade Online</mark></p>
                        </h3>
                    </hgroup>

                    <ul>
                        <?php for ($gb = 9; $gb >= 5; $gb--): ?>
                            <li>
                                <div class="img">
                                    <a href="<?= INCLUDE_PATH; ?>/_tmp/0<?= $gb; ?>.jpg" rel="shadowbox[thispost]" title="">
                                        <img src="<?= INCLUDE_PATH; ?>/_tmp/0<?= $gb; ?>.jpg" alt="" title="">
                                    </a>
                                </div>
                            </li>
                        <?php endfor; ?>

                        <?php for ($gb = 6; $gb <= 9; $gb++): ?>
                            <li>
                                <div class="img">
                                    <a href="<?= INCLUDE_PATH; ?>/_tmp/0<?= $gb; ?>.jpg" rel="shadowbox[thispost]" title="">
                                        <img src="<?= INCLUDE_PATH; ?>/_tmp/0<?= $gb; ?>.jpg" alt="" title="">
                                    </a>
                                </div>
                            </li>
                        <?php endfor; ?>
                    </ul>
                    <div class="clear"></div>
                </section>
            </div>

            <!--RELACIONADOS-->
            <footer>
                <nav>
                    <h3>Veja também:</h3>
                    <article>
                        <div class="img">
                            <!--268x165-->
                            <img alt="" title="" src="<?= INCLUDE_PATH; ?>/_tmp/12.jpg" />
                        </div>

                        <header>
                            <h1><a href="<?= BASE ?>/artigo/nome_do_artigo">Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</a></h1>
                            <time datetime="2013-11-11" pubdate><?= date('d/m/Y H:i'); ?>Hs</time>
                        </header>
                    </article>

                    <article>
                        <div class="img">
                            <!--120x80-->
                            <img alt="" title="" src="<?= INCLUDE_PATH; ?>/_tmp/10.jpg" />
                        </div>

                        <header>
                            <h1><a href="<?= BASE ?>/artigo/nome_do_artigo">Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</a></h1>
                            <time datetime="2013-11-11" pubdate><?= date('d/m/Y H:i'); ?>Hs</time>
                        </header>
                    </article>
                </nav>
                <div class="clear"></div>
            </footer>


            <!--Comentários aqui-->

        </div><!--art content-->

        <!--SIDEBAR-->
        <?php require(REQUIRE_PATH . '/inc/sidebar.inc.php'); ?>

        <div class="clear"></div>
    </article>

    <div class="clear"></div>
</div><!--/ site container -->