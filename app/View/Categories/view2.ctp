<style>
/*363636 - 3891D4 - 860000*/
a{
    color: #363636;
}

.glyphicon-pencil:hover {
    color: #3891D4;
    font-size:25px; 
    padding: 5px;
}
.glyphicon-trash:hover {
    color: #860000;
    font-size:25px; 
    padding: 5px;
}
h5   {margin: 0px;}
.texto{margin-bottom: 15px;
	
	
	
	
	
}

</style>


<div class="container" >
	<div class="row">
			<div class="page-header">
			<div class="col col-sm-12" style=" padding-left: 0px;">
				<!--<div class="col col-sm-7">-->
					<h2 style="margin: 0px;"> 
						
						<?php if($category['Category']['classification']=='Genero'){?>	
						<h2 style="margin: 0px;"><em> <?php echo $category['Category']['name']; ?> </em></h2>
						<?php	} else { ?>
							<h2 style="margin: 0px;"> <?php echo $category['Category']['name']; ?>	</h2>
						<?php	} ?>
						
					</h2>
					<br>
				<!--</div>-->
				
				<?php if($this->Session->read('Auth')['User']['role']=='Administrador'): ?>
				<!--<div class="col col-sm-5">-->
					<h5 style="margin: 0px;"> Edición de Taxón	
					
					<?php echo $this->Html->link(__(''), array('action' => 'edit', $category['Category']['id'], 'alias'=>$alias), array('class' => 'glyphicon glyphicon-pencil','title' =>'Editar el taxón', 'style'=>'color: #82B204;    font-size:25px;     padding: 5px;')); ?>
	
		            <?php echo $this->Form->postLink(__(''), array('action' => 'delete', $category['Category']['id'], 'alias'=>$alias), array('class' => 'glyphicon glyphicon-trash', 'title' =>"Eliminar el taxón",'style'=>'color: #860000;    font-size:25px;     padding: 5px;'), __('Está seguro de que desea eliminar # %s?', $category['Category']['name'])); ?>

					</h5>
	
				<!--</div>-->
	
				<?php endif; ?>

			</div>
			
			
			<div class="row">
				<!--Compo contenedor de imagen y mapa-->
				<div class="col col-sm-5">
				            <div id="carousel-featured" class="carousel slide" data-interval="4000" data-ride="carousel"><!-- featured posts slider wrapper; auto-slide -->

                   		<div class="carousel-inner"><!-- Wrapper for slides -->
                                 <?php
                            	if(count($pics3)==0){?>
                            		<div class="thumbnail"> 
										<?php echo $this->Html->image('../files/picture/default.PNG'); ?>
									</div>
                            	<?php }else{
		                         $y=true;
		                         for($i=0; $i<count($pics3); $i++){?>
			                         <?php if($y){?>
			                            <div class="item active">
			                         <?php $y=false; 
			                         } else { ?>
			                             <div class="item">
			                         <?php } ?>
			                            <?php
			                            if((!empty('../files/picture/image/' . $pics3[$i]['Picture']['image_dir']))){?>
			                          	  <div class="thumbnail"> 
			                            	 <?php echo $this->Html->image('../files/picture/image/' . $pics3[$i]['Picture']['image_dir'].'/'.$pics3[$i]['Picture']['image'], array('style'=>'height: 200px; width: 100%;')); ?>
			                           		</div>
			                          	<?php }	else{ ?>
											<div class="thumbnail"> 
												<?php echo $this->Html->image('../files/picture/default.PNG'); ?>
											</div>
			                           	<?php  } ?>	
			                            </div>
		                     <?php } }?>
			                     
                            </div><!-- Wrapper for slides end -->
                        
                            <!-- Controls -->
                            <a class="left carousel-control" href="#carousel-featured" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
                            <a class="right carousel-control" href="#carousel-featured" data-slide="next"><i class="fa fa-chevron-right"></i></a>
                            <!-- Controls end -->
                            
                        </div><!-- featured posts slider wrapper end -->
                        
					<!--Campo para el mapa-->
					<?php if($category['Category']['classification']=='Familia' ||$category['Category']['classification']=='Genero'){?>
						<div class="row">
						Mapa de ubicación
				<div class = "container" style = "width: 100%">
					 <meta charset='utf-8' />
					    <title></title>
					    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
					    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.18.0/mapbox-gl.js'></script>
					    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.18.0/mapbox-gl.css' rel='stylesheet' />
					    <style>
					    .mapbox-improve-map{
					            display: none;
					    }
					    </style>
					<div id='map'style='width: 100%; height: 200px;'></div>
					<script>
					mapboxgl.accessToken = 'pk.eyJ1IjoiamltZSIsImEiOiJjaXAzN2VpMzEwMDBibGdtM3Vlb2k1anUxIn0.zCvEQPOBMWFDf1cqsR8XDg';
					var map = new mapboxgl.Map({
					    container: 'map',
					    style: 'mapbox://styles/mapbox/streets-v8',
					    center: [-87.82470703125, 14.136575651477944],
					    zoom: 3.2
					});
					  
					
					map.on('load', function () {
					var countries = <?php echo json_encode($countries); ?>;
					// Añade las capas de los países de América Central y les  brinda el diseño a las mismas.
					 map.addSource('belize', {
					        'type': 'geojson',
					        'data': '/app/webroot/belize.geojson'
					 });
					 map.addSource('costa_rica', {
					       'type': 'geojson',
					       'data': '/app/webroot/costa_rica.geojson'
					 });
					 map.addSource('el_salvador', {
					        'type': 'geojson',
					        'data': '/app/webroot/el_salvador.geojson'
					 });
					 map.addSource('guatemala', {
					        'type': 'geojson',
					        'data': '/app/webroot/guatemala.geojson'
					 });
					 map.addSource('honduras', {
					       'type': 'geojson',
					        'data': '/app/webroot/honduras.geojson'
					   });
					  map.addSource('mexico', {
					        'type': 'geojson',
					        'data': '/app/webroot/mexico.geojson'
					   });
					    map.addSource('nicaragua', {
					        'type': 'geojson',
					        'data': '/app/webroot/nicaragua.geojson'
					   });
					   map.addSource('panama', {
					                'type': 'geojson',
					                'data': '/app/webroot/panama.geojson'
					   });
					    for (i=0; i<countries.length; i++){
					    switch(countries[i]){
					        case 1:
					            map.addLayer({
					                'id': 'belize-layer',
					                'type': 'fill',
					                'source': 'belize',
					                'paint': {
					                    'fill-color': 'rgba(8,250,242, 0.4)',
					                    'fill-outline-color': 'rgba(40, 233, 255, 1)'
					                }
					            });
					            break;
					        case 2:    

					             map.addLayer({
					                'id': 'costa_rica-layer',
					                'type': 'fill',
					                'source': 'costa_rica',
					                'paint': {
					                    'fill-color': 'rgba(15,222,15, 0.4)',
					                    'fill-outline-color': 'rgba(24,188,84, 1)'
					                }
					            });
					            break;
					        case 3:    

					            map.addLayer({
					                'id': 'el_salvador-layer',
					                'type': 'fill',
					                'source': 'el_salvador',
					                'paint': {
					                    'fill-color': 'rgba(255, 6, 6, 0.4)',
					                    'fill-outline-color': 'rgba(200, 100, 240, 1)'
					                }
					            });
					            break;
					        case 4:   

					           map.addLayer({
					                'id': 'guatemala-layer',
					                'type': 'fill',
					                'source': 'guatemala',
					                'paint': {
					                    'fill-color': 'rgba(0,88,255, 0.4)',
					                    'fill-outline-color': 'rgba(7, 46, 155, 1)'
					                }
					            });
					            break;
					         case 5:  

					            map.addLayer({
					                'id': 'honduras-layer',
					                'type': 'fill',
					                'source': 'honduras',
					                'paint': {
					                    'fill-color': 'rgba(0,0,255,0.3)',
					                    'fill-outline-color': 'rgba(133,15,183, 1)'
					                }
					            });
					            break;
					        case 6:   

					            map.addLayer({
					                'id': 'mexico-layer',
					                'type': 'fill',
					                'source': 'mexico',
					                'paint': {
					                    'fill-color': 'rgba(255,128,0,0.3)',
					                    'fill-outline-color': 'rgba(252,92,0, 1)'
					                }
					            });
					           
					        case 7:    

					            map.addLayer({
					                'id': 'nicaragua-layer',
					                'type': 'fill',
					                'source': 'nicaragua',
					                'paint': {
					                    'fill-color': 'rgba(255,223,6,0.3)',
					                    'fill-outline-color': 'rgba(239,179,15,1)'
					                }
					            });
					            break;
					        case 8:    

					            map.addLayer({
					                'id': 'panama-layer',
					                'type': 'fill',
					                'source': 'panama',
					                'paint': {
					                    'fill-color': 'rgba(235,12,175,0.3)',
					                    'fill-outline-color': 'rgba(235,12,116, 1)'
					                }
					            });
					            break;
					    default:
					        break;
					    }
					    }
					});
					
					
					
					// Que despliegue un popup cuando se clickea.
					map.on('click', function (e) {
					    var features = map.queryRenderedFeatures(e.point, { layers: ['belize-layer','costa_rica-layer','guatemala-layer','el_salvador-layer','honduras-layer','mexico-layer','nicaragua-layer','panama-layer'] });
					    if (!features.length) {
					        return;
					    }
					    var feature = features[0];
					    var popup = new mapboxgl.Popup()
					        .setLngLat(map.unproject(e.point))
					        .setHTML("Es posible encontrar especies de este género en "+feature.properties.name+".<br>")
					        .addTo(map);
					});
					
					// Use the same approach as above to indicate that the symbols are clickable
					// by changing the cursor style to 'pointer'.
					map.on('mousemove', function (e) {
					    var features = map.queryRenderedFeatures(e.point, { layers: ['america_central-layer'] });
					    map.getCanvas().style.cursor = (features.length) ? 'pointer' : '';
					});
					</script>
					</div>
					</div>
					<?php	} ?>
				</div>
			
			
				<!--CAmpo contenedor de datos de taxnoes, lista de generos(familia) y campo de descarga de pdf(generos)-->
				<div class="col col-sm-7">
				
					<!--Vista en caso de que sea taxon != de Familia o Genero-->
					<?php if($category['Category']['classification']!='Familia' && $category['Category']['classification']!='Genero'){?>	
						<h5>Clasificación</h5> <?php echo h($category['Category']['classification']); ?>
						<h5>Descripción:</h5> 
						<div class="call-out" align="justify">
							<?php echo nl2br(h($category['Category']['description'])); ?>
						</div>	
					<?php	} ?>
					
					
					<!--Vista en caso de que sea taxon ==  Familia -->
					<?php if($category['Category']['classification']=='Familia'||$category['Category']['classification']=='Subfamilia'){?>	
						<h5>Clasificación</h5> 
						<div class= "texto"><?php echo h($category['Category']['classification']); ?></div>
						<h5>Autor:</h5> 
						<div class= "texto"><?php echo nl2br(h($datosFamilia['author'])); ?></div>
						<h5>Características:</h5> 
						<div class= "texto"><?php echo nl2br(h($datosFamilia['characteristic'])); ?></div>
						<h5>Hábitat:</h5> 
						<div class= "texto"><?php echo nl2br(h($datosFamilia['habitat'])); ?></div>
						<h5>Distribución global:</h5> 
						<div class= "texto"><?php echo nl2br(h($datosFamilia['globaldistribution'])); ?></div>
						<h5>Bibliografía :</h5> 
						<div class= "texto"><?php echo nl2br(h($datosFamilia['bibliography'])); ?></div>
						<h5>Observaciones adicionales:</h5> 
						<div class= "texto"><?php echo nl2br(h($datosFamilia['observation'])); ?></div>

						
					<?php	} ?>
					
					
					<!--Vista en caso de que sea taxon ==  Genero -->
					<?php if($category['Category']['classification']=='Genero'){?>
					<!--seccion para la foto y el mapa-->
						<h5>Clasificación</h5> 
						<div class= "texto"><p>Género</p></div>
						<h5>Autor:</h5> 
						<div class= "texto"><?php echo nl2br(h($datosGenero['author'])); ?></div>
						<h5>Características:</h5> 
						<div class= "texto"><?php echo nl2br(h($datosGenero['characteristic'])); ?></div>
						<h5>Hábitat:</h5> 
						<div class= "texto"><?php echo nl2br(h($datosGenero['habitat'])); ?></div>
						<h5>Biología & Ecología:</h5> 
						<div class= "texto"><?php echo nl2br(h($datosGenero['biologyandecology'])); ?></div>
						<h5>Distribución global:</h5> 
						<div class= "texto"><?php echo nl2br(h($datosGenero['globaldistribution'])); ?></div>
						<h5>Bibliografía:</h5> 
						<div class= "texto"><?php echo nl2br(h($datosGenero['bibliography'])); ?></div>
						<h5>Observaciones adicionales:</h5> 
						<div class= "texto"><?php echo nl2br(h($datosGenero['observation'])); ?></div>
						<?php if($doc['Download']['id']!=null){?>
						<h5>Archivo de especies:</h5> 
						<?php echo $this->Html->link(__(''), array('controller' => 'downloads', 'action' => 'viewdown', $doc['Download']['id'],true), array('class' => 'glyphicon glyphicon-file','title' =>'Descargar documento', 'style'=>'color: #3891D4;    font-size:25px;     padding: 5px;')); ?>
						<?php	} }?>
						<br>
						<?php echo $this->Html->link('Ir a galería', array('controller' => 'pictures', 'action' => 'view',$category['Category']['id']));?>
					
					<br>
				</div>
				
			</div>
		</div>
		<style>
            
            
            span.text-content span {
              overflow: hidden;
                max-width: 100%;
                    padding: 100px;
    			height: inherit;
                text-overflow: ellipsis;
                display: -webkit-box;
                line-height: 16px;
                -webkit-line-clamp: 13;
                -webkit-box-orient: vertical;
              
            }
            span.text-content {
                text-align: center;
              background: rgba(0,0,0,0.5);
              color: white;
              cursor: pointer;
              display: table;
              height: 212px;
              left: 0;
              position: absolute;
              top: 0;
              width: 100%;
              opacity: 0;
              -webkit-transition: opacity 500ms;
              -moz-transition: opacity 500ms;
              -o-transition: opacity 500ms;
              transition: opacity 500ms;
            }
            
            div.thumbnail:hover span.text-content {
              opacity: 1;
            }
            </style>
	</div>
</div>