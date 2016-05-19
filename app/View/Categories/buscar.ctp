<div class="container">
    <h2><?php if($resultados!=null){ echo __('Resultados de la búsqueda:'); ?></h2>
	

	<div class="col-lg-12 col-md-12">
		<?php foreach ($resultados as $resultado): ?>
			
				<div class="col-lg-3 col-md-3">
					<!--Parte de la foto-->
					<?php
						if(count($resultado['Picture']['image_dir'])>0){
					?>
					
						<div class="thumbnail"> 
							<?php echo "<a href= 'categories/view/".$resultado['Category']['id']."'>"; ?>
							<?php echo $this->Html->image('../files/category/image/' . $resultado['Picture']['image_dir'].'/'.'thumb_'.$resultado['Picture']['image']); ?>
							<?php echo "</a>";?>
						</div>
					<?php }
						else{ ?>
							<div class="thumbnail"> 
								<?php echo "<a href= 'categories/view/".$resultado['Category']['id']."'>"; ?>
								<?php echo $this->Html->image('../files/category/default.PNG'); ?>
							 	<?php echo "</a>";?>
							</div>
					<?php
						}	
					?>
					<!--Parte de la foto Cierra-->
				</div>
				
				<div class="col-lg-9 col-md-9">
					<!--Parte de textos-->
					<b style="color:#82B204"><?php echo$this->Html->link($resultado['Category']['name'], array('controller' => 'Category','action' => 'view',$resultado['Category']['id']));?></b>
					<ul>
						
							<div>
								<b>Clasificación:</b><p style="text-indent:60px"><?php echo h($resultado['Category']['classification']); ?></p>
							</div>
							
							
							<b>Descripción:</b>
							<div>
								<p style="text-indent:60px">
									<?php echo substr($resultado['Category']['description'],0,300); ?>
								</p>
							</div>
                    </ul>
                    <!--Cierra parte de textos-->
				</div>
				
            <div class="col-lg-12 col-md-12"></div>
		<?php endforeach;} ?>

	</div>
</div>
