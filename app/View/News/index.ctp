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
	<div class="news index">
		<?php if($this->Session->read('Auth')['User']['role'] =='Administrador'): ?>
		<h2>
			<?php echo $this->Html->link(__(''), array('controller'=>'users','action' => 'controlpanel'), array('class' => 'glyphicon glyphicon-arrow-left','title' =>'Volver a panel de control', 'style'=>'color: #3891D4;    font-size:25px;     padding: 5px;')); ?>
			<?php echo __('Noticias'); ?>
			<?php echo $this->Html->link(__('Agregar noticia'), array('action' => 'add'), array('class' => 'glyphicon glyphicon-upload','title' =>'Agregar imagen', 'style'=>'color: #3891D4;    font-size:25px;     padding: 5px;')); ?>
			
		</h2>
		<div class="col-lg-12 ">
			<table id="example" class="display" cellpadding="0" cellspacing="0">
			<thead>
			<tr>
					<th class="col-lg-2 ">Titulo</th>
					<th class="col-lg-4 ">Descripción</th>
					<th class="col-lg-2 ">Creada</th>
					<th class="col-lg-2 ">Modificada</th>
					<th class="col-lg-2">Acciones</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($news as $homePicture): ?>
			<tr>
				<td class="col-lg-2"><?php echo h($homePicture['News']['title']); ?>&nbsp;</td>
				<td class="col-lg-4 ">
				<?php 
				echo  substr(($homePicture['News']['description']),0,100);
				echo $this->Html->link(__('...mas'), array('action' => 'view', $homePicture['News']['id']), array('title'=>'Ver todos los detalles de la imagen'));
				?>&nbsp;</td>
				<td class="col-lg-2"><?php echo h($homePicture['News']['created']); ?>&nbsp;</td>
				<td class="col-lg-2"><?php echo h($homePicture['News']['modified']); ?>&nbsp;</td>

				<td class="actions col-lg-2">
					<?php echo $this->Html->link(__(''), array('action' => 'view', $homePicture['News']['id']), array('title'=>'Ver todos los detalles de la noticia','class' => 'glyphicon glyphicon-eye-open', 'style' => 'font-size:25px; padding: 5px;')); ?>
					<?php echo $this->Html->link(__(''), array('action' => 'edit', $homePicture['News']['id']),array('title'=>'Editar la información de la noticia','class' => 'glyphicon glyphicon-pencil', 'style' => 'font-size:25px; padding: 5px;')); ?>
					<?php echo $this->Form->postLink(__(''), array('action' => 'delete', $homePicture['News']['id']), array('title'=>'Eliminar la noticia','class' => 'glyphicon glyphicon glyphicon-trash', 'style' => 'font-size:25px; padding: 5px;'), __('Atención se va a eliminar la imagen # %s', $homePicture['News']['id'])); ?>
                  

				</td>
			</tr>
		<?php endforeach; ?>
			</tbody>
			</table>
		</div>
		<?php endif; ?>
		<?php if($this->Session->read('Auth')['User']['role'] !='Administrador'): ?>
        	<div class="alert alert-warning alert-dismissable">
                 <p><strong>Upps!</strong> No puedes acceder a esta página.</p>
           </div>
       <?php endif; ?> 
	</div>
</div>
