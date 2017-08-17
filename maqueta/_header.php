        <!--header start-->
        <header id="header" class="tt-nav transparent-header" >

            <div class="header-sticky light-header">

                <div class="container">

                    <div class="search-wrapper">
                        <div class="search-trigger pull-right">
                            <div class='search-btn'></div>
                            <i class="material-icons">&#xE8B6;</i>
                        </div>

                        <!-- Modal Search Form -->
                        <i class="search-close material-icons">&#xE5CD;</i>
                        <div class="search-form-wrapper">
                            <form action="#" class="white-form">
                                <div class="input-field">
                                    <input type="text" name="search" id="search">
                                    <label for="search" class="">Buscador...</label>
                                </div>
                                <button class="btn pink search-button waves-effect waves-light" type="submit"><i class="material-icons">&#xE8B6;</i></button>
                                
                            </form>
                        </div>
                    </div><!-- /.search-wrapper -->
                
                    <div id="materialize-menu" class="menuzord">

                        <!--logo start
                        <a href="index.html" class="logo-brand">
                            <img class="retina" src="assets/img/logo.png" alt=""/>
                        </a>
                        logo end-->

                        <!--mega menu start-->
                        <ul class="menuzord-menu pull-right">
                            <li><a href="index.php" <?php if($pagina == 'inicio'):?> class="current"<?php endif;?>>Inicio</a></li>

                            <li><a href="publicaciones.php" <?php if($pagina == 'publicaciones'):?> class="current"<?php endif;?>><i class="fa fa-circle" aria-hidden="true"></i>Publicaciones</a></li>

                            <li><a href="javascript:void(0)" <?php if($pagina == 'monografias'):?> class="current"<?php endif;?>><i class="fa fa-circle" aria-hidden="true" ></i>Monografías</a>
                                <ul class="dropdown">
                                    <li><a href="trabajos_grado.php" <?php if($item == 'grado'):?> class="current"<?php endif;?>>Trabajos de Grado</a></li>
                                    <li><a href="trabajos_posgrado.php" <?php if($item == 'posgrado'):?> class="current"<?php endif;?>>Trabajos de Posgrado</a></li>
                                </ul>
                            </li>

                            <li><a href="javascript:void(0)" <?php if($pagina == 'fuentes'):?> class="current"<?php endif;?>><i class="fa fa-circle" aria-hidden="true"></i>Fuentes lexicográficas</a>
                                <ul class="dropdown">
                                    <li><a href="glosario-obras-literarias.php" <?php if($item == 'glosario-obras-literarias'):?> class="current"<?php endif;?>>Glosario de obras literarias</a></li>
                                    <li><a href="vocabularios-independientes.php" <?php if($item == 'vocabularios-independientes'):?> class="current"<?php endif;?>>Vocabularios independientes</a></li>
                                    <li><a href="vocabularios-riograndenses.php" <?php if($item == 'vocabularios-riograndenses'):?> class="current"<?php endif;?>>Vocabularios riograndenses</a></li>
                                    <li><a href="vocabularios-africanos.php" <?php if($item == 'vocabularios-africanos'):?> class="current"<?php endif;?>>Vocabularios de voces de origen africano</a></li>
                                </ul>
                            </li>

                            <li><a href="javascript:void(0)" <?php if($pagina == 'documentos'):?> class="current"<?php endif;?>><i class="fa fa-circle" aria-hidden="true"></i>Documentos</a>
                                <ul class="dropdown">
                                    <li><a href="doc_SXVIII.php" <?php if($item == 'doc_SXVIII'):?> class="current"<?php endif;?>>Documentos siglo XVIII</a></li>
                                    <li><a href="doc_XIX.php" <?php if($item == 'doc_XIX'):?> class="current"<?php endif;?>>Documentos siglo XIX</a></li>
                                    <li><a href="doc_XIX_pt.php" <?php if($item == 'doc_XIX_pt'):?> class="current"<?php endif;?>>Documentos portugués siglo XIX</a></li>
                                </ul>
                            </li>

                            <li><a href="sitios-interes.php" <?php if($pagina == 'sitios-interes'):?> class="current"<?php endif;?>><i class="fa fa-circle" aria-hidden="true"></i>Sitios de interés</a></li>

                            <li><a href="otros-materiales.php" <?php if($pagina == 'otros-materiales'):?> class="current"<?php endif;?>><i class="fa fa-circle" aria-hidden="true"></i>Otros materiales</a></li>
                        </ul>
                        <!--mega menu end-->

                    </div>
                </div>
            </div>
        </header>
        <!--header end-->