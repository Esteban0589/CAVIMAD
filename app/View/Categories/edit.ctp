
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<?php echo $this->Form->create('Category'); ?>
			
	        <fieldset>
	        
	        	<div class="page-header">
	            	
		            <h2><?php echo __('Editar Categoria'); ?></h2>

	            </div>
	        	
	        	
				<?php echo $this->Form->input('name', array('label'=>'Nombre de la categoría','class'=>'form-control')); ?>
				<?php echo $this->Form->input('description', array('label'=>'Descrición','class'=>'form-control')); ?>
				<?php echo $this->Form->input('classification', array('label'=>'Clasificación','class'=>'form-control','options'=>$clasificacion)); ?>
				<?php echo $this->Form->input('parent_id', array('label'=>'Padre','class'=>'form-control','options'=>$categories)); ?>
				<?php echo $this->Form->input('id', array('label'=>false,'class'=>'form-control')); ?>
				
	        </fieldset>
			<br>
			
			<?php echo $this->Form->end(array('label'=>'Editar', 'class'=>'btn btn-success')); ?>
		</div>
    </div>
</div>






	    <!--        <div class="page-header">-->
		   

				<!--<?php echo $this->Form->input('Nombre', array('label'=>'Nombre de la categoría','class'=>'form-control')); ?>-->
				<!--<?php echo $this->Form->input('id', array('label'=>false,'class'=>'form-control')); ?>-->
			
			<!--</fieldset>-->
			<!--<?php echo $this->Form->end(array('label'=>'Editar', 'class'=>'btn btn-success')); ?>-->
			














<!--<div class="categories form">-->
<!--<?php echo $this->Form->create('Category'); ?>-->
<!--	<fieldset>-->
<!--		<legend><?php echo __('Edit Category'); ?></legend>-->
<!--	<?php-->
<!--		echo $this->Form->input('id');-->
<!--		echo $this->Form->input('left');-->
<!--		echo $this->Form->input('right');-->
<!--		echo $this->Form->input('name');-->
<!--		echo $this->Form->input('description');-->
<!--		echo $this->Form->input('classification');-->
<!--		echo $this->Form->input('parent_id');-->
<!--	?>-->
<!--	</fieldset>-->
<!--<?php echo $this->Form->end(__('Submit')); ?>-->
<!--</div>-->
<!--<div class="actions">-->
<!--	<h3><?php echo __('Actions'); ?></h3>-->
<!--	<ul>-->

<!--		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Category.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Category.id')))); ?></li>-->
<!--		<li><?php echo $this->Html->link(__('List Categories'), array('action' => 'index')); ?></li>-->
<!--		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>-->
<!--		<li><?php echo $this->Html->link(__('New Parent Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>-->
<!--	</ul>-->
<!--</div>-->
