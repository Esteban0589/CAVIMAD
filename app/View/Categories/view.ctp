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


<div class="container">
	<div class="row">
		<div class="page-header">
			<div class="col col-sm-7">
				<div class="col col-sm-7">
					<h2 style="margin: 0px;"> <?php echo $category['Category']['name']; ?>	</h2>
				</div>
				
				<?php if($_SESSION['role']=='Administrador'): ?>
				<div class="col col-sm-5">
					<h5 style="margin: 0px;"> Edición de Taxón	
					
					<?php echo $this->Html->link(__(''), array('action' => 'edit', $category['Category']['id'], 'alias'=>$alias), array('class' => 'glyphicon glyphicon-pencil','title' =>'Editar el taxón', 'style'=>'color: #3891D4;    font-size:25px;     padding: 5px;')); ?>

		            <?php echo $this->Form->postLink(__(''), array('action' => 'delete', $category['Category']['id'], 'alias'=>$alias), array('class' => 'glyphicon glyphicon-trash', 'title' =>"Eliminar el taxón",'style'=>'color: #860000;    font-size:25px;     padding: 5px;'), __('Está seguro de que desea eliminar # %s?', $category['Category']['name'])); ?>
					</h5>

				</div>

				<?php endif; ?>
					
			</div>
			
			
		<div class="row">

			<div class="col col-sm-7">

			
				<h5>Clasificacion</h5> <?php echo h($category['Category']['classification']); ?>
				<h5>Descripción:</h5> <?php echo h($category['Category']['description']); ?>
				<br>

				<!--<div class="actions">-->
<!--	<h3><?php echo __('Actions'); ?></h3>-->
<!--	<ul>-->
<!--		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $category['User']['id'])); ?> </li>-->
<!--		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $category['User']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $category['User']['id']))); ?> </li>-->
<!--		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>-->
<!--		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>-->
<!--		<li><?php echo $this->Html->link(__('List Administrators'), array('controller' => 'administrators', 'action' => 'index')); ?> </li>-->
<!--		<li><?php echo $this->Html->link(__('New Administrator'), array('controller' => 'administrators', 'action' => 'add')); ?> </li>-->
<!--	</ul>-->
<!--</div>-->

			</div>


			<div class="col col-sm-5">
					<?php
					if(count($category['Picture']['image_dir'])>0){
				?>
				
					<div class="thumbnail"> 
						<?php echo "<a href= 'categories/view/".$category['Category']['id']."'>"; ?>
						<?php echo $this->Html->image('../files/category/image/' . $category['Picture']['image_dir'].'/'.'thumb_'.$category['Picture']['image']); ?>
						<?php echo "</a>";?>
					</div>
				<?php }
					else{ ?>
						<div class="thumbnail"> 
							<?php echo "<a href= 'categories/view/".$category['Category']['id']."'>"; ?>
							<?php echo $this->Html->image('../files/category/default.PNG'); ?>
						 	<?php echo "</a>";?>
						</div>
				<?php
					}	
				?>
			</div>
		</div>
	</div>
</div>
























