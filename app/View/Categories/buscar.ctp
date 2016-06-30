<div class="container">
    <h2><?php if($resultados!=null){ echo __('Resultados de la búsqueda:'); ?></h2>
	

	<div class="col-lg-12 col-md-12">
		<?php foreach ($resultados as $resultado): ?>
			
				<div class="col-lg-3 col-md-3">
					<!--Parte de la foto-->
		
					<div id="carousel-featured" class="carousel slide" data-interval="4000" data-ride="carousel"><!-- featured posts slider wrapper; auto-slide -->
     					<div class="carousel-inner"><!-- Wrapper for slides -->
                             <?php
                            	if(count($resultado['Pictures'])==null){?>
                            		<div class="thumbnail"> 
										<?php echo $this->Html->image('../files/picture/default.PNG'); ?>
									</div>
                            	<?php }else{
		                         $y=true;
		                         for($i=0; $i<count($resultado['Pictures']); $i++){?>
			                         <?php if($y){?>
			                            <div class="item active">
			                         <?php $y=false; 
			                         } else { ?>
			                             <div class="item">
			                         <?php } ?>
			                          	 <div class="thumbnail"> 
			                            	<?php echo $this->Html->image('../files/picture/image/' . $resultado['Pictures'][$i]['Picture']['image_dir'].'/'.$resultado['Pictures'][$i]['Picture']['image'], array('style'=>'height: 200px; width: 100%;')); ?>
			                           	 </div>
			                          	
			                            </div>
		                     <?php  } }?>
			                     
                            </div><!-- Wrapper for slides end -->
                

                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-featured" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
                    <a class="right carousel-control" href="#carousel-featured" data-slide="next"><i class="fa fa-chevron-right"></i></a>
                    <!-- Controls end -->
                </div><!-- featured posts slider wrapper end -->		
							
							
				
				
				
				
				
					<!--Parte de la foto Cierra-->
				</div>
				
				<div class="col-lg-9 col-md-9">
					<!--Parte de textos-->
					<div title ="Seleccione para ir a la vista completa de la información del taxón">
						<b style="color:#82B204">
							<?php if($resultado['Category']['classification']=='Genero'){?>	
								<em> <?php echo$this->Html->link($resultado['Category']['name'], array('controller' => 'categories','action' => 'view2',$resultado['Category']['id']));?> </em>
							<?php	} else { ?>
								<?php echo$this->Html->link($resultado['Category']['name'], array('controller' => 'categories','action' => 'view2',$resultado['Category']['id']));?>
							<?php	} ?>
							
						</b>
					</div>
					<ul>
						
							<div>
								<b>Clasificación:</b><p style="text-indent:60px"><?php echo h($resultado['Category']['classification']); ?></p>
							</div>
							
							
							<b>Descripción:</b>
							<div>
								<p style="text-indent:60px">
									<?php echo substr($resultado['Category']['description'],0,300); ?>
									
								</p>
								
								<?php echo "<a href= 'categories/view2/".$resultado['Category']['id']."'>...ver más</a>"; ?>
							</div>
                    </ul>
                    <!--Cierra parte de textos-->
				</div>
				
            <div class="col-lg-12 col-md-12"></div>
		<?php endforeach;} ?>

	</div>
</div>
