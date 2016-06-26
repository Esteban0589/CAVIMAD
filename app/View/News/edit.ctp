<div class="container">
	<div class="news form">
		<div class="row">
			<?php if($this->Session->read('role') =='Administrador'): ?>
				<h1>					
					<?php echo $this->Html->link(__(''), array('action' => 'view',$this->request->data['News']['id']), array('class' => 'glyphicon glyphicon-arrow-left','title' =>'Ver todas las noticias', 'style'=>'color: #3891D4; font-size:25px; padding: 5px;')); ?>
					<?php echo __('Edicíon noticia'); ?>
					<?php echo $this->Form->postLink(__(''), array('action' => 'delete', $this->request->data['News']['id']), array('class' => 'glyphicon glyphicon-trash', 'title' =>"Eliminar noticia",'style'=>'color: #860000; font-size:25px; padding: 5px;'), __('Atención se va a eliminar noticia # %s?', $this->request->data['News']['title'])); ?>
				</h1>
				<div class="news form col-md-4">
					<?php echo $this->Form->create('News'); ?>
						<fieldset>
						<br>
						<?php
							echo $this->Form->input('id',array('class'=>'form-control'));
							echo $this->Form->input('title',array('class'=>'form-control','label'=>'Título','title'=>'Ingrese el título de la noticia'));
							echo $this->Form->input('description',array('class'=>'form-control','label'=>'Descripcíon','rows' => '5', 'cols' => '5','title'=>'Ingrese una descripción de la noticia' ));
							echo $this->Html->link(__('Editar imagenes de noticia'), array('controller'=>'NewsEventsPictures','action' => 'view_images_news',$this->request->data['News']['id'],), array('class' => 'glyphicon glyphicon-th','title' =>'Administrar imagenes de noticia', 'style'=>'color: #3891D4; font-size:14px; padding: 5px;'));
							
						?>
						</fieldset>
					<br>
					<?php echo $this->Form->end(array('label'=>'Actualizar noticia', 'class'=>'btn btn-success','title'=>'Guardar noticia')); ?>
				</div>
				<div class="news form col-md-8">
					
					<!--Aqui hay q meter el carusel!!!!!1-->
					<td><?php echo $this->Html->image('../files/home_picture/image/'.$this->request->data['News']['image_dir'] . '/thumb_' .$this->request->data['News']['image'], array('class' => 'img-thumbnail img-responsive'));  ?></td>
				
				<br>
				<br>
				
				
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