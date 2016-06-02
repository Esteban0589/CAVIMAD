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
		<h2><?php echo __('Galeria de fotos de portada'); ?></h2>
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
				<td class="col-lg-2"><?php echo h($homePicture['HomePicture']['title']); ?>&nbsp;</td>
				<td class="col-lg-3 ">
				<?php 
				echo  substr(($homePicture['HomePicture']['description']),0,100);
				echo $this->Html->link(__('...mas'), array('action' => 'view', $homePicture['HomePicture']['id']), array('title'=>'Ver todos los detalles de la imagen'));
				?>&nbsp;</td>

				<td class="col-lg-5"><?php echo $this->Html->image('../files/home_picture/image/'.$homePicture['HomePicture']['image_dir'] . '/thumb_' .$homePicture['HomePicture']['image'], array('class' => 'img-thumbnail img-responsive'));  ?></td>
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
	</div>
	<div class="actions">
		<h3><?php echo __('Acciones'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('Agregar foto de portada'), array('action' => 'add')); ?></li>
		</ul>
	</div>
</div>
