<!DOCTYPE html>
<html>
    <body>
        
        <div id="k-body"><!-- content wrapper -->
        
        	<div class="container"><!-- Contenedor-->
                
                <h1>CAVIMAD<small><div style="color: #3891d6; font-size: larger;"> <font color="#82b204">Ca</font>tálogo <font color="#82b204">Vi</font>rtual sobre <font color="#82b204">Ma</font>croinvertebrados <font color="#82b204">D</font>ulceacuícolas de América Central</div></small></h1>
                <p class="call-out" align="justify">
                Este catálogo fue creado por investigadores que trabajan con Macroinvertebrados Dulceacuícolas con el fin de proporcionar información sobre la taxonomía, ecología, biología y distribución de los diferentes órdenes, familias y géneros de este grupo de organismos en la región centroamericana.
                </p>
                
                <div class="row no-gutter fullwidth"><!-- row -->
                
                    <div class="col-lg-12 clearfix"><!-- featured posts slider -->
                    
                        <div id="carousel-featured" class="carousel slide" data-interval="4000" data-ride="carousel"><!-- featured posts slider wrapper; auto-slide -->
                        
                         
                        
                            <div class="carousel-inner"><!-- Wrapper for slides -->
                            
                            
                            
                                <!--<div class="item active">-->
                                <!--    <img src="img/img5.jpg" alt="Image slide 5" />-->
                                <!--    <div class="k-carousel-caption pos-c-2-3 scheme-dark no-bg">-->
                                <!--    	<div class="caption-content">-->
                                <!--            <h5 class="caption-title title-giant">CAVIMAD</h5>-->
                                <!--            <p>-->
                                <!--            	Catálogo Virtual sobre Macroinvertebrados Dulceacuícolas de Centroamérica -->
                                <!--            </p>-->
                                            
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->
                            
                                 <?php 
                                 $y=true;
                                 $i=0;
                                 foreach ($imagenesPortada as $imagen):
                                 ?>
                                 <?php if($y){?>
                                    <div class="item active">
                                 <?php $y=false; 
                                 } else { ?>
                                     <div class="item">
                                 <?php } ?>
                                    
                                         <?php echo $this->Html->image('../files/home_picture/image/'.$imagen['HomePicture']['image_dir'] . '/' .$imagen['HomePicture']['image'], array('style'=>'height: 404px; width: 100%;'));  ?>
                                        
                                        <div 
                                            <?php
                                                if ($imagen['HomePicture']['position'] == 1){
                                                echo "class=\"k-carousel-caption pos-1-3-right scheme-dark\"";
                                                }elseif ($imagen['HomePicture']['position'] == 2){
                                                    echo "class=\"k-carousel-caption pos-1-3-left scheme-light\"";
                                                }else{  echo "style=\"display: none;\"";}?>
                                        >
                                        	<div class="caption-content">
                                                <h5 class="caption-title"> <?php echo $imagen['HomePicture']['title']?> </h5>
                                                <p>
                                                	<?php echo $imagen['HomePicture']['description']?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                 <?php  endforeach; ?>
                                
                            </div><!-- Wrapper for slides end -->
                        
                            <!-- Controls -->
                            <a class="left carousel-control" href="#carousel-featured" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
                            <a class="right carousel-control" href="#carousel-featured" data-slide="next"><i class="fa fa-chevron-right"></i></a>
                            <!-- Controls end -->
                            
                        </div><!-- featured posts slider wrapper end -->
                            
                    </div><!-- featured posts slider end -->
                    
                </div><!-- row end -->
                
                <div class="row no-gutter"><!-- row -->
                    
                    <div class="col-lg-4 col-md-4"><!-- upcoming events wrapper -->
                    	
                        <div class="col-padded col-shaded"><!-- inner custom column -->
                        
                        	<ul class="list-unstyled clear-margins"><!-- widgets -->
                            
                            	<li class="widget-container widget_up_events"><!-- widgets list -->
                        
                                      <h1 class="page-title"> <?php echo $this->Html->link( "Eventos", array('controller'=>'events','action' => 'index'),array('style'=>'color: #3897dc;','title'=>'Ver todos los eventos'));?>
                                    </h1>
                                    
                                     <div class="up-event-wrapper"><!-- event summary -->
                        
                                            <h1 class="title-median">   <?php echo $this->Html->link($lastEventCreated['Event']['title'], array('controller'=>'events','action' => 'view', $lastEventCreated['Event']['id']), array('title'=>'Ver detalles de la evento'));?>
                                          </h1>
                        
                                        <div class="up-event-meta clearfix">
                                            <div class="up-event-date">
                                                <?php echo h($lastEventCreated['Event']['modified']);?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                        <div id="carousel-featured3" class="carousel slide" data-interval="4000" data-ride="carousel"><!-- featured posts slider wrapper; auto-slide -->

                               				<div class="carousel-inner"><!-- Wrapper for slides -->
                                              <?php
                                                	if(count($picsEventsFinal)==0){?>
                                                		<div class="thumbnail"> 
                    										<?php echo $this->Html->image('../files/news_events_picture/events.png'); ?>
                    									</div>
                                              <?php }else{
            			                         $y=true;
            			                         for($i=0; $i<count($picsEventsFinal); $i++){?>
            				                         <?php if($y){?>
            				                            <div class="item active">
            				                         <?php $y=false; 
            				                         } else { ?>
            				                             <div class="item">
            				                         <?php } ?>
            				                            <?php
            				                            if((!empty('../files/news_events_picture/image/' . $picsEventsFinal[$i]['image_dir']))){?>
            				                          	  <div class="thumbnail"> 
            				                            	 <?php echo $this->Html->image('../files/news_events_picture/image/' . $picsEventsFinal[$i]['image_dir'].'/'.$picsEventsFinal[$i]['image'], array('style'=>'height: 150px; width: 100%;')); ?>
            				                           		</div>
            				                          	<?php }	else{ ?>
            												<div class="thumbnail"> 
            													<?php echo $this->Html->image('../files/news_events_picture/events.png'); ?>
            												</div>
            				                           	<?php  } ?>	
            				                            </div>
            			                     <?php } }?>
            			                     
                                        </div><!-- Wrapper for slides end -->
                                    
                                        <!-- Controls -->
                                        <a class="left carousel-control" href="#carousel-featured3" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
                                        <a class="right carousel-control" href="#carousel-featured3" data-slide="next"><i class="fa fa-chevron-right"></i></a>
                                        <!-- Controls end -->
                                        
                                    </div><!-- featured posts slider wrapper end -->
                                    <div class="call-out" align="justify">
                                         <?php echo $lastEventCreated['Event']['description'];
                                         echo $this->Html->link(__('...mas'), array('controller'=>'events','action' => 'view', $lastEventCreated['Event']['id']), array('title'=>'Ver detalles del evento'));?>
                                    </div>     

                                </li><!-- widgets list end -->
                            
                            </ul><!-- widgets end -->
                        
                        </div><!-- inner custom column end -->
                        
                    </div><!-- upcoming events wrapper end -->
                    
                    <div class="col-lg-4 col-md-4"><!-- recent news wrapper -->
                    	
                        <div class="col-padded"><!-- inner custom column -->
                        
                            <ul class="list-unstyled clear-margins"><!-- widgets -->
                            
                            	<li class="widget-container widget_recent_news"><!-- widgets list -->
                        
                                     <h1 class="page-title"> <?php echo $this->Html->link( "Noticias Recientes", array('controller'=>'news','action' => 'index'),array('style'=>'color: #3897dc;','title'=>'Ver todas las noticias'));?>
                                     </h1>
                                    
                               
                                      
                                    
                                    <div class="up-event-wrapper"><!-- event summary -->
                        
                                            <h1 class="title-median">   <?php echo $this->Html->link( $lastNewsCreated['News']['title'], array('controller'=>'news','action' => 'view', $lastNewsCreated['News']['id']), array('title'=>'Ver detalles de la noticia'));?>
                                          </h1>
                        
                                        <div class="up-event-meta clearfix">
                                            <div class="up-event-date">
                                                <?php echo h($lastNewsCreated['News']['modified']);?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                          <div id="carousel-featured2" class="carousel slide" data-interval="4000" data-ride="carousel"><!-- featured posts slider wrapper; auto-slide -->

                               				<div class="carousel-inner"><!-- Wrapper for slides -->
                                               <?php
                                                	if(count($picsNewsFinal)==0){?>
                                                		<div class="thumbnail"> 
                    										<?php echo $this->Html->image('../files/news_events_picture/noticias.jpeg'); ?>
                    									</div>
                                              <?php }else{
            			                         $y=true;
            			                         for($i=0; $i<count($picsNewsFinal); $i++){?>
            				                         <?php if($y){?>
            				                            <div class="item active">
            				                         <?php $y=false; 
            				                         } else { ?>
            				                             <div class="item">
            				                         <?php } ?>
            				                            <?php
            				                            if((!empty('../files/news_events_picture/image/' . $picsNewsFinal[$i]['image_dir']))){?>
            				                          	  <div class="thumbnail"> 
            				                            	 <?php echo $this->Html->image('../files/news_events_picture/image/' . $picsNewsFinal[$i]['image_dir'].'/'.$picsNewsFinal[$i]['image'], array('style'=>'height: 150px; width: 100%;')); ?>
            				                           		</div>
            				                          	<?php }	else{ ?>
            												<div class="thumbnail"> 
            													<?php echo $this->Html->image('../files/news_events_picture/noticias.jpeg'); ?>
            												</div>
            				                           	<?php  } ?>	
            				                            </div>
            			                     <?php } }?>
            			                     
                                        </div><!-- Wrapper for slides end -->
                                    
                                        <!-- Controls -->
                                        <a class="left carousel-control" href="#carousel-featured2" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
                                        <a class="right carousel-control" href="#carousel-featured2" data-slide="next"><i class="fa fa-chevron-right"></i></a>
                                        <!-- Controls end -->
                                        
                                    </div><!-- featured posts slider wrapper end -->
                                    <div class="call-out" align="justify">
                                         <?php echo $lastNewsCreated['News']['description'];
                                         echo $this->Html->link(__('...mas'), array('controller'=>'news','action' => 'view', $lastNewsCreated['News']['id']), array('title'=>'Ver detalles de la noticia'));?>
                                    </div>
                                        
                                </li><!-- widgets list end -->
                            
                            </ul><!-- widgets end -->
                        
                        </div><!-- inner custom column end -->
                        
                    </div><!-- recent news wrapper end -->
                    
                    <div class="col-lg-4 col-md-4"><!-- misc wrapper -->
                    	
                        <div class="col-padded col-shaded"><!-- inner custom column -->
                        
                            <ul class="list-unstyled clear-margins"><!-- widgets -->
                            
                            	<li class="widget-container widget_course_search"><!-- widget -->
                                
                                	<h1 class="title-titan">Búsqueda</h1>
                                    
                                     <form action="categories/buscar" id="course-finder" method="get" role="Ingrese el nombre de taxón que desea buscar">
                        
                                       <div title = "Búsqueda general sobre el catálogo"><input type="text" name="Buscar" id="sitesearch" class="form-control" autocomplete="off" placeholder="Ingrese el nombre del taxón que desea buscar" />
                                             <span class="input-group-btn"><button type="submit" class="btn btn-default">BUSCAR!</button></span>
                                           </div>     
                                    </form>

                                
                                    <br>
                                <a href="/categories/advanced_search2" title="Continuar para realizar una búsqueda con mayor profundidad">Búsqueda Avanzada</a>
                                
                                </li><!-- widget end -->
                                <div title = "Ingrese con su usuario"></div>
                    </div>
                                <li class="widget-container widget_text"><!-- widget -->
                                	<a href="/users/add" class="custom-button cb-green" title="Click para registrarse a la comunidad">
                                    	<i class="custom-button-icon fa fa-check-square-o"></i>
                                        <span class="custom-button-wrap">
                                        	<span class="custom-button-title">Registrarse</span>
                                            <span class="custom-button-tagline">Únase a la comunidad cuando lo desee.</span>
                                        </span>
                                        <em></em> 
                                    </a></li>
                                <li><a href='/users/login' class="custom-button cb-gray" title="Ingrese con su usuario y contraseña">
                                    	<i class="custom-button-icon fa  fa-play-circle-o"></i>
                                        <span class="custom-button-wrap">
                                        	<span class="custom-button-title">Iniciar Sesión</span>
                                            <span class="custom-button-tagline">Estamos felices con su regreso.</span>
                                        </span>
                                        <em></em>
                                </li></a>
                                <li><a href="users/contact" class="custom-button cb-yellow" title="Contáctese con nosotros">
                                    	<i class="custom-button-icon fa  fa-leaf"></i>
                                        <span class="custom-button-wrap">
                                        	<span class="custom-button-title">Contacto</span>
                                            <span class="custom-button-tagline">Contáctenos para tener mayor información.</span>
                                        </span>
                                        <em></em>
                                </li></a>
                            </ul><!-- widgets end -->
                        
                        </div><!-- inner custom column end -->
                        
                    </div><!-- misc wrapper end -->
                
                </div><!-- row end -->
            <br>
            <br>
            <br>
            </div><!-- container end -->
        
        </div><!-- content wrapper end -->
    </body>
</html>
