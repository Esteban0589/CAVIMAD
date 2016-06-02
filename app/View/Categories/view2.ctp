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
.texto{margin-bottom: 15px;}

</style>


<div class="container" >
	<div class="row">
			<div class="page-header">
			<div class="col col-sm-12" style=" padding-left: 0px;">
				<!--<div class="col col-sm-7">-->
					<h2 style="margin: 0px;"> <?php echo $category['Category']['name']; ?>	</h2>
					<br>
				<!--</div>-->
				
				<?php if($this->Session->read('role')=='Administrador'): ?>
				<!--<div class="col col-sm-5">-->
					<h5 style="margin: 0px;"> Edición de Taxón	
					
					<?php echo $this->Html->link(__(''), array('action' => 'edit', $category['Category']['id'], 'alias'=>$alias), array('class' => 'glyphicon glyphicon-pencil','title' =>'Editar el taxón', 'style'=>'color: #3891D4;    font-size:25px;     padding: 5px;')); ?>
	
		            <?php echo $this->Form->postLink(__(''), array('action' => 'delete', $category['Category']['id'], 'alias'=>$alias), array('class' => 'glyphicon glyphicon-trash', 'title' =>"Eliminar el taxón",'style'=>'color: #860000;    font-size:25px;     padding: 5px;'), __('Está seguro de que desea eliminar # %s?', $category['Category']['name'])); ?>
					</h5>
	
				<!--</div>-->
	
				<?php endif; ?>
					
			</div>
			
			
			<div class="row">
				<!--Compo contenedor de imagen y mapa-->
				<div class="col col-sm-5">
					<div class="row">
					
						<?php
						if((!empty($category['Picture']['image_dir']))&&(count($category['Picture']['image_dir'])>0) ){
						?>
							<div class="thumbnail"> 
								<?php echo $this->Html->image('../files/category/image/' . $category['Picture']['image_dir'].'/'.'thumb_'.$category['Picture']['image']); ?>
							</div>
						<?php }	else{ ?>
							<div class="thumbnail"> 
								<?php echo $this->Html->image('../files/category/default.PNG'); ?>
							</div>
						<?php } ?>
					</div>
					<!--Campo para el mapa-->
					<div class="row">
						Mapa de ubicacion
					<?php
						if((!empty($category['Picture']['image_dir']))&&(count($category['Picture']['image_dir'])>0) ){
						?>
							<div class="thumbnail"> 
								<?php echo $this->Html->image('../files/category/image/' . $category['Picture']['image_dir'].'/'.'thumb_'.$category['Picture']['image']); ?>
							</div>
						<?php }	else{ ?>
							<div class="thumbnail"> 
								<?php echo $this->Html->image('../files/category/default.PNG'); ?>
							</div>
						<?php } ?>
					</div>
				</div>
			
			
				<!--CAmpo contenedor de datos de taxnoes, lista de generos(familia) y campo de descarga de pdf(generos)-->
				<div class="col col-sm-7">
				
					<!--Vista en caso de que sea taxon != de Familia o Genero-->
					<?php if($category['Category']['classification']!='Familia' && $category['Category']['classification']!='Genero'){?>	
						<h5>Clasificacion</h5> <?php echo h($category['Category']['classification']); ?>
						<h5>Descripción:</h5> <?php echo nl2br(h($category['Category']['description'])); ?>
					<?php	} ?>
					
					
					<!--Vista en caso de que sea taxon ==  Familia -->
					<?php if($category['Category']['classification']=='Familia'){?>	
						<h5>Clasificacion</h5> 
						<div class= "texto"><?php echo h($category['Category']['classification']); ?></div>
						<h5>Descripción:</h5> 
						<div class= "texto"><?php echo nl2br(h($category['Category']['description'])); ?></div>
						<h5>Características:</h5> 
						<div class= "texto"><?php echo nl2br(h($datosFamilia['characteristic'])); ?></div>
						<h5>Hábitat:</h5> 
						<div class= "texto"><?php echo nl2br(h($datosFamilia['habitat'])); ?></div>
						<h5>Distribución global:</h5> 
						<div class= "texto"><?php echo nl2br(h($datosFamilia['globaldistribution'])); ?></div>
						<h5>Observaciones adicionales:</h5> 
						<div class= "texto"><?php echo nl2br(h($datosFamilia['observation'])); ?></div>
						<button type="button" class="btn btn-default btn-sm "  style=" margin: 10px;"> <a title=\"Ver perfil resumido de taxón y sus taxones relacionados\" class="glyphicon glyphicon-list-alt" style="padding: 5px;color: #FFFFFF;" href="javascript:cargar(<?php echo $category['Category']['id']?>)" ></a>Generos relacionados</button>
						
					<?php	} ?>
					
					
					<!--Vista en caso de que sea taxon ==  Genero -->
					<?php if($category['Category']['classification']=='Genero'){?>
					<!--seccion para la foto y el mapa-->
						<h5>Clasificacion</h5> 
						<div class= "texto"><?php echo h($category['Category']['classification']); ?></div>
						<h5>Descripción:</h5> 
						<div class= "texto"><?php echo nl2br(h($category['Category']['description'])); ?></div>
						<h5>Características:</h5> 
						<div class= "texto"><?php echo nl2br(h($datosGenero['characteristic'])); ?></div>
						<h5>Biología & Ecología:</h5> 
						<div class= "texto"><?php echo nl2br(h($datosGenero['biologyandecology'])); ?></div>
						<h5>Hábitat:</h5> 
						<div class= "texto"><?php echo nl2br(h($datosGenero['habitat'])); ?></div>
						<h5>Distribución global:</h5> 
						<div class= "texto"><?php echo nl2br(h($datosGenero['globaldistribution'])); ?></div>
						<h5>Observaciones adicionales:</h5> 
						<div class= "texto"><?php echo nl2br(h($datosGenero['observation'])); ?></div>
						<h5>Descargable de especies:</h5> 
					<?php	} ?>
					<br>
				</div>
				
			</div>
		</div>
	</div>
</div>




			























