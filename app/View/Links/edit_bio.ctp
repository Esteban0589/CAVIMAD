<div class="container">
	<div class="row">
		<div class="col-md-6">
			<?php echo $this->Form->create('Link'); ?>
			<fieldset>
				<div class="page-header">
					<h2><?php echo __('Editar enlace'); ?></h2>
				</div>
				<?php echo $this->Form->input('id'); ?>
				
				<div title = "En este campo por favor introduzca un título para el enlace"><?php echo $this->Form->input('title', array('class'=>'form-control','label'=>'Título:','placeholder' => 'Título',));?></div>
				<div title = "En este campo por favor introduzca el enlace"><?php echo $this->Form->input('url', array('class'=>'form-control','label'=>'Enlace:','placeholder' => 'Enlace',));?></div>
				<div title = "En este campo por favor introduzca una descripción para el archivo"><?php echo $this->Form->input('description', array('class'=>'form-control','rows' => '5', 'cols' => '5','label'=>'Descripción:','placeholder' => 'Descripción'));?></div>
				<br>
			</fieldset>
		<?php echo $this->Form->end(array('label'=>'Guardar enlace', 'class'=>'btn btn-success')); ?>
		<br>
		</div>

	</div>
	
</div>
