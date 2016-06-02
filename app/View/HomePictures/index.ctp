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
	<div class="homePictures index">
		<?php if($this->Session->read('role') =='Administrador'): ?>
		<h2>
			<?php echo __('Galeria de fotos de portada'); ?>
			<?php echo $this->Html->link(__(''), array('action' => 'add'), array('class' => 'glyphicon glyphicon-upload','title' =>'Agregar imagen', 'style'=>'color: #3891D4;    font-size:25px;     padding: 5px;')); ?>
			
		</h2>
		<div class="col-lg-12 ">
			<table id="example" class="display" cellpadding="0" cellspacing="0">
			<thead>
			<tr>
					<th class="col-lg-2 ">Titulo</th>
					<th class="col-lg-3 ">Descripción</th>
					<th class="col-lg-5 ">Imagen</th>
					<th class="col-lg-2">Acciones</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($homePictures as $homePicture): ?>
			<tr>
				<td class="col-lg-1"><?php echo h($homePicture['HomePicture']['title']); ?>&nbsp;</td>
				<td class="col-lg-3 ">
				<?php 
				echo  substr(($homePicture['HomePicture']['description']),0,100);
				echo $this->Html->link(__('...mas'), array('action' => 'view', $homePicture['HomePicture']['id']), array('title'=>'Ver todos los detalles de la imagen'));
				?>&nbsp;</td>

				<td class="col-lg-6"><?php echo $this->Html->image('../files/home_picture/image/'.$homePicture['HomePicture']['image_dir'] . '/' .$homePicture['HomePicture']['image'], array('class' => 'img-thumbnail img-responsive','style'=>'height: 200px; width: 100%;'));  ?></td>
				<td class="actions col-lg-2">
					<?php echo $this->Html->link(__(''), array('action' => 'view', $homePicture['HomePicture']['id']), array('title'=>'Ver todos los detalles de la imagen','class' => 'glyphicon glyphicon-eye-open', 'style' => 'font-size:25px; padding: 5px;')); ?>
					<?php echo $this->Html->link(__(''), array('action' => 'edit', $homePicture['HomePicture']['id']),array('title'=>'Editar la informacion de la imagen','class' => 'glyphicon glyphicon-pencil', 'style' => 'font-size:25px; padding: 5px;')); ?>
					<?php echo $this->Form->postLink(__(''), array('action' => 'delete', $homePicture['HomePicture']['id']), array('title'=>'Eliminar el taxón','class' => 'glyphicon glyphicon glyphicon-trash', 'style' => 'font-size:25px; padding: 5px;'), __('Esta seguro que desea eliminar # %s?', $homePicture['HomePicture']['id'])); ?>
                  

				</td>
			</tr>
		<?php endforeach; ?>
			</tbody>
			</table>
		</div>
		<?php endif; ?>
		<?php if($this->Session->read('role') !='Administrador'): ?>
        	<div class="alert alert-warning alert-dismissable">
                 <p><strong>Upps!</strong> No puedes acceder a esta página.</p>
           </div>
       <?php endif; ?> 
	</div>
</div>
