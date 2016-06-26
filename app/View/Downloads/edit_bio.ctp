<div class="container">
	<div class="row">
		<div class="col-md-6">
			<?php echo $this->Form->create('Download', array('enctype'=>'multipart/form-data')); ?>
			<fieldset>
				<div class="page-header">
					<h2><?php echo __('Editar Documento'); ?></h2>
				</div>
				<?php echo $this->Form->input('id'); ?>
				<div title = "En este campo por favor introduzca un título para el archivo"><?php echo $this->Form->input('title', array('class'=>'form-control','label'=>'Título:','placeholder' => 'Título',));?></div>
				<div title = "En este campo por favor introduzca una descripción para el archivo"><?php echo $this->Form->input('description', array('class'=>'form-control','rows' => '5', 'cols' => '5','label'=>'Descripción:','placeholder' => 'Descripción'));?></div>
				<div title = "En este campo por favor introduzca un resumen del archivo"><?php echo $this->Form->input('abstract', array('class'=>'form-control','rows' => '5', 'cols' => '5','label'=>'Resumen:','placeholder' => 'Resumen'));?></div>
				<div title = "Seleccione el archivo que desea agregar"><?php echo $this->Form->input('report', array('type'=>'file','label'=>'Archivo:','placeholder' => 'Archivo'));?></div>
				<br>
			</fieldset>
		<?php echo $this->Form->end(array('label'=>'Guardar enlace', 'class'=>'btn btn-success')); ?>
		<br>
		</div>

	</div>
	
</div>
