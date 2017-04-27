<!--HOME CONTENT-->
<div class="site-container">

    <section class="page_categorias">
        <header class="cat_header">
            <h2>NOME DA CATEGORIA</h2>
            <p class="tagline">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
        </header>

        <?php for ($cat = 1; $cat <= 12; $cat++): ?>
            <article<?php if ($cat % 3 == 0) echo ' class="right"' ?>>
                <div class="img">
                    <!--268x185-->
                    <a href="#">
                        <img alt="" title="" src="<?= INCLUDE_PATH; ?>/_tmp/04.jpg" />
                    </a>
                </div>

                <header>
                    <h1><a href="#">Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</a></h1>
                    <time datetime="2013-11-11" pubdate><?= date('d/m/Y H:i'); ?>Hs</time>
                </header>
            </article>
        <?php endfor; ?>

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

    </section>

    <div class="clear"></div>
</div><!--/ site container -->