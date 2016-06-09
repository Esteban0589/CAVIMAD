<div class="container">
	<div class="row">
		<div class="col-md-6">
			<?php echo $this->Form->create('Download', array('enctype'=>'multipart/form-data')); ?>
			<fieldset>
				<div class="page-header">
					<h2><?php echo __('Agregar pdf'); ?></h2>
				</div>
				
				<div title = "En este campo por favor introduzca un título para el archivo"><?php echo $this->Form->input('title', array('class'=>'form-control','label'=>'Título:','placeholder' => 'Título',));?></div>
				<div title = "En este campo por favor introduzca su primer apellido"><?php echo $this->Form->input('description', array('class'=>'form-control','label'=>'Descripción:','placeholder' => 'Descripción'));?></div>
				<div title = "En este campo por favor introduzca su segundo apellido"><?php echo $this->Form->input('report', array('type'=>'file','label'=>'Archivo:','placeholder' => 'Archivo'));?></div>
				<br>
			</fieldset>
		<?php echo $this->Form->end(array('label'=>'Guardar pdf', 'class'=>'btn btn-success')); ?>
		<br>
		</div>

	</div>
	
</div>

