
<div class="container">
	<div class="row">
		<?php if($this->Session->read('role') =='Administrador'): ?>
		<div class="pictures form col-md-6">
		<?php echo $this->Form->create('Picture', array('controller'=>'Pictures','action'=>'add','type'=>'file', 'novalidate'=>'novalidate')); ?>
			<fieldset>
				<h1>
					<?php echo __('Agregar imagen de genero'); ?>
					<?php echo $this->Html->link(__(''), array('action' => 'index'), array('class' => 'glyphicon glyphicon-th-large','title' =>'Ir a galeria', 'style'=>'color: #3891D4;    font-size:25px;     padding: 5px;')); ?>
					
				</h1>
			<?php
				echo $this->Form->input('image', array('class'=>'form-control','type'=>'file','label'=>'Imagen','title'=>'Seleccione la imagen a cargar' ));
				echo $this->Form->input('image_dir',array('type' =>'hidden'));
				echo $this->Form->input('phylo_id',array('type' =>'hidden'));
				echo $this->Form->input('subphylo_id',array('type' =>'hidden'));
				echo $this->Form->input('class_id',array('type' =>'hidden'));
				echo $this->Form->input('subclass_id',array('type' =>'hidden'));
				echo $this->Form->input('order_id',array('type' =>'hidden'));
				echo $this->Form->input('suborder_id',array('type' =>'hidden'));
				echo $this->Form->input('family_id',array('type' =>'hidden'));
				echo $this->Form->input('subfamily_id',array('type' =>'hidden'));
				echo $this->Form->input('genre_id',array('type' =>'hidden'));
				echo $this->Form->input('subgenre_id',array('type' =>'hidden'));
			?>
			</fieldset>
			<br>
			<?php echo $this->Form->end(array('label'=>'Guardar imagen', 'class'=>'btn btn-success','title'=>'Guardar imagen en galeria')); ?>
		</div>
			<?php endif; ?>
				<?php if($this->Session->read('role') !='Administrador'): ?>
	        	<div class="alert alert-warning alert-dismissable">
	                 <p><strong>Upps!</strong> No puedes acceder a esta página.</p>
	           </div>
			<?php endif; ?>  
		</div>
		<br>
	</div>
</div>
		
		
		
		<div class="actions">
			<h3><?php echo __('Actions'); ?></h3>
			<ul>
		
				<li><?php echo $this->Html->link(__('List Pictures'), array('action' => 'index')); ?></li>
			</ul>
		</div>
