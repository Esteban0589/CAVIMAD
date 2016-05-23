<div class="container">
    <h2><?php if($resultados!=null){ echo __('Resultados de la búsqueda:'); ?></h2>
	

	<div class="col-lg-12 col-md-12">
		<?php foreach ($resultados as $resultado): ?>
			
				<div class="col-lg-3 col-md-3">
					<!--Parte de textos-->
					<!--<b style="color:#82B204"><?php//echo$this->Html->link($resultado['User']['name'], array('controller' => 'User','action' => 'view',$resultado['User']['id']));?></b>-->
					<ul>
						
							<div>
							    <b>Nombre de usuario: </b><div title ="Seleccione para ir a la vista completa de la información del usuario"><?php echo "<a href= 'users/view/".$resultado['User']['id']."'>"; ?><?php echo h($resultado['User']['username']); ?></div><?php echo "</a>";?><br>
								<b>Nombre: </b><?php echo h($resultado['User']['name']); ?> <?php echo h($resultado['User']['lastname1']); ?><p style="text-indent:60px"></p>
							</div>
							
                    </ul>
                    <!--Cierra parte de textos-->
				</div>
				<div class="col-lg-2 col-md-2">
					<!--Parte de la foto-->
					<?php
						if(!empty($resultado['User']['image_dir'])){
					?>
					
						<div class="thumbnail"> 
						    
							<?php echo $this->Html->image('../files/user/image/' . $resultado['User']['image_dir'].'/'.'thumb_'.$resultado['User']['image'],array('style' =>'width: 60%;' )); ?>
							<!--<?php// echo "</a>";?>-->
						</div>
					<?php }
						else{ ?>
							<div class="thumbnail"> 
								<!--<?php //echo "<a href= 'users/view/".$resultado['User']['id']."'>"; ?>-->
								<?php echo $this->Html->image('../files/user/usuario.jpg', array('style'=>'width: 60%;')); ?>
							 	<!--<?php //echo "</a>";?>-->
							</div>
					<?php
						}	
					?>
					<!--Parte de la foto Cierra-->
				</div>
				
				
            <div class="col-lg-12 col-md-12"></div>
		<?php endforeach;} ?>

	</div>
</div>
