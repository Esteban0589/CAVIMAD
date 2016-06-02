<div class="container">
	<div class="homePictures form">
		<div class="row">
			<?php if($this->Session->read('role') =='Administrador'): ?>
				<div class="homePictures form col-md-4">
					<?php echo $this->Form->create('HomePicture'); ?>
						<fieldset>
						<br>
						<h1>
							<?php echo __('Editar imagen de portada'); ?>
							<?php echo $this->Html->link(__(''), array('action' => 'index'), array('class' => 'glyphicon glyphicon-th-large','title' =>'Ir a galeria', 'style'=>'color: #3891D4;    font-size:25px;     padding: 5px;')); ?>
							<?php echo $this->Form->postLink(__(''), array('action' => 'delete', $this->request->data['HomePicture']['id']), array('class' => 'glyphicon glyphicon-trash', 'title' =>"Eliminar imagen de portada",'style'=>'color: #860000;    font-size:25px;     padding: 5px;'), __('Está seguro de que desea eliminar # %s?', $this->request->data['HomePicture']['id'])); ?>
				
							</h1>
						<?php
							echo $this->Form->input('id',array('class'=>'form-control'));
							echo $this->Form->input('title',array('class'=>'form-control','label'=>'Título','title'=>'Ingrese el titulo de la imagen'));
							echo $this->Form->input('description',array('class'=>'form-control','label'=>'Descripcíon','rows' => '5', 'cols' => '5','title'=>'Ingrese una descripcion de la imagen' ));
							echo $this->Form->input('picture', array('class'=>'form-control','type'=>'file','label'=>'Imagen','title'=>'Seleccione la imagen a cargar' ));
							echo $this->Form->input('picture_dir',array('type'=>'hidden'));
						?>
						</fieldset>
					<br>
					<?php echo $this->Form->end(array('label'=>'Actualizar imagen', 'class'=>'btn btn-success','title'=>'Guardar imagen en galeria')); ?>
				</div>
				<div class="homePictures form col-md-8">
					<br>
					<br>
					<br>
					<br>
					<td><?php echo $this->Html->image('../files/home_picture/image/'.$this->request->data['HomePicture']['image_dir'] . '/thumb_' .$this->request->data['HomePicture']['image'], array('class' => 'img-thumbnail img-responsive'));  ?></td>
				</div>
			<?php endif; ?>
			<?php if($this->Session->read('role') !='Administrador'): ?>
        	<div class="alert alert-warning alert-dismissable">
                 <p><strong>Upps!</strong> No puedes acceder a esta página.</p>
           </div>
       <?php endif; ?> 
		</div>
		<!--<div class="actions">-->
		<!--	<h3><?php echo __('Actions'); ?></h3>-->
		<!--	<ul>-->
		
		<!--		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('HomePicture.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('HomePicture.id')))); ?></li>-->
		<!--		<li><?php echo $this->Html->link(__('List Home Pictures'), array('action' => 'index')); ?></li>-->
		<!--	</ul>-->
		<!--</div>-->
			<br>
	</div>
</div>
