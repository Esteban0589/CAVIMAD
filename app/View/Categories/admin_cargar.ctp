<!--Este style lo use para dalre formato a los botones de editar y eliminar cuando se esta en modo admin-->
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


</style>


<div class="container" style = "width: initial;">
	<!--En este row vamos a poner que solo aparezcan el titulo la imagen y datos del taxon seleccionado(tipo y clasificacion)-->
	<div class="row">
			<!--Titulo de cual es el taxon seleccionado(abarca las 12 columnas de este row)-->
			<h2 style="margin: 0px;"> <?php echo $category['Category']['name']; ?>	</h2>
			<!--Imagen a la izq con 3 columnas-->
			<div class="col col-sm-3">
				<?php
				if(count($category['Picture']['image_dir'])>0){
				?>
					<div class="thumbnail"> 
						<?php echo "<a href= 'categories/view/".$category['Category']['id']."'>"; ?>
						<?php echo $this->Html->image('../files/category/image/' . $category['Picture']['image_dir'].'/'.'thumb_'.$category['Picture']['image']); ?>
						<?php echo "</a>";?>
					</div>
				<?php
				}else{ ?>
					<div class="thumbnail"> 
						<?php echo "<a href= 'categories/view/".$category['Category']['id']."'>"; ?>
						<?php echo $this->Html->image('../files/category/default.PNG'); ?>
					 	<?php echo "</a>";?>
					</div>
				<?php
				}	
				?>
				</div>
	
			<!--Campo para tipo y descripcion. Toma las 9columans restantes de este row-->
			<div class="col col-sm-9">
		    	<!--Si es admin demuestre opciones de edicion-->
				<?php if($this->Session->read('role')=='Administrador'): ?>
					<h5 style="margin: 0px;"> Edición de Taxón	
					<?php echo $this->Html->link(__(''), array('action' => 'edit', $category['Category']['id'], 'alias'=>$alias), array('class' => 'glyphicon glyphicon-pencil','title' =>'Editar el taxón', 'style'=>'color: #3891D4;    font-size:25px;     padding: 5px;')); ?>
		            <?php echo $this->Form->postLink(__(''), array('action' => 'delete', $category['Category']['id'], 'alias'=>$alias), array('class' => 'glyphicon glyphicon-trash', 'title' =>"Eliminar el taxón",'style'=>'color: #860000;    font-size:25px;     padding: 5px;'), __('Está seguro de que desea eliminar # %s?', $category['Category']['name'])); ?>
					</h5>
			    <?php endif; ?>
				<h5 style = "margin: 0px; ">Clasificacion</h5> <?php echo h($category['Category']['classification']); ?>
				<h5 style = "margin: 0px; ">Descripción:</h5> <?php echo h($category['Category']['description']); ?>
				<br>
			</div>
	</div>
	<!--En este row veremos los taxones asociados con su imagen y una pequeña decripcion-->
	<div class="row">
		<h2>
			Taxones asociados
		</h2>	
		
		
	</div>
</div>