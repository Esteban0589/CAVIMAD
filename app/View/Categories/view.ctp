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


<div class="container" style=" width: initial;">
	<div class="row">
		<div class="page-header">
			<div class="col col-sm-12" style=" padding-left: 0px;">
				<!--<div class="col col-sm-7">-->
					<h2 style="margin: 0px;"> <?php echo $category['Category']['name']; ?>	</h2>
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

			<div class="col col-sm-7">
				<h5>Clasificacion</h5> <?php echo h($category['Category']['classification']); ?>
				<h5>Descripción:</h5> <?php echo nl2br(h($category['Category']['description'])); ?>
				<br>
			</div>


			<div class="col col-sm-5">
					<?php
				if((!empty($category['Picture']['image_dir']))&&(count($category['Picture']['image_dir'])>0) ){
				?>
				
					<div class="thumbnail"> 
						<?php echo $this->Html->image('../files/category/image/' . $category['Picture']['image_dir'].'/'.'thumb_'.$category['Picture']['image']); ?>
					</div>
				<?php }
					else{ ?>
						<div class="thumbnail"> 
							<?php echo $this->Html->image('../files/category/default.PNG'); ?>
						</div>
				<?php
					}	
				?>
				
			<?php
				if($category['Category']['classification']=='Familia'||$category['Category']['classification']=='Orden'){
					
			?>		
				<div class="thumbnail"> 
					CAMPO PARA EL MAPA
					<?php echo $this->Html->image('../files/category/default.PNG'); ?>
					</div>
				
			<?php	}
				
				?>

			</div>
		</div>
	</div>
</div>
























