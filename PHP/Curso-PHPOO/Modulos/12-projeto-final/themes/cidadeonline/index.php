<!--HOME SLIDER-->
<section class="main-slider">
    <h3>Últimas Atualizações:</h3>
    <div class="container">

        <div class="slidecount">
            <?php for ($sl = 1; $sl <= 3; $sl++): ?>
                <article>
                    <div class="img slide_img">
                        <!--460x230-->
                        <img alt="" title="" src="<?=INCLUDE_PATH;?>/_tmp/0<?= $sl; ?>.jpg" />                                
                    </div>

                    <header>
                        <h1><a href="<?=BASE?>/artigo/nome_do_artigo"><?= $sl; ?> Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</a></h1>
                        <time datetime="2013-11-11" pubdate><?= date('d/m/Y H:i'); ?>Hs</time>
                        <p class="tagline">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                    </header>
                </article>
            <?php endfor; ?>                
        </div>

        <div class="slidenav"></div>   
    </div><!-- Container Slide -->

</section><!-- /slider -->


<!--HOME CONTENT-->
<div class="site-container">

    <section class="main-destaques">
        <h2>Destaques:</h2>

        <section class="main_lastnews">
            <h1 class="line_title"><span class="oliva">Últimas Notícias:</span></h1>

            <article class="one_news">
                <div class="img">
                    <!--268x185-->
                    <img alt="" title="" src="<?=INCLUDE_PATH;?>/_tmp/04.jpg" /> 
                </div>

                <header>
                    <h1><a href="<?=BASE?>/artigo/nome_do_artigo">Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</a></h1>
                    <time datetime="2013-11-11" pubdate><?= date('d/m/Y H:i'); ?>Hs</time>
                    <p class="tagline">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                </header>

            </article>

            <div class="last_news">
                <?php for ($ul = 5; $ul <= 8; $ul++): ?>
                    <article>
                        <div class="img">
                            <!--120x80-->
                            <img alt="" title="" src="<?=INCLUDE_PATH;?>/_tmp/0<?= $ul; ?>.jpg" />
                        </div>

                        <header>
                            <h1><a href="<?=BASE?>/artigo/nome_do_artigo">Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</a></h1>
                            <time datetime="2013-11-11" pubdate><?= date('d/m/Y H:i'); ?>Hs</time>
                        </header>
                    </article>
                <?php endfor; ?>
            </div>


            <nav class="guia_comercial">
                <h1>Guia de Empresas:</h1>
                <ul class="navitem">
                    <li id="comer" class="azul tabactive">Onde Comer</li>
                    <li id="ficar">Onde Ficar</li>
                    <li id="comprar" class="verde">Onde Comprar</li>
                    <li id="divertir" class="roxo">Onde se Divertir</li>
                </ul>

                <div class="tab comer">
                    <?php for ($com = 1; $com <= 4; $com++): ?>
                        <article>
                            <!--120x60-->
                            <h1>
                                Locais para comer: NOME DA EMPRESA
                                <a href="<?=BASE?>/empresa/nome_da_empresa" title="UPINSIDE TECNOLOGIA" class="img">
                                    <img alt="UPINSIDE TECNOLOGIA" title="UPINSIDE TECNOLOGIA" src="<?=INCLUDE_PATH;?>/_tmp/emp0<?= $com; ?>.png" />
                                </a>
                            </h1>
                        </article>
                    <?php endfor; ?>
                </div>

                <div class="tab ficar none">
                    <?php for ($com = 4; $com >= 1; $com--): ?>
                        <article>
                            <!--120x60-->
                            <h1>
                                Locais para dormir: NOME DA EMPRESA
                                <a href="URL" title="UPINSIDE TECNOLOGIA" class="img">
                                    <img alt="UPINSIDE TECNOLOGIA" title="UPINSIDE TECNOLOGIA" src="<?=INCLUDE_PATH;?>/_tmp/emp0<?= $com; ?>.png" />
                                </a>
                            </h1>
                        </article>
                    <?php endfor; ?>
                </div>

                <div class="tab comprar none">
                    <?php for ($com = 1; $com <= 4; $com++): ?>
                        <article>
                            <!--120x60-->
                            <h1>
                                Locais para comprar: NOME DA EMPRESA
                                <a href="URL" title="UPINSIDE TECNOLOGIA" class="img">
                                    <img alt="UPINSIDE TECNOLOGIA" title="UPINSIDE TECNOLOGIA" src="<?=INCLUDE_PATH;?>/_tmp/emp0<?= $com; ?>.png" />
                                </a>
                            </h1>
                        </article>
                    <?php endfor; ?>
                </div>

                <div class="tab divertir none">
                    <?php for ($com = 4; $com >= 1; $com--): ?>
                        <article>
                            <!--120x60-->
                            <h1>
                                Locais para sair: NOME DA EMPRESA
                                <a href="URL" title="UPINSIDE TECNOLOGIA" class="img">
                                    <img alt="UPINSIDE TECNOLOGIA" title="UPINSIDE TECNOLOGIA" src="<?=INCLUDE_PATH;?>/_tmp/emp0<?= $com; ?>.png" />
                                </a>
                            </h1>
                        </article>
                    <?php endfor; ?>
                </div>                        
            </nav>
        </section><!--  last news -->


        <aside>
            <div class="aside-banner">
                <!--300x250-->
                <a href="http://www.upinside.com.br/campus" title="Campus UpInside - Cursos Profissionais em TI">
                    <img src="<?=INCLUDE_PATH;?>/_tmp/banner_large.png" title="Campus UpInside - Cursos Profissionais em TI" alt="Campus UpInside - Cursos Profissionais em TI" />
                </a>
            </div>

            <h1 class="line_title"><span class="vermelho">Destaques:</span></h1>

            <?php for ($ul = 7; $ul >= 5; $ul--): ?>
                <article>
                    <div class="img">
                        <!--120x80-->
                        <img alt="" title="" src="<?=INCLUDE_PATH;?>/_tmp/0<?= $ul; ?>.jpg" />
                    </div>

                    <header>
                        <h1><a href="#"><?= $sl; ?> Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</a></h1>
                        <time datetime="2013-11-11" pubdate><?= date('d/m/Y H:i'); ?>Hs</time>
                    </header>
                </article>
            <?php endfor; ?>
        </aside>               

    </section><!-- destaques -->


    <section class="last_forcat">

        <h1>Por categoria!</h1>

        <section class="eventos">
            <h2 class="line_title"><span class="roxo">Eventos:</span></h2>

            <article class="one_news">
                <div class="img">
                    <!--268x185-->
                    <img alt="" title="" src="<?=INCLUDE_PATH;?>/_tmp/10.jpg" />
                </div>

                <header>
                    <h1><a href="#"><?= $sl; ?> Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</a></h1>
                    <time datetime="2013-11-11" pubdate><?= date('d/m/Y H:i'); ?>Hs</time>
                    <p class="tagline">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                </header>
            </article>

            <div class="last_news">
                <?php for ($sl = 6; $sl >= 5; $sl--): ?>
                    <article>
                        <div class="img slide_img">
                            <!--120x80-->
                            <img alt="" title="" src="<?=INCLUDE_PATH;?>/_tmp/0<?= $sl; ?>.jpg" />
                        </div>

                        <header>
                            <h1><a href="#"><?= $sl; ?> Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</a></h1>
                            <time datetime="2013-11-11" pubdate><?= date('d/m/Y H:i'); ?>Hs</time>
                        </header>
                    </article>
                <?php endfor; ?>
            </div>
        </section>


        <section class="esportes">
            <h2 class="line_title"><span class="verde">Esportes:</span></h2>

            <article class="one_news">
                <div class="img slide_img">
                    <!--268x185-->
                    <img alt="" title="" src="<?=INCLUDE_PATH;?>/_tmp/11.jpg" />
                </div>

                <header>
                    <h1><a href="#"><?= $sl; ?> Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</a></h1>
                    <time datetime="2013-11-11" pubdate><?= date('d/m/Y H:i'); ?>Hs</time>
                    <p class="tagline">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                </header>
            </article>

            <div class="last_news">
                <?php for ($sl = 8; $sl <= 9; $sl++): ?>
                    <article>
                        <div class="img slide_img">
                            <!--120x80-->
                            <img alt="" title="" src="<?=INCLUDE_PATH;?>/_tmp/0<?= $sl; ?>.jpg" />
                        </div>

                        <header>
                            <h1><a href="#"><?= $sl; ?> Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</a></h1>
                            <time datetime="2013-11-11" pubdate><?= date('d/m/Y H:i'); ?>Hs</time>
                        </header>
                    </article>
                <?php endfor; ?>
            </div>
        </section>


        <section class="baladas">
            <h2 class="line_title"><span class="azul">Baladas:</span></h2>

            <article class="one_news">
                <div class="img slide_img">
                    <!--268x185-->
                    <img alt="" title="" src="<?=INCLUDE_PATH;?>/_tmp/12.jpg" />
                </div>

                <header>
                    <h1><a href="#"><?= $sl; ?> Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</a></h1>
                    <time datetime="2013-11-11" pubdate><?= date('d/m/Y H:i'); ?>Hs</time>
                    <p class="tagline">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                </header>
            </article>

            <div class="last_news">
                <?php for ($sl = 5; $sl <= 6; $sl++): ?>
                    <article>
                        <div class="img slide_img">
                            <!--120x80-->
                            <img alt="" title="" src="<?=INCLUDE_PATH;?>/_tmp/0<?= $sl; ?>.jpg" />
                        </div>

                        <header>
                            <h1><a href="#"><?= $sl; ?> Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</a></h1>
                            <time datetime="2013-11-11" pubdate><?= date('d/m/Y H:i'); ?>Hs</time>
                        </header>
                    </article>
                <?php endfor; ?>
            </div>
        </section>

    </section><!-- categorias -->
    <div class="clear"></div>
</div><!--/ site container -->