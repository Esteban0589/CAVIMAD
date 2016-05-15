<section id="form"><!--form-->
	<div class="container">
		<div class="row" align="center">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12col-lg-offset-3 col-md-offset-3 col-sm-offset-3 text-center">
				<div class="buscar-form"><!--buscar form-->
						<div class="row no-gutter"><!-- row -->
	                    
	                    <div class="col-lg-5 col-md-5"><!-- upcoming events wrapper -->
	                    	
	                        <div class="col-padded col-shaded"><!-- inner custom column -->
	                        
	                        	<ul class="list-unstyled clear-margins"><!-- widgets -->
	                            
	                            	<li class="widget-container widget_up_events"><!-- widgets list -->
	                        
	                                    <h2 class="title-widget">Resultados de la búsqueda:</h2>
	                                    
	                                    <ul class="list-unstyled">
											<?php foreach ($resultados as $resultado): ?>
												<li class="up-event-wrap">
													<?php
														if(count($resultado['Picture']['image_dir'])>0){
													?>
														<div class="thumbnail"> <?php echo $this->Html->image('../files/category/image/' . $resultado['Picture']['image_dir'].'/'.'thumb_'.$resultado['Picture']['image']); ?></div>
													<?php }
														else{ ?>
															<div class="thumbnail"> <?php echo $this->Html->image('../files/category/default.PNG'); ?></div>
													<?php
														}	
													?>
													<h1 class="title-median"><a href="#" title="Nombre"><?php echo h($resultado['Category']['name']);?></a></h1>
													<div>Descripción:<?php echo h($resultado['Category']['description']); ?></div>
													<div>Clasificación:<?php echo h($resultado['Category']['classification']); ?></div>
													<p>
														<a>
													    	<?php 
																echo $this->Html->link('<i class="glyphicon glyphicon-eye-open"></i>',
																array('controller' => 'Category','action' => 'view',$resultado['Category']['id']),
																array('escape' => false)
																);
															?>
														</a> 
		                                            </p>
		                                        </li>
											<?php endforeach; ?>
										</ul>
						</div>
					</div>
				</table>
			</div>
		</div>
	</div></div></div>
</section>