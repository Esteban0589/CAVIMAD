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
		<div class="pictures index col-md-12">
			<div class="row">
				<h1><?php echo __('Imágenes del taxón'); ?></h1>
				
				
				
				<!--Agregar imagen visible solamente para admin-->
				<div class="container">
					<div class="row">
						<?php if($this->Session->read('role') =='Administrador'): ?>
							<div class="pictures form col-md-6">
						<?php echo $this->Form->create('Picture', array('url'=>'add','type'=>'file', 'novalidate'=>'novalidate')); ?>
						
						<!--$this->Form->create('Category', array('url'=>'redirect_to_methods')-->
							<fieldset>
								<h3><?php echo __('Agregar imagen de género'); ?></h3>
							<?php
								echo $this->Form->input('image', array('class'=>'form-control','type'=>'file','label'=>'Imagen','title'=>'Seleccione la imagen a cargar' ));
								echo $this->Form->input('image_dir',array('type' =>'hidden','default'=>$id));
								echo $this->Form->input('phylo_id',array('type' =>'hidden'));
								echo $this->Form->input('subphylo_id',array('type' =>'hidden'));
								echo $this->Form->input('class_id',array('type' =>'hidden'));
								echo $this->Form->input('subclass_id',array('type' =>'hidden'));
								echo $this->Form->input('order_id',array('type' =>'hidden'));
								echo $this->Form->input('suborder_id',array('type' =>'hidden'));
								echo $this->Form->input('family_id',array('type' =>'hidden'));
								echo $this->Form->input('subfamily_id',array('type' =>'hidden'));
								echo $this->Form->input('genre_id',array('type' =>'hidden','default'=>$id));
								echo $this->Form->input('subgenre_id',array('type' =>'hidden'));
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

							<?php echo $this->Html->image('../files/picture/image/'.$picture['Picture']['image_dir'] .'/'.'thumb_'.$picture['Picture']['image'], array('class' => 'img-thumbnail img-responsive col-lg-3'));  ?>
		
						
					<?php endforeach; ?>
			</div>
	
			<br>
		</div>
	</div>
	<br>
</div>

