<div class="container">
	<div class="row">
		<div class="homePictures form col-md-6">
			<?php echo $this->Form->create('HomePicture', array('type'=>'file', 'novalidate'=>'novalidate')); ?>
				<fieldset>
					<br>
					<h1><?php echo __('Agregar imagen de portada'); ?></h1>
				<?php
					echo $this->Form->input('title',array('class'=>'form-control','label'=>'Título','title'=>'Ingrese el titulo de la imagen'));
					echo $this->Form->input('description',array('class'=>'form-control','label'=>'Descripcíon','rows' => '5', 'cols' => '5','title'=>'Ingrese una descripcion de la imagen' ));
					echo $this->Form->input('image', array('class'=>'form-control','type'=>'file','label'=>'Imagen','title'=>'Seleccione la imagen a cargar' ));
					echo $this->Form->input('image_dir', array('type'=>'hidden'));
					
				?>
				<br>
				</fieldset>
			<?php echo $this->Form->end(array('label'=>'Guardar imagen', 'class'=>'btn btn-success','title'=>'Guardar imagen en galeria')); ?>
		</div>
	</div>
	<div class="actions">
		<h3><?php echo __('Acciones'); ?></h3>
		<ul>
	
			<li><?php echo $this->Html->link(__('Ver galeria'), array('action' => 'index')); ?></li>
		</ul>
	</div>
</div>
