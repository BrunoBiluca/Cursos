<header class="main-header">
    <div class="container">
        <hgroup>
            <h1>Cidade Online - Eventos, Promoções e Novidades!</h1>
            <h2>Confira os eventos, promoções e novidades em sua cidade. Aqui, no Cidade Online!</h2>
        </hgroup>

        <div class="header-banner">
            <!--468x60-->
            <a href="http://www.upinside.com.br/campus" title="Campus UpInside - Cursos Profissionais em TI">
                <img src="<?= INCLUDE_PATH; ?>/_tmp/banner_medium.png" title="Campus UpInside - Cursos Profissionais em TI" alt="Campus UpInside - Cursos Profissionais em TI" />
            </a>
        </div><!-- banner -->

        <nav class="main-nav">

            <ul class="top">
                <li><a href="<?= BASE ?>" title="">Home</a></li>
                <li><a href="<?= BASE ?>/categoria/noticias" title="">Cidade Online</a>
                    <ul class="sub">
                        <li><a href="<?= BASE ?>/categoria/eventos" title="">Eventos</a></li> 
                        <li><a href="<?= BASE ?>/categoria/esportes" title="">Esportes</a></li> 
                        <li><a href="<?= BASE ?>/categoria/baladas" title="">Baladas</a></li> 
                    </ul>                
                </li>
                <li><a href="<?= BASE ?>/empresas/onde-comer" title="">Onde Comer</a></li>
                <li><a href="<?= BASE ?>/empresas/onde-ficar" title="">Onde Ficar</a></li>
                <li><a href="<?= BASE ?>/empresas/onde-comprar" title="">Onde Comprar</a></li>
                <li><a href="<?= BASE ?>/empresas/onde-se-divertir" title="">Onde Se Divertir</a></li>

                <li class="search">
                    <form name="search" action="" method="post">
                        <input class="fls" type="text" name="s" />
                        <input class="btn" type="submit" name="sendsearch" value="" />
                    </form>
                </li>

            </ul>
        </nav> <!-- main nav -->
        
    </div><!-- Container Header -->
</header> <!-- main header -->