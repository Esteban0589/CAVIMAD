<div class="container">
	<br>
    <h2 class="title-widget">Resultados de la búsqueda:</h2>

	<div class="col-lg-12 col-md-12">
		<?php foreach ($resultados as $resultado): ?>
			
				<div class="col-lg-3 col-md-3">
					<!--Parte de la foto-->
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
					<!--Parte de la foto Cierra-->
				</div>
				
				<div class="col-lg-9 col-md-9">
					<!--Parte de textos-->
					<h1 class="title-median"><a href="#" title="Nombre"><?php echo h($resultado['Category']['name']);?></a></h1>
					<ul>
						<li>
							<div>
								<p>
									
									Descripción:<?php echo h($resultado['Category']['description']); ?>
								</p>
							</div>
						</li>
							<div>
								Clasificación:<?php echo h($resultado['Category']['classification']); ?>
							</div>
							<a>
						    	<?php 
									echo $this->Html->link('<i class="glyphicon glyphicon-eye-open"></i>',
									array('controller' => 'Category','action' => 'view',$resultado['Category']['id']),
									array('escape' => false)
									);
								?>
							</a> 
                    </ul>
                    <!--Cierra parte de textos-->
				</div>
				
            <div class="col-lg-12 col-md-12"><br></div>
		<?php endforeach; ?>

	</div>
</div>
