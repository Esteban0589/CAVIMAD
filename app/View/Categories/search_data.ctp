<div class="container">
    <h2><?php if($resultados!=null){ echo __('Resultados de la búsqueda:'); ?></h2>
	

	<div class="col-lg-12 col-md-12">
		<?php foreach ($resultados as $resultado): ?>
			
				<div class="col-lg-6 col-md-6">
					<!--Parte del texto-->
					<div title ="Seleccione para ir a la vista completa de la información del taxón"><b style="color:#82B204"><?php echo$this->Html->link($resultado['Category']['name'], array('controller' => 'categories','action' => 'view2',$resultado['Category']['id']));?></b></div>
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
				</div>
				<div class="col-lg-2 col-md-2">
					
					<?php
						if(!empty($resultado['Picture']['image_dir'])){
					?>
					
						<div class="thumbnail"> 
								<?php echo $this->Html->image('../files/category/image/' . $resultado['Picture']['image_dir'].'/'.'thumb_'.$resultado['Picture']['image'],array('style' =>'width: 60%;' )); ?>
						</div>
					<?php }
						else{ ?>
							<div class="thumbnail"> 
								<?php echo "<a href= 'categories/view2/".$resultado['Category']['id']."'>"; ?>
								<?php echo $this->Html->image('../files/category/default.PNG', array('style'=>'width: 60%;')); ?>
							 	<!--<?php //echo "</a>";?>-->
							</div>
					<?php
						}	
					?>
					<!--Parte de la foto Cierra-->
				</div>
				<div class="col-lg-4 col-md-4">
				</div>
				<div class="col-lg-12 col-md-12">
				</div>
				
				
				
					<!--Parte de textos-->
					
                    <!--Cierra parte de textos-->
                    	<?php endforeach;} ?>
				</div>
				
            <!--<div class="col-lg-12 col-md-12"></div>-->
	

</div>







