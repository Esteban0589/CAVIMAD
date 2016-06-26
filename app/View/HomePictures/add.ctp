<div class="container">
	<div class="row">
		<?php if($this->Session->read('Auth')['User']['role'] =='Administrador'): ?>

		<div class="homePictures form col-md-6">
			<?php echo $this->Form->create('HomePicture', array('type'=>'file', 'novalidate'=>'novalidate')); ?>
				<fieldset>
					<br>
					<h1>
						<?php echo __('Agregar imagen de portada'); ?>
						<?php echo $this->Html->link(__(''), array('action' => 'index'), array('class' => 'glyphicon glyphicon-th-large','title' =>'Ir a galeria', 'style'=>'color: #3891D4;    font-size:25px;     padding: 5px;')); ?>
						
					</h1>
				<?php
					echo $this->Form->input('title',array('class'=>'form-control','label'=>'Título','title'=>'Ingrese el titulo de la imagen'));
					echo $this->Form->input('description',array('class'=>'form-control','label'=>'Descripcíon','rows' => '5', 'cols' => '5','title'=>'Ingrese una descripcion de la imagen' ));
					echo $this->Form->input('position',array('class'=>'form-control','label'=>'Posicion de imagen ','title'=>'Ingrese el titulo de la imagen','options'=>$position));
					echo $this->Form->input('image', array('class'=>'form-control','type'=>'file','label'=>'Imagen','title'=>'Seleccione la imagen a cargar' ));
				?> <font color="black">
					<p>
						Solo se admiten imagenes .png o .jpg
					</p>
					</font>
				<?php
					echo $this->Form->input('image_dir', array('type'=>'hidden'));
					
				?>
				
				<br>
				</fieldset>
			<?php echo $this->Form->end(array('label'=>'Guardar imagen', 'class'=>'btn btn-success','title'=>'Guardar imagen en galeria')); ?>
		</div>
		<?php endif; ?>
			<?php if($this->Session->read('Auth')['User']['role'] !='Administrador'): ?>
        	<div class="alert alert-warning alert-dismissable">
                 <p><strong>Upps!</strong> No puedes acceder a esta página.</p>
           </div>
       <?php endif; ?>  
	</div>
	<br>
</div>