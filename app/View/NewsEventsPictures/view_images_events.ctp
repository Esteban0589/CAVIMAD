<script>
	$(document).ready(function() {
	    $('#example').DataTable( {
	         dom: 'Bfrtip',
	         colReorder: true,
    buttons: [
        'colvis',
        'print',
        'excel', 
        'pdf',
        'copy',
        
    ]
	    });
});
</script>
<div class="container">
	<div class="row">
		<div class="view_images_events index col-md-12">
			<div class="row">
				<h1>
					<?php echo $this->Html->link(__(''), array('controller'=>'Events','action' => 'view',$id), array('class' => 'glyphicon glyphicon-arrow-left','title' =>'Volver a detalles de evento', 'style'=>'color: #3891D4; font-size:25px; padding: 5px;')); ?>
					<?php echo __('Imágenes de evento'); ?>
				</h1>
				
				
				
				<!--Agregar imagen visible solamente para admin-->
				<div class="container">
					<div class="row">
						<?php if($this->Session->read('Auth')['User']['role'] =='Administrador'): ?>
							<div class="view_images_events form col-md-6">
            					<?php echo $this->Form->create('NewsEventsPicture', array('url' => 'add','type'=>'file', 'novalidate'=>'novalidate')); ?>
            					
            					<!--$this->Form->create('Category', array('url'=>'redirect_to_methods')-->
    							<fieldset>
    							<h3><?php echo __('Agregar imagen de evento'); ?></h3>
    							<?php
    								echo $this->Form->input('image', array('class'=>'form-control','type'=>'file','label'=>'Imagen','title'=>'Seleccione la imagen a cargar' ));
    								echo $this->Form->input('image_dir',array('type' =>'hidden'));
    								echo $this->Form->input('user_id',array('type' =>'hidden', 'default'=>$current_user['id']));
    								echo $this->Form->input('event_id',array('type' =>'hidden', 'default'=>$id));
    								
    								
    							?>
    							</fieldset>
    							<br>
    							<?php echo $this->Form->end(array('label'=>'Guardar imagen', 'class'=>'btn btn-success','title'=>'Guardar imagen en galeria')); ?>
    						</div>
						<?php endif; ?>
							  
						</div>
					<br>
				</div>
				
			<div class="row">
		

					<?php foreach ($pictures as $picture): ?>
						<div class = "col-lg-3">
							<?php echo $this->Html->image('../files/news_events_picture/image/'.$picture['NewsEventsPicture']['image_dir'] .'/'.'thumb_'.$picture['NewsEventsPicture']['image'], array('class' => 'img-thumbnail img-responsive'));  ?>
							
							<?php echo $this->Form->postLink(__(''), array('action' => 'delete', $picture['NewsEventsPicture']['id']), array('required'=>'required','title'=>'Eliminar imagen de genero','class' => 'glyphicon glyphicon glyphicon-trash', 'style' => 'font-size:25px; padding: 5px;'), __('Está seguro de que desea eliminar # %s?', $picture['NewsEventsPicture']['image'])); ?>
							
						</div>

						
					<?php endforeach; ?>
			</div>
	
			<br>
		</div>
	</div>
	<br>
</div>


