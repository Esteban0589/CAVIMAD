<div id="k-body"><!-- content wrapper -->
    
    <?php if($this->Session->read('Auth')['User']['role'] =='Administrador'): ?>

    <div class="container"><!-- container -->        
        <div class="row"><!-- row -->
            <div class="col-lg-12 col-md-12"><!-- doc body wrapper -->
                <h2>Panel de control</h2>
                <div class="col-lg-3 col-md-3"><!-- upcoming events wrapper -->
                    <div class="conteiner">
                        <div title="Administrar usuarios y colaboradores.">
                                <a href='users/index'>
                                    <i class="fa fa-users fa-4x"></i> Administrar usuarios
                                    
                                </a>
                        </div>
                    </div>
                    <br>
                    <div class="conteiner">
                        <div title="Modifica los eventos.">
                            <a href='events/index'>
                                 <i class="fa fa-calendar fa-4x"></i> Administrar eventos
                            </a>
                        </div>
                    </div>
                </div><!-- misc wrapper end -->
                <div class="col-lg-3 col-md-3"><!-- upcoming events wrapper -->
                    <div class="conteiner">
                        <div title="Abre el árbol taxónomico.">
                                <a href='categories/index'>
                                    <i class="fa fa-sitemap fa-4x"></i> Administrar catálogo
                                </a>
                        </div>
                    </div>
                        <br>
                    <div class="conteiner">
                        <div title="Muestra las estadística de la página.">
                                <a href='https://analytics.google.com/'>
                                    <i class="fa fa-google fa-4x"></i> Estadísticas
                                </a>
                        </div>
                    </div>
                </div><!-- misc wrapper end -->
                <div class="col-lg-3 col-md-3"><!-- recent news wrapper -->
                    <div class="conteiner">
                        <div title="Modifica las fotos del inicio.">
                                <a href='home_pictures'>
                                    <i class="fa fa-picture-o fa-4x"></i>  Administrar fotos de portada
                                </a>
                        </div>
                    </div>
                    <br>
                    <div class="conteiner">
                        <div title="Abre la bitácora de CAVIMAD.">
                                <a href='logbooks'>
                                   <i class="fa fa-book fa-4x"></i> Bitácora
                                </a>
                        </div>
                    </div>
                </div><!-- misc wrapper end -->
                <div class="col-lg-3 col-md-3"><!-- recent news wrapper -->
                    <div class="conteiner">
                        <div title="Editar las noticias.">
                                <a href='news/index'>
                                    Administrar noticias
                                </a>
                        </div>
                    </div>
                    <br>
                    <div class="conteiner">
                        <div title="Editar noticias.">
                            <a href='https://www.youtube.com/watch?v=Wc5vPDaOmhI'>
                                El misterio del link
                            </a>
                        </div>
                    </div>
                </div><!-- misc wrapper end -->
            </div>
            <br>
        </div>
    </div>
    <br>
    <?php endif; ?>
	<?php if($this->Session->read('Auth')['User']['role']!='Administrador'): ?>
        	<div class="alert alert-warning alert-dismissable">
            	<p><strong>Upps!</strong> No puedes acceder a esta página.</p>
       		</div>
   	<?php endif; ?>     
    
    
</div>
<br>
                